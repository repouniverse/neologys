<?php

namespace frontend\modules\acad\models;
use common\helpers\h;
use Yii;

/**
 * This is the model class for table "{{%acad_syllabus_unidades}}".
 *
 * @property int $id
 * @property int $syllabus_id
 * @property string|null $descripcion
 * @property string|null $capacidad
 * @property string|null $comentarios
 *
 * @property AcadSyllabus $syllabus
 */
class AcadSyllabusUnidades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    
    //const FIRST_WEEK=1;
    public static function tableName()
    {
        return '{{%acad_syllabus_unidades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['syllabus_id','n_semana','numero_semanas','n_sesiones_semana'], 'required'],
            [['syllabus_id','n_semana','numero_semanas','n_sesiones_semana'], 'integer'],
               [['n_semana','numero_semanas','n_sesiones_semana'], 'safe'],
            [['n_semana'], 'validateOrden'],            
            [['capacidad', 'comentarios'], 'string'],
            [['descripcion'], 'string', 'max' => 80],
            [['syllabus_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadSyllabus::className(), 'targetAttribute' => ['syllabus_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'syllabus_id' => Yii::t('base_labels', 'Syllabus ID'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'capacidad' => Yii::t('base_labels', 'Capacidad'),
            'comentarios' => Yii::t('base_labels', 'Comentarios'),
            'n_semana'=> Yii::t('base_labels', 'Week number'),
            'numero_semanas'=> Yii::t('base_labels', 'Week numbers'),
        ];
    }

    /**
     * Gets query for [[Syllabus]].
     *
     * @return \yii\db\ActiveQuery|AcadSyllabusQuery
     */
    public function getSyllabus()
    {
        return $this->hasOne(AcadSyllabus::className(), ['id' => 'syllabus_id']);
    }

    /**
     * {@inheritdoc}
     * @return AcadSyllabusUnidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadSyllabusUnidadesQuery(get_called_class());
    }
    
    public function afterSave($insert, $changedAttributes) {
        $this->syllabus->refreshCapacidades();        
        return parent::afterSave($insert, $changedAttributes);
    }
    
    
    /*
    * Genera el contenido de la sección PROGRAMACION DE CONTENIDOS de
    * la estructura general del Syllabus, está en función del numero de
    * de sesiones por semana
    */
   public function generateContenidoSyllabusByUnidad(){
       $nsemanasCiclo=$this->syllabus->n_semanas;
       $attributes=['syllabus_id'=>$this->syllabus_id,
          // 'n_semana'=>$this->n_semana,
           'unidad_id'=>$this->id,
            'n_horas_cumplimiento'=>$this->syllabus->plan->hoursForWeek()/$this->n_sesiones_semana,
           'n_horas_trabajo_indep'=>$this->syllabus->n_horasindep/$this->n_sesiones_semana,
           ];
       $semana=1;
       yii::error('nsemanas= '. $nsemanasCiclo,__FUNCTION__);
       yii::error($nsemanasCiclo);
       $limite=($nsemanasCiclo%$this->n_sesiones_semana +1);
       yii::error( $limite,__FUNCTION__);
       $limite*=$this->numero_semanas;
       yii::error( $limite,__FUNCTION__);
       for ($i = 1; $i <=$limite ; $i++) {
            
           
           $attributes['n_sesion']=$i;
            $attributes['n_semana']=$semana;
              // $attributes['n_semana']=$i%$this->n_sesiones_semana +1;
               AcadContenidoSyllabus::firstOrCreateStatic(
                       $attributes,
                       null,
                       [
                         'syllabus_id'=>$this->syllabus_id,
                         'unidad_id'=>$this->id,
                           'n_sesion'=>$i,
                       ]
                       );
                yii::error('Residuo',__FUNCTION__);
               yii::error(fmod($i,$this->n_sesiones_semana),__FUNCTION__);
              if(fmod($i,$this->n_sesiones_semana)==0) $semana++; 
            }
   }
   
   
  
   
   public function isBegin(){       
    
      return ($this->n_semana==$this->minWeek() && !$this->isNewRecord);
   }
   
   public function isFinal(){
      $maxSemana=static::find()->select(['max(n_semana)'])->andWhere(['syllabus_id'=>$this->syllabus_id])->scalar();
     return ($this->n_semana==$maxSemana);
   }
   
   public function nextUnidad(){
      if($this->isFinal())return false;
      return  static::find()->andWhere(['>','n_semana',$this->n_semana])->
              orderBy(['n_semana'=>SORT_ASC])->limit(1)->one();
   }
   
   public  function minWeek(){
      return  static::find()->select(['min(n_semana)'])->andWhere(['syllabus_id'=>$this->syllabus_id])->scalar();
   }
   
   
   
    
   
   public function previousUnidad(){
       if($this->isBegin() or ($this->n_semana==$this->minWeek()))return false;
       //$nmax=static::find()->select(['max(n_semana)'])->andWhere(['syllabus_id'=>$this->syllabus_id])->scalar();
       //yii::error($nmax);
       //yii::error(static::find()->andWhere(['<','n_semana',$this->n_semana])->limit(1)->createCommand()->rawSql);
      return  static::find()->andWhere(['<','n_semana',$this->n_semana])->
              orderBy(['n_semana'=>SORT_DESC])->limit(1)->one();
   }
   
   
   private function lastWeek(){
       return $this->n_semana+$this->numero_semanas;       
   }
   private function firstWeek(){
       return $this->n_semana;       
   }
   
   public function validateOrden($attribute,$params){
       if($this->isBegin() && $this->n_semana<>$this->minWeek()){
          $this->addError('n_semana',yii::t('base_errors','Number week must be {semanamin}',['semanamin'=>$this->minWeek()])); 
       return;          
       }
        
       if(!$this->isBegin()){
          if($this->n_semana==$this->minWeek()){
              $this->addError('n_semana',yii::t('base_errors','Number week must be greater than {semanamin}',['semanamin'=>$this->minWeek()]));
             return;
          }
   if($this->n_semana != $this->previousUnidad()->lastWeek() ){
               //yii::error('tercera   condicion');
       $this->addError('n_semana',yii::t('base_errors','Number week does not match with previous unit'));
                return;
     }
           }
   }
   
}
