<?php

namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;
use common\helpers\h;
use common\models\masters\Trabajadores;
use common\models\masters\Facultades;
USE \yii2mod\settings\models\enumerables\SettingType;
use Yii;
use common\helpers\timeHelper;
use common\helpers\RangeDates;

/**
 * This is the model class for table "{{%inter_horarios}}".
 *
 * @property int $id
 * @property int $plan_id
 * @property int $programa_id
 * @property int $facultad_id
 * @property int $etapa_id
 * @property int $dia
 * @property string $hinicio
 * @property string $hfin
 * @property float $tolerancia
 * @property string $activo
 * @property string|null $codtra
 * @property string $clase
 * @property string $skipferiado
 *
 * @property InterPlan $plan
 * @property InterEtapas $etapa
 * @property Facultades $facultad
 */
class InterHorarios extends \common\models\base\modelBase 
implements \common\interfaces\rangeInterface
{
    use  \common\traits\timeTrait;
    /**
     * {@inheritdoc}
     * 
     * 
     * 
     */
    
   const SCENARIO_HORAS='horas';
    public $booleanFields=['activo','skipferiado'];
    public $dateorTimeFields=[
        'hinicio'=>self::_FHOUR,
        'hfin'=>self::_FHOUR]; 
    public static function tableName()
    {
        return '{{%inter_horarios}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_id', 'programa_id', 'facultad_id', 'etapa_id', 'dia', 'hinicio', 'hfin', 'tolerancia', 'activo', 'clase', 'skipferiado'], 'required'],
            [['plan_id', 'programa_id', 'facultad_id', 'etapa_id', 'dia'], 'integer'],
            [['tolerancia'], 'number'],
            [['hinicio', 'hfin'], 'string', 'max' => 5],
            [['clase'], 'string', 'max' => 1],
            [['plan_id', 'dia'], 'unique', 'targetAttribute' => ['plan_id', 'dia'],'message'=>m::t('errors','Day of Week already registered')],
            [['codtra'], 'string', 'max' => 6],
             [['hinicio','hfin'], 'validateHoras','on'=>self::SCENARIO_HORAS],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterPlan::className(), 'targetAttribute' => ['plan_id' => 'id']],
            [['etapa_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterEtapas::className(), 'targetAttribute' => ['etapa_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'plan_id' => Yii::t('base_labels', 'Plan ID'),
            'programa_id' => Yii::t('base_labels', 'Programa ID'),
            'facultad_id' => Yii::t('base_labels', 'Facultad ID'),
            'etapa_id' => Yii::t('base_labels', 'Etapa ID'),
            'dia' => Yii::t('base_labels', 'Dia'),
            'hinicio' => Yii::t('base_labels', 'Hinicio'),
            'hfin' => Yii::t('base_labels', 'Hfin'),
            'tolerancia' => Yii::t('base_labels', 'Tolerancia'),
            'activo' => Yii::t('base_labels', 'Activo'),
            'codtra' => Yii::t('base_labels', 'Codtra'),
            'clase' => Yii::t('base_labels', 'Clase'),
            'skipferiado' => Yii::t('base_labels', 'Skipferiado'),
        ];
    }

    
       public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios[self::SCENARIO_HORAS] = ['hinicio','hfin','activo','codtra','dia','skipferiado'];
       // $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery|InterPlanQuery
     */
    public function getPlan()
    {
        return $this->hasOne(InterPlan::className(), ['id' => 'plan_id']);
    }

    /**
     * Gets query for [[Etapa]].
     *
     * @return \yii\db\ActiveQuery|InterEtapasQuery
     */
    public function getEtapa()
    {
        return $this->hasOne(InterEtapas::className(), ['id' => 'etapa_id']);
    }

    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterHorariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterHorariosQuery(get_called_class());
    }
    
     public function range($micarbon=null){
     /*
            * FUNCION dEL TIME TRAIT
            */
     /*$rag=self::RangeFromCarbonAndLimits(
           
           $micarbon,
           $this->hinicio,
           $this->hfin); 
     YII::ERROR($rag->initialDate);
     YII::ERROR($rag->finalDate);*/
     if(is_null($micarbon))$micarbon=self::CarbonNow();
    
   return self::RangeFromCarbonAndLimits(           
           $micarbon,
           $this->hinicio,
           $this->hfin); 
 }
 
 public function rangesToDay($carbon,$arrayWhere=null){
     $queryRangos=$this->find()->select(['hinicio','hfin'])
             ->andWhere(['dia'=>$carbon->dayOfWeek,'activo'=>'1'])->
      orderBy(['hinicio'=>SORT_ASC]);
    // echo $queryCitas->createCommand()->getRawSql();
    if(is_null($arrayWhere)){
        $rangosDia=$queryRangos->All();
    }else{
        $rangosDia=$queryRangos->andWhere($arrayWhere)
            ->All();
    }
    /*Aqui comenzamos a crear el obejto rangeDay*/
        if(count($rangosDia)>0){         
            //$fecha=$citasDia[0]['fechaprog']; //Creamosd el carbons de inciializacion*/   
            $rangodia=New \common\helpers\RangeDay($carbon);
                    foreach($rangosDia as $rango){
                        $rangodia->insertRange($rango->range($carbon));
                            }
                return $rangodia;
        }else{
            return null;
        }
  } 
 
 public function  rangesToWeek(\Carbon\Carbon $carbon,$arrayWhere=null){
     $rangoSemana=New \common\helpers\RangeWeek($carbon);
            $rangeLunes=$this->rangesToDay($rangoSemana->initialDate, $arrayWhere);
            if(!is_null($rangeLunes))
             $rangoSemana->insertRange ($rangeLunes);
             
            $rangeMartes=$this->rangesToDay($rangoSemana->initialDate->copy()->addDay(1), $arrayWhere);
           if(!is_null($rangeMartes))
             $rangoSemana->insertRange ($rangeMartes);  
               
            $rangeMiercoles=$this->rangesToDay($rangoSemana->initialDate->copy()->addDay(2), $arrayWhere);
           if(!is_null($rangeMiercoles))
             $rangoSemana->insertRange ($rangeMiercoles); 

            $rangeJueves=$this->rangesToDay($rangoSemana->initialDate->copy()->addDay(3), $arrayWhere);
           if(!is_null($rangeJueves))
             $rangoSemana->insertRange ($rangeJueves); 
           
           $rangeViernes=$this->rangesToDay($rangoSemana->initialDate->copy()->addDay(4), $arrayWhere);
           if(!is_null($rangeViernes))
             $rangoSemana->insertRange ($rangeViernes); 
           
            $rangeSabado=$this->rangesToDay($rangoSemana->initialDate->copy()->addDay(5), $arrayWhere);
           if(!is_null($rangeSabado))
             $rangoSemana->insertRange ($rangeSabado); 
           
           
            $rangeDomingo=$this->rangesToDay($rangoSemana->initialDate->copy()->addDay(6), $arrayWhere);
           if(!is_null($rangeDomingo))
             $rangoSemana->insertRange ($rangeDomingo); 
           
            
      Return $rangoSemana;
 }
  
  public function validateHoras($attribute, $params)
    {
      $duracionminima= h::getIfNotPutSetting('sta','duracionMinimaRango',3, SettingType::INTEGER_TYPE);
        $diferenciaenhoras=$this->toCarbon('hfin')->diffInHours($this->toCarbon('hinicio'));
        if( $diferenciaenhoras <  $duracionminima and $diferenciaenhoras >=0){
             $this->addError('hinicio', m::t('errors','El rango del horario es muy corto o nulo',
                    ['campo'=>$this->getAttributeLabel('hinicio')]));
        }
        if( $diferenciaenhoras < 0){
             $this->addError('hinicio', m::t('errors','Hora inicio mayor que hora fin',
                    ['campo'=>$this->getAttributeLabel('hinicio')]));
        }
        
    } 
    
    public function beforeSave($insert) {
     if($insert){
        
          $this->nombredia= \common\helpers\timeHelper::daysOfWeek()[$this->dia];
        $this->tolerancia=0.1;
     }
     return parent::beforeSave($insert);
 }
    
 public function eventToCalendar(){
     //$rango=$this->range();
     $evento=[
          'title' => m::t('labels',''),
         //'startRecur' =>date('Y-m-d 00:30:00'),
          'dow'=>[$this->dia],
         //'endRecur' =>date('2020-09-30 00:30:00'),
         'start' =>$this->hinicio,
         'end' =>$this->hfin, 
         
         'color' => '#e9f72057',
        
         
     ];
     //unset($rango);
     return $evento;
 }
 
}
