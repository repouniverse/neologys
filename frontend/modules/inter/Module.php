<?php

namespace frontend\modules\inter;
use common\helpers\h;
use common\helpers\FileHelper;
USE yii2mod\settings\models\enumerables\SettingType;
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
             // h::getIfNotPutSetting('sta','formatDateFullCalendar',"YYYY-MM-DD HH:mm:ss", SettingType::STRING_TYPE);
       h::getIfNotPutSetting('sta','prefiximagesalu','60', SettingType::STRING_TYPE);
        
        h::getIfNotPutSetting('sta','extensionimagesalu','.jpg', SettingType::STRING_TYPE);
         h::getIfNotPutSetting('sta','urlimagesalu','http:://www.orce.uni.edu.pe/alumnos/', SettingType::STRING_TYPE);
          // h::getIfNotPutSetting('sta','showImgOrce',true, SettingType::BOOLEAN_TYPE);
    
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
