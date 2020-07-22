<?php

namespace common\models\audit;

use Yii;

/**
 * This is the model class for table "{{%activerecordlog}}".
 *
 * @property string $id
 * @property string $model
 * @property string $field
 * @property string $ip
 * @property string $creationdate
 * @property string $controlador
 * @property string $description
 * @property string $nombrecampo
 * @property string $oldvalue
 * @property string $newvalue
 * @property string $username
 * @property string $metodo
 * @property string $action
 * @property string $clave
 */
class Activerecordlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activerecordlog}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave'], 'string'],
            [['field', 'nombrecampo'], 'string', 'max' => 45],
             [['model'], 'string', 'max' => 100],
            [['ip', 'creationdate'], 'string', 'max' => 20],
            [['controlador'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 105],
            [['oldvalue', 'newvalue'], 'string', 'max' => 80],
            [['username'], 'string', 'max' => 30],
            [['metodo'], 'string', 'max' => 7],
            [['action'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.labels', 'ID'),
            'model' => Yii::t('base.labels', 'Model'),
            'field' => Yii::t('base.labels', 'Campo'),
            'ip' => Yii::t('base.labels', 'IP'),
            'creationdate' => Yii::t('base.labels', 'Cuándo'),
            'controlador' => Yii::t('base.labels', 'Controlador'),
            'description' => Yii::t('base.labels', 'Description'),
            'nombrecampo' => Yii::t('base.labels', 'Campo'),
            'oldvalue' => Yii::t('base.labels', 'Val.Previo'),
            'newvalue' => Yii::t('base.labels', 'Val. Actual'),
            'username' => Yii::t('base.labels', 'Usuario'),
            'metodo' => Yii::t('base.labels', 'Metodo'),
            'action' => Yii::t('base.labels', 'Action'),
            'clave' => Yii::t('base.labels', 'Clave'),
        ];
    }
}
