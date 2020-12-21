<?php

namespace frontend\modules\repositorio;
use common\models\masters\PlanesEstudio;
use yii\helpers\ArrayHelper;
/**
 * repositorio module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    const PROCESO_TALLER_TESIS='100';
    //const PROCESO_TALLER_TESIS='100';
    public $controllerNamespace = 'frontend\modules\repositorio\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public static function getCursosTalleres($tipoproceso){
       $filas= PlanesEstudio::find()->
        select(['curso_id','codcurso'])->andWhere(['tipoproceso'=>$tipoproceso])->all();
       return ArrayHelper::map($filas,'curso_id','codcurso');
       
        
    }
    
    // PARA REGISTRAR EL DICCIONARIO
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/repositorio/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@frontend/modules/repositorio/messages',
            'fileMap' => [
                'modules/repositorio/verbs' => 'verbs.php',
                'modules/repositorio/validaciones' => 'validaciones.php',
                'modules/repositorio/labels' => 'labels.php',
                'modules/repositorio/errors' => 'errors.php',
               'modules/repositorio/mails' => 'mails.php',
                
            ],
        ];
    }

    //PARA LLAMAR AL DICCIONARIO
    public static function t($category, $message, $params = [], $language = null)
    {
        
        return Yii::t('modules/repositorio/' . $category, $message, $params, $language);
    }
    
    
    
}
