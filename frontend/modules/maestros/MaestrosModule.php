<?php

namespace frontend\modules\maestros;
use yii;
/**
 * maestros module definition class
 */
class MaestrosModule extends \yii\base\Module
{
   const CLASE_GENERAL='A'; 
   const STATUS_GENERAL='1';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\maestros\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        static::putSettingsModule();
        // custom initialization code goes here
    }
    
    private static function putSettingsModule(){
         //h::getIfNotPutSetting('mail','servermail',"smtp.googlemail.com", SettingType::STRING_TYPE);
          
        }
    
     public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/maestros/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@frontend/modules/maestros/messages',
            'fileMap' => [
                'modules/maestros/verbs' => 'verbs.php',
                'modules/maestros/validaciones' => 'validaciones.php',
                'modules/maestros/labels' => 'labels.php',
               
                
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        
        return Yii::t('modules/maestros/' . $category, $message, $params, $language);
    }
}
