<?php

namespace common\models\masters;
use backend\modules\base\Module AS m;
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
            'id' => m::t('labels', 'ID'),
            'type' => m::t('labels', 'Type'),
            'section' => m::t('labels', 'Section'),
            'key' => m::t('labels', 'Key'),
            'value' => m::t('labels', 'Value'),
            'status' => m::t('labels', 'Status'),
            'description' => m::t('labels', 'Description'),
            'created_at' => m::t('labels', 'Created At'),
            'updated_at' => m::t('labels', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SettingGenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingGenQuery(get_called_class());
    }
}
