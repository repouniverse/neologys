<?php
namespace backend\modules\base;
USE yii2mod\settings\models\enumerables\SettingType;
use common\helpers\h;
use yii;
/**
 * base module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\base\controllers';

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
         h::getIfNotPutSetting('mail','servermail',"smtp.googlemail.com", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('mail','userservermail',"neotegnia@gmail.com", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('mail','passworduserservermail',"tomasgrecia_1", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('mail','portservermail',465, SettingType::STRING_TYPE);
        
        
        
         h::getIfNotPutSetting('timeUser','datetime','dd/mm/yyyy hh:ii:ss', SettingType::STRING_TYPE);
       
        h::getIfNotPutSetting('timeUser','date',"dd/mm/yyyy", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('timeUser','datetime','dd/mm/yyyy hh:ii:ss', SettingType::STRING_TYPE);
         h::getIfNotPutSetting('timeBD','date',"Y-m-d", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('timeBD','datetime','Y-m-d h:i:s', SettingType::STRING_TYPE);
        
        }
    
    
    
    public function registerTranslations()
    {
        yii::$app->i18n->translations['modules/base/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@backend/modules/base/messages',
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
