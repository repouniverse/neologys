<?php

namespace frontend\modules\maestros;

/**
 * maestros module definition class
 */
class MaestrosModule extends \yii\base\Module
{
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
        // custom initialization code goes here
    }
    
     public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/inter/*'] = [
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
