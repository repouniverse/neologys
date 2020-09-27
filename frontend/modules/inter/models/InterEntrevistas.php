<?php

namespace frontend\modules\inter\models;
USE common\models\masters\Universidades;

USE common\models\masters\Facultades;
use common\helpers\RangeDates; 
 use frontend\modules\inter\models\InterConvocados;
  use frontend\modules\inter\Module as m;
 use frontend\modules\inter\models\InterHorarios;
use Yii;

/**
 * This is the model class for table "7pxv4v_inter_entrevistas".
 *
 * @property int $id
 * @property int $facultad_id
 * @property int $etapa_id
 * @property int $universidad_id
 * @property int $modo_id
 * @property string|null $codperiodocomm
 * @property int $expediente_id
 * @property int $convocado_id
 * @property int $persona_id
 * @property string|null $finicio
 * @property string|null $numero
 * @property string|null $ftermino
 * @property string|null $asistio
 * @property string|null $detalles
 * @property string|null $detalles_secre
 * @property string $activo
 * @property string $masivo
 * @property int $duracion
 * @property string $codfac
 * @property int $flujo_id
 *
 * @property InterEtapas $etapa
 * @property InterExpedientes $expediente
 * @property InterModos $modo
 * @property Facultades $facultad
 * @property Universidades $universidad
 */
