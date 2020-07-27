<?php
namespace backend\modules\base;
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
    }
    
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/base/*'] = [
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
