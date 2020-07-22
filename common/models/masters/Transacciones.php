<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%combovalores}}".
 *
 * @property int $id
 * @property string $nombretabla
 * @property string $codcen
 * @property string $codigo
 * @property string $valor
 * @property string $valor1
 * @property string $valor2
 *
 * @property Centros $codcen0
 */
class Transacciones extends \common\models\base\modelBase
{
  
    const SCENARIO_BASE='base';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }
  public function behaviors() {
        return [          
            'auditoriaBehavior' => [
                'class' => '\common\behaviors\AuditBehavior',
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','transaccion','esruta','description','grupo'], 'safe'],
            [['codigo'], 'match', 'pattern' => '/^[A-Z0-9]/'],
            //[['codcen'], 'string', 'max' => 5],
            //[['nombretabla', 'codigo'], 'unique', 'targetAttribute' => ['nombretabla', 'codigo']],
           // [['codigo', 'valor1', 'valor2'], 'string', 'max' => 3],
            //[['valor'], 'string', 'max' => 60],
            //[['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
        ];
    }
 public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios[self::SCENARIO_BASE] = ['name','transaccion','esruta','description','grupo'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('base.labels', 'Name'),
            'transaccion' => Yii::t('base.labels', 'Transaction'),
            'description' => Yii::t('base.labels', 'Description'),
            'esruta' => Yii::t('base.labels', 'Is Route'),
            'group' => Yii::t('base.labels', 'Group'),
        ];
    }

    
}
