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
            'id' => Yii::t('base_labels', 'ID'),
            'model' => Yii::t('base_labels', 'Model'),
            'field' => Yii::t('base_labels', 'Field'),
            'ip' => Yii::t('base_labels', 'IP'),
            'creationdate' => Yii::t('base_labels', 'Creation Date'),
            'controlador' => Yii::t('base_labels', 'Controller'),
            'description' => Yii::t('base_labels', 'Description'),
            'nombrecampo' => Yii::t('base_labels', 'Field Name'),
            'oldvalue' => Yii::t('base_labels', 'Old Value'),
            'newvalue' => Yii::t('base_labels', 'New Value'),
            'username' => Yii::t('base_labels', 'User Name'),
            'metodo' => Yii::t('base_labels', 'Method'),
            'action' => Yii::t('base_labels', 'Action'),
            'clave' => Yii::t('base_labels', 'Key'),
        ];
    }
}
