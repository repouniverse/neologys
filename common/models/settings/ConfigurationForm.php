<?php

namespace common\models\settings;

use Yii;
use yii\base\Model;

class ConfigurationForm extends Model
{
    /**
     * @var string application name
     */
    public $appName;

    /**
     * @var string admin email
     */
    public $adminEmail;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['appName', 'adminEmail'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'appName' => Yii::t('base_names', 'Application Name'),
            'adminEmail' => Yii::t('base_names', 'Admin Email'),
        ];
    }
}

