<?php

namespace frontend\modules\acad\models;

use Yii;

/**
 * This is the model class for table "{{%acad_tramite_syllabus}}".
 *
 * @property int $id
 * @property string $codocu
 * @property int $docu_id
 * @property int $user_id
 * @property int $orden
 * @property string $aprobado
 * @property string|null $motivo
 * @property string|null $fecha_recibido
 * @property string|null $fecha_aprobacion
 */
class AcadTramiteSyllabus extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    
    public $dateorTimeFields =[
        'fecha_aprobacion' => self::_FDATETIME,
        'fecha_recibido' => self::_FDATETIME,
        ];
    public static function tableName()
    {
        return '{{%acad_tramite_syllabus}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codocu', 'docu_id', 'user_id', 'orden', 'aprobado'], 'required'],
            [['docu_id', 'user_id', 'orden'], 'integer'],
            [['motivo','descripcion'], 'string'],
             [['descripcion','fecha_aprobacion','fecha_recibido'], 'safe'],
            [['codocu'], 'string', 'max' => 3],
            [['aprobado'], 'string', 'max' => 1],
            [['fecha_recibido', 'fecha_aprobacion'], 'string', 'max' => 19],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'docu_id' => Yii::t('base_labels', 'Docu ID'),
            'user_id' => Yii::t('base_labels', 'User ID'),
            'orden' => Yii::t('base_labels', 'Orden'),
            'aprobado' => Yii::t('base_labels', 'Aprobado'),
            'motivo' => Yii::t('base_labels', 'Motivo'),
            'fecha_recibido' => Yii::t('base_labels', 'Fecha Recibido'),
            'fecha_aprobacion' => Yii::t('base_labels', 'Fecha Aprobacion'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AcadTramiteSyllabusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadTramiteSyllabusQuery(get_called_class());
    }
    
     public function getSyllabus()
    {
        return $this->hasOne(AcadSyllabus::className(), ['id' => 'docu_id']);
    }
    
    public function next(){
       if($this->isFinal())return false;
       return static::find()->where(['docu_id'=>$this->id])
           ->andWhere(['>','orden',$this->orden])->orderBy(['orden'=>SORT_ASC])->one();
       
    }
    public function prev(){
       if($this->isBegin())return false; 
       return static::find()->where(['docu_id'=>$this->id])
           ->andWhere(['<','orden',$this->orden])->orderBy(['orden'=>SORT_DESC])->one();
    }
    
    public function isFinal(){
      return ($this->orden=max(array_keys($this->syllabus->flujo)));
    }
    
    public function isBegin(){
      return ($this->orden=min(array_keys($this->syllabus->flujo)));
    }
    
    
   public function afterSave($insert,$changedAttributes) {
       if(!$insert && in_array('aprobado', array_keys($changedAttributes))){
           
       }       
       return parent::afterSave($insert,$changedAttributes);
   }
   
  public function beforeSave($insert) {
      if($this->hasChanged('aprobado') && !$insert ){
          $this->afterAprove();
      }
      return parent::beforeSave($insert);
  }
  
  private function afterAprove(){
      if($this->aprobado){ 
          $this->fecha_aprobacion=self::CarbonNow()->format(
                  \common\helpers\timeHelper::formatMysqlDateTime()
                  ); //'2020-12-17 13:23:00'
          $otro=$this->next(); 
          if($otro){
              $otro->fecha_recibido=self::CarbonNow()->format(\common\helpers\timeHelper::formatMysqlDateTime());
              $otro->save();
          }
          
      }else{
          $this->fecha_aprobacion='';
          $siguiente=$this->next();
          if($siguiente){
              if(!$siguiente->aprobado){
                  $siguiente->fecha_recibido='';
                  $siguiente->save();
              }
          }
      }
  }
  
  public function aprove($reverse=false){
      $this->aprobado=!$reverse;
      $this->save();
  }
  
  
}
