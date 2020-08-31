<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%periodos}}".
 *
 * @property string $codperiodo
 * @property string|null $periodo
 * @property string|null $activa
 * @property int|null $tolerancia
 */
class Periodos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%periodos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codperiodo'], 'required'],
            [['tolerancia'], 'integer'],
            [['codperiodo'], 'string', 'max' => 10],
            [['periodo'], 'string', 'max' => 40],
            [['activa'], 'string', 'max' => 1],
            [['codperiodo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codperiodo' => Yii::t('base_labels', 'Period Code'),
            'periodo' => Yii::t('base_labels', 'Period'),
            'activa' => Yii::t('base_labels', 'Active'),
            'tolerancia' => Yii::t('base_labels', 'Tolerance'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PeriodosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeriodosQuery(get_called_class());
    }
    
   
    public function arrayPeriodos(){
        return  static::find()->select(['codperiodo', 'periodo', 'activa'])->asArray()->all();
        
    }
}
