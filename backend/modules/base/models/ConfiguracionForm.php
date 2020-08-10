<?php

namespace backend\modules\base\models;
use backend\modules\base\Module as m;
use Yii;
use yii\base\Model;

class ConfiguracionForm extends Model
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
            'appName' => m::t('labels', 'Application Name'),
            'adminEmail' => m::t('labels', 'Admin Email'),
        ];
    }
}


