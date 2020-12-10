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
            //[['n_semana','numero_semanas'], 'validateOrden'],            
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
       $nsemanasCiclo=h::gsetting('acad', 'NSemanasCiclo');
       $attributes=['syllabus_id'=>$this->syllabus_id,
          // 'n_semana'=>$this->n_semana,
           'unidad_id'=>$this->id,
            'n_horas_cumplimiento'=>$this->syllabus->plan->hoursForWeek()/$this->n_sesiones_semana,
           'n_horas_trabajo_indep'=>$this->syllabus->n_horasindep/$this->n_sesiones_semana,
           ];
       $semana=1;
       for ($i = 1; $i <=($nsemanasCiclo%$this->n_sesiones_semana +1)*$this->numero_semanas ; $i++) {
             
           
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
              if($i%$this->n_sesiones_semana==0) $semana++; 
            }
   }
    
   public function nextUnidad(){
      return  static::find()->andWhere(['>','n_semana',$this->n_semana])->limit(1)->one();
   }
   public function previousUnidad(){
       $nmax=static::find()->select(['max(n_semana)'])->andWhere(['syllabus_id'=>$this->syllabus_id])->scalar();
       yii::error($nmax);
       //yii::error(static::find()->andWhere(['<','n_semana',$this->n_semana])->limit(1)->createCommand()->rawSql);
      return  static::find()->andWhere(['<','n_semana',$this->n_semana])->limit(1)->one();
   }
   
   public function validateOrden($attribute,$params){
       yii::error('validacion',__FUNCTION__);
       $hayUnidades=$this->syllabus->getSyllabusUnidades()->count();
       if($hayUnidades==0 && $this->n_semana <> 1)
       $this->addError('n_semana',yii::t('base_errors','{label} must be 1',['label'=>$this->getAttributeLabel ('n_semana')]));
       
       if(!is_null($unidadAnterior=$this->previousUnidad())){
           yii::error('hay unidad anterior');
           if($this->n_semana <= $unidadAnterior->n_semana+$unidadAnterior->numero_semanas)
             $this->addError('n_semana',yii::t('base_errors','This week number has already been taken by the unit {descripcion}',['descripcion'=>$unidadAnterior->descripcion]));
       
       }else{
           yii::error('no hay unidad anterior');
       }
       
   }
   
   
}
