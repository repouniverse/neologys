<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property int $id
 * @property string $type
 * @property string $section
 * @property string $key
 * @property string $value
 * @property int $status
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 */
class SettingsGen extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'section', 'key', 'value', 'created_at', 'updated_at'], 'required'],
            [['value'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['section', 'key', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => yii::t('base.labels', 'ID'),
            'type' => yii::t('base.labels', 'Type'),
            'section' => yii::t('base.labels', 'Section'),
            'key' => yii::t('base.labels', 'Key'),
            'value' => yii::t('base.labels', 'Value'),
            'status' => yii::t('base.labels', 'Status'),
            'description' => yii::t('base.labels', 'Description'),
            'created_at' => yii::t('base.labels', 'Created At'),
            'updated_at' => yii::t('base.labels', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SettingGenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingsGenQuery(get_called_class());
    }
}