class InterEntrevistas extends \common\models\base\modelBase
implements \common\interfaces\rangeInterface
{
    use \common\traits\timeTrait;
    public  $prefijo='125';
    const SCENARIO_BASICO='basico';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_entrevistas}}';
    }

    public $dateorTimeFields = [
        'fechaprog' => self::_FDATETIME,
        'finicio' => self::_FDATETIME,
        'ftermino' => self::_FDATETIME
    ];
    public $booleanFields=['asistio','activo'];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['facultad_id', 'etapa_id', 'universidad_id',
                'modo_id', 'expediente_id',
                'convocado_id', 'persona_id',
                 
                 ], 'required'],
            [['asistio','codigo','user_id'], 'safe'],
            [['facultad_id', 'etapa_id', 'universidad_id','plan_id', 'modo_id', 'expediente_id', 'convocado_id', 'persona_id', 'duracion', 'flujo_id'], 'integer'],
            [['detalles', 'detalles_secre'], 'string'],
            
             [['expediente_id'], 'unique','filter'=>['<>','activo','0'], 'targetAttribute' => ['expediente_id'],'message'=>m::t('labels','Already exists a date for this plan')],
            
            
            [['codperiodo', 'finicio', 'ftermino'], 'string', 'max' => 19],
            [['numero', 'codfac'], 'string', 'max' => 8],
            //[['asistio', 'activo', 'masivo'], 'string', 'max' => 1],
            [['etapa_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterEtapas::className(), 'targetAttribute' => ['etapa_id' => 'id']],
            [['expediente_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterExpedientes::className(), 'targetAttribute' => ['expediente_id' => 'id']],
            [['modo_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterModos::className(), 'targetAttribute' => ['modo_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'facultad_id' => 'Facultad ID',
            'etapa_id' => 'Etapa ID',
            'universidad_id' => 'Universidad ID',
            'modo_id' => 'Modo ID',
            'codperiodo' => 'Codperiodo',
            'expediente_id' => 'Expediente ID',
            'convocado_id' => 'Convocado ID',
            'persona_id' => 'Persona ID',
            'finicio' => 'Finicio',
            'numero' => 'Numero',
            'ftermino' => 'Ftermino',
            'asistio' => 'Asistio',
            'detalles' => 'Detalles',
            'detalles_secre' => 'Texto interno',
            'activo' => 'Activo',
            'masivo' => 'Masivo',
            'duracion' => 'Duracion',
            'codfac' => 'Codfac',
            'flujo_id' => 'Flujo ID',
        ];
    }

    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_BASICO] = [
            'facultad_id', 'universidad_id','asistio','codigo',
            'etapa_id', 'fechaprog', 'codperiodo', 'activo',
            'persona_id', 'etapa_id', 'modo_id', 'expediente_id','plan_id',
            'convocado_id','user_id'];
        /*$scenarios[self::SCENARIO_ASISTIO] = ['asistio','justificada'];
        $scenarios[self::SCENARIO_PSICO] = ['codtra'];
        $scenarios[self::SCENARIO_ACTIVO] = ['activo'];
        $scenarios[self::SCENARIO_REPROGRAMA] = ['fechaprog', 'duracion', 'finicio', 'ftermino', 'codtra'];
        */
        return $scenarios;
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
public function getPlan()
    {
        return $this->hasOne(InterPlan::className(), ['id' => 'plan_id']);
    }
    /**
     * Gets query for [[Expediente]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getExpediente()
    {
        return $this->hasOne(InterExpedientes::className(), ['id' => 'expediente_id']);
    }

    
    public function getConvocado()
    {
        return $this->hasOne(InterConvocados::className(), ['id' => 'convocado_id']);
    }
    /**
     * Gets query for [[Modo]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getModo()
    {
        return $this->hasOne(InterModos::className(), ['id' => 'modo_id']);
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
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterEntrevistasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterEntrevistasQuery(get_called_class());
    }
    
        public function range($micarbon=null){
           $carbon1 = $this->toCarbon('fechaprog');
             $carbon2=$carbon1->copy()->addMinutes(30);
            
        /*}*/
          //yii::error($this->attributes,$carbon2);
        RETURN New RangeDates([
            
            $carbon1,$carbon2
           // $carbon1->copy()->addMinutes($this->duracion)
        ]);
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
    
    public function putColorEventsCalendar($events){
        foreach ($events as $key=>$event){
            if($event['id']==$this->id){
               // yii::error('coincidio');
               $event['color']="#ff0000";
               $events[$key]=$event;
              // yii::error($event);
               //break;
            }
        }
        return $events;
        
    }
    
   public function beforeSave($insert) {
       if($insert){
           $this->activo=true;
           $this->numero=$this->correlativo('numero');
           
       }
       return parent::beforeSave($insert);
   }
   
   /*
    * asiste False para revertir asistencia 
    */
   public function asiste($asiste=true){
       $this->asistio=$asiste;
      return  $this->save();
   }
   
   
    public function isInJourney() {
        /*sacando el rango de horarios predefinidos
es un arraya de registros modelos InterHorarios 
                 */
       
       $MyRange=$this->range();
      $rangoDay= $this->plan->rangoToDay($this->toCarbon('fechaprog'));
     yii::error('mi range Cita');
     yii::error($MyRange->rawInitialDate.'-'.$MyRange->rawFinalDate);
      //var_dump($rangoDay->ranges);die();
      if(is_null($rangoDay)) return false;
       $rangosDelDia=$rangoDay->ranges;
      if(!$this->isRangeInOtherGroupRanges(
              $MyRange,
              $rangosDelDia))return false;
      
      
       return true;
      }
    
    public function hasCruceInPlan(){
        
      
    } 
    
    
    public function IamOwnerThisDateId(){
     return (\common\helpers\h::userId()==$this->user_id);
       
    }
    
    
    
    public function reprograma($fechaInicio, $fechaTermino = null) {
        // yii::error($this->asistio);
        //yii::error($this->isVencida());
        $oldFecha = $this->fechaprog;

        
        if (!$this->asistio /* && !$this->isVencida()*/) {
            // if(true){  
            if (!($fechaInicio instanceof \Carbon\Carbon)) {
                $CfechaInicio = \Carbon\Carbon::createFromFormat(\common\helpers\timeHelper::formatMysql(), $fechaInicio);
            } else {
                $CfechaInicio = $fechaInicio;
            }
            if (!is_null($fechaTermino)) {
                $CfechaTermino = \Carbon\Carbon::createFromFormat(\common\helpers\timeHelper::formatMysql(), $fechaTermino);
                //$this->duracion = $CfechaTermino->diffInMinutes($CfechaInicio);
            }
            //var_dump($CfechaInicio->format($this->formatToCarbon(self::_FDATETIME)));die();

           // $codigotra = $this->taller->psicologoPorDia($CfechaInicio);
             //Si no encuentra turno ese dia coger el pisocolo por defecto 
           
             

            $this->fechaprog = $CfechaInicio->format($this->formatToCarbon(self::_FDATETIME));
            $this->finicio = $this->fechaprog;
            //$this->codtra = $codigotra;
            $this->ftermino = $CfechaInicio->addMinutes($this->duracion)->format($this->formatToCarbon(self::_FDATETIME));
            $oldScenario = $this->getScenario();



            $this->setScenario(self::SCENARIO_BASICO);
            //$this->registraLog($oldFecha);
            $grabo = $this->save();

            
            if (!$grabo) {
                $this->addError('fechaprog', m::t('errors', $this->getFirstError()));
                return false;
            }else{
                //if (h::gsetting('sta', 'notificacitasmail')) {
                //$this->enviacorreo(false,$oldFecha); //notiifcacion depreprogramcion
            }
            
            $this->setScenario($oldScenario);
            return $grabo;
        } else {
            //if ($this->isVencida())
                //$this->addError('fechaprog', m::t('errors', 'La cita se encuentra en el pasado, es mejor que cree una nueva'));
            if ($this->asistio)
                $this->addError('fechaprog', m::t('errors', 'Esta cita ya tiene asistencia'));

            return false;
        }
    }

  
  public function dayOfweek(){
      return $this->toCarbon('fechaprog')->dayOfWeek;
  }  
    
    
}
