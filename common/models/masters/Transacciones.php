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
    public $booleanFields=['isauditable'];
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
            [['name','transaccion','esruta','description','grupo','isauditable'], 'safe'],
            [['transaccion'], 'match', 'pattern' => '/^[A-Z0-9]/'],
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
        $scenarios[self::SCENARIO_BASE] = ['name','transaccion','esruta','description','grupo','isauditable'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('base_labels', 'Name'),
            'transaccion' => Yii::t('base_labels', 'Transaction'),
            'isauditable' => Yii::t('base_labels', 'Is Audit'),
            'description' => Yii::t('base_labels', 'Description'),
            'esruta' => Yii::t('base_labels', 'Is Route'),
            'group' => Yii::t('base_labels', 'Group'),
        ];
    }

   public static function find()
    {
        return new TransaccionesQuery(get_called_class());
    }  
}
