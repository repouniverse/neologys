<?php

namespace common\models\masters;
use backend\modules\base\Module AS m;
use Yii;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property int $id
 * @property string $parametro
 * @property string $clavecentro
 */
class ModelCombo extends \common\models\base\modelBase
{
  
    public function behaviors() {
        return [          
            'auditoriaBehavior' => [
                'class' => '\common\behaviors\AuditBehavior',
            ],
        ];
    }
    
    
   // public $nombreModelo=null;
   // public $nombreCampo=null;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreCampo','nombreModelo'], 'required'],
             [['nombreCampo','nombreModelo'], 'safe'],
            [['nombreCampo','nombreModelo'], 'unique','targetAttribute'=>'nombreCampo'],
            [['parametro'], 'string', 'max' => 40],
            [['parametro'], 'unique'],
            [['clavecentro'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => yii::t('base_labels', 'ID'),
            'parametro' => yii::t('base_labels', 'Parameter'),
            'clavecentro' => yii::t('base_labels', 'Center Key'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ModelComboQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModelComboQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
       
            //$this->parametro= \common\helpers\FileHelper::getShortName($this->nombreModelo).'.'.$this->nombreCampo;
           $nombreModelo=$this->nombreModelo;
           
        $this->parametro= $nombreModelo::RawTableName().'.'.$this->nombreCampo;
           
//var_dump($this->parametro,$this->nombreModelo,$this->nombreCampo);die();
       
        return parent::beforeSave($insert);
    }
    
    public function afterFind() {
        // $model->parametro=$model->nombreModelo.'.'.$model->nombreCampo;
        //$this->nombreModelo=substr($this->parametro,0, strpos($this->parametro, '.'));
       // $this->nombreCampo=substr($this->parametro,strpos($this->parametro, '.')+1);
       //var_dump($this->nombreModelo,$this->nombreCampo);
        return parent::afterFind();
    }
}
