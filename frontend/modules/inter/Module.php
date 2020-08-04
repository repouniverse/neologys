<?php

namespace frontend\modules\inter;
use yii;
/**
 * inter module definition class
 */
class Module extends \yii\base\Module
{
    
   const CLASE_GENERAL='A'; 
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
        Yii::$app->i18n->translations['modules/base/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@frontend/modules/inter/messages',
            'fileMap' => [
                'modules/base/verbs' => 'verbs.php',
                'modules/base/validaciones' => 'validaciones.php',
                'modules/base/labels' => 'labels.php',
               
                
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        
        return Yii::t('modules/base/' . $category, $message, $params, $language);
    }
}
