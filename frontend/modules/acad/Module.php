<?php

namespace frontend\modules\acad;
use common\helpers\h;
USE yii2mod\settings\models\enumerables\SettingType;
/**
 * acad module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\acad\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
       h::getIfNotPutSetting('general','MainUniversity',1, SettingType::INTEGER_TYPE);
        

        // custom initialization code goes here
    }
}
