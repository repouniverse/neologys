<?php

namespace frontend\modules\inter\models;

use Yii;
use  yii\web\ServerErrorHttpException;
/**
 * This is the model class for table "{{%inter_etapas}}".
 *
 * @property int $id
 * @property int|null $programa_id
 * @property int|null $modo_id
 * @property string $descripcion
 * @property string|null $activo
 * @property string|null $comentarios
 */
class InterEtapas extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_etapas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['programa_id', 'modo_id'], 'integer'],
            [['descripcion'], 'required'],
            [['comentarios'], 'string'],
             [['awe','orden'], 'safe'],
            [['descripcion'], 'string', 'max' => 30],
            [['activo'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'programa_id' => Yii::t('base_labels', 'Programa ID'),
            'modo_id' => Yii::t('base_labels', 'Modo ID'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'activo' => Yii::t('base_labels', 'Activo'),
            'comentarios' => Yii::t('base_labels', 'Comentarios'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return InterEtapasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterEtapasQuery(get_called_class());
    }
    
    public function getModo()
    {
        return $this->hasOne(InterModos::className(), ['id' => 'modo_id']);
    }

     public function getPrograma()
    {
        return $this->hasOne(InterPrograma::className(), ['id' => 'programa_id']);
    }
    
    public static function firstStage($modo_id){
      $stage= static::find()->select('min(orden)')->andWhere(['modo_id'=>$modo_id])->scalar();
        if($stage)return $stage;
        throw new ServerErrorHttpException(m::t('errors', 'Empty stages for this mode {valor}, please fill stages',['valor'=>$modo_id]));
    		   
    }
    
    public static function lastStage($modo_id){
      $stage= static::find()->select('max(orden)')->andWhere(['modo_id'=>$modo_id])->scalar();
        if($stage)return $stage;
        throw new ServerErrorHttpException(m::t('errors', 'Empty stages for this mode {valor}, please fill stages',['valor'=>$modo_id]));
    	
    }
    
     public static function nextStage($stage,$modo_id){
         $lastStage=self::lastStage($modo_id);
      if($stage < $lastStage){
          return static::find()->select('min(orden)')
            ->andWhere(['modo_id'=>$modo_id,])
              ->andWhere(['>','orden',$stage])->scalar();
      }else{//Si es igual a la ultima retornar la misma
          return $stage;
      }
     }
      public static function previousStage($stage,$modo_id){
         $firstStage=self::firstStage($modo_id);
      if($stage > $firstStage){
          return static::find()->select('max(orden)')
            ->andWhere(['modo_id'=>$modo_id,])
              ->andWhere(['<','orden',$stage])->scalar();
      }else{//Si es igual a la ultima retornar la misma
          return $stage;
      }
      
    }
}
