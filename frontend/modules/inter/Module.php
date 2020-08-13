<?php

namespace frontend\modules\inter;
use yii;
/**
 * inter module definition class
 */
class Module extends \yii\base\Module
{
    
   const CLASE_GENERAL='A'; 
   const STATUS_GENERAL='1'; 
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\inter\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
       parent::init();
        $this->registerTranslations();
        static::putSettingsModule();
    }
    
    
    
    private static function putSettingsModule(){
         //h::getIfNotPutSetting('mail','servermail',"smtp.googlemail.com", SettingType::STRING_TYPE);
          
        }
    
    
    
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/inter/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@frontend/modules/inter/messages',
            'fileMap' => [
                'modules/inter/verbs' => 'verbs.php',
                'modules/inter/validaciones' => 'validaciones.php',
                'modules/inter/labels' => 'labels.php',
               
                
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        
        return Yii::t('modules/inter/' . $category, $message, $params, $language);
    }
}
