<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%userfavoritos}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $url
 * @property string $ishome
 * @property int $order
 */
class Userfavoritos extends \common\models\base\modelBase
{
  public  $booleanFields=['ishome'];
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%userfavoritos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'order'], 'integer'],
            [['url'], 'string', 'max' => 125],
             [['url','alias'], 'string', 'max' => 125],
             [['url','alias','ishome'], 'safe'],
            //[['ishome'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'user_id' => Yii::t('base.names', 'User ID'),
            'url' => Yii::t('base.names', 'Url'),
            'ishome' => Yii::t('base.names', 'Inicio'),
            'order' => Yii::t('base.names', 'Order'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserfavoritosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserfavoritosQuery(get_called_class());
    }
    
    public function setHomeUrl(){
        
       // $transac=$this->getDb()->beginTransaction();
       
       $this->updateAll(['ishome'=>'0'], ['user_id'=>\common\helpers\h::userId()]);
        $this->ishome=true;
        if($this->save()){
         // var_dump($this->getErrors());die();    
        }else{
          var_dump($this->getErrors());die();  
        }
       //  var_dump($this->save(),$this->getErrors());die();
       //$transac->commit();
        return true;
    }
}
