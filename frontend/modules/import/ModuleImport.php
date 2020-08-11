<?php
namespace frontend\modules\import;
use common\filters\FilterAccess;
use common\helpers\h;
USE yii2mod\settings\models\enumerables\SettingType;
use yii;
/**
 * import module definition class
 */
class ModuleImport extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\import\controllers';

    /**
     * {@inheritdoc}
     */
   public function behaviors(){
        return[
            [
            'class' => FilterAccess::className(), 
              //'except' => ['default/complete'],
            ],
        ];
    }  
        
       

    
    public function init()
    {
        parent::init();
         $this->registerTranslations();
        static::putSettingsModule();
        static::pustCsvDirectory();
    }
    
    private static function putSettingsModule(){
         h::getIfNotPutSetting('import','pathToCsvExamples',"/impoexamples", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('import','delimiterCsv',',', SettingType::STRING_TYPE);
        h::getIfNotPutSetting('import','encapsulatorCsv','', SettingType::STRING_TYPE);
         ///h::getIfNotPutSetting('import','prefiximagesalu','0060', SettingType::STRING_TYPE);
    }
    private static function pustCsvDirectory(){
       $path=yii::getAlias('@app').h::gsetting('import','pathToCsvExamples');
      
       if(!is_dir($path)){
           \common\helpers\FileHelper::createDirectory ($path);
    }}
    
    public static function getPathCsv(){
       return yii::getAlias('@app').h::gsetting('import','pathToCsvExamples'); 
    }
    
   public function registerTranslations()
    {
        yii::$app->i18n->translations['modules/import/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@frontend/modules/import/messages',
            'fileMap' => [
                'modules/import/m_import' => 'm_import.php',
                
               
                
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        
        return Yii::t('modules/import/' . $category, $message, $params, $language);
    }
      
}
