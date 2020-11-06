<?php

namespace frontend\modules\inter;
use common\helpers\h;
use common\helpers\FileHelper;
use yii\web\BadRequestHttpException;
USE yii2mod\settings\models\enumerables\SettingType;
use yii;
/**
 * inter module definition class
 */
class Module extends \yii\base\Module
{
    
   const CLASE_GENERAL='A'; 
   const STATUS_GENERAL='1'; 
   const ROL_POSTULANTE='r_inter_postulante';
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
         h::getIfNotPutSetting('general','roleDefault','r_inter_postulante', SettingType::STRING_TYPE);
        /* h::getIfNotPutSetting('general','extensionimagesalu','.jpg', SettingType::STRING_TYPE);
         h::getIfNotPutSetting('general','urlimagesalu','http://desa.itekron.com/fotos/', SettingType::STRING_TYPE);
         h::getIfNotPutSetting('general','prefiximagesalu','', SettingType::STRING_TYPE);
         h::getIfNotPutSetting('general','showImgExternal',true, SettingType::BOOLEAN_TYPE);
   
          h::getIfNotPutSetting('timeUser','hour','hh::ii', SettingType::STRING_TYPE);
        h::getIfNotPutSetting('timeBD','hour','H:i', SettingType::STRING_TYPE);
       
        h::getIfNotPutSetting('sta','extensionimagesalu','.jpg', SettingType::STRING_TYPE);
         h::getIfNotPutSetting('sta','urlimagesalu','http:://www.orce.uni.edu.pe/alumnos/', SettingType::STRING_TYPE);
        */  
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
    
    
   public static function getRolePostulante(){
        $auth = Yii::$app->authManager;
       if(is_null($rol=$auth->getRole(self::ROL_POSTULANTE))){
           $rol=$auth->createRole(self::ROL_POSTULANTE);
           $auth->add($rol);
       }
      return $rol;
       
   }
   
   
   public static function currentPrograma($isModel=false){
     $periodo= h::periodos()->getCurrentPeriod();
     
     $model=models\InterPrograma::find()->andWhere([
         'universidad_id'=>h::currentUniversity(),
         'codperiodo'=>$periodo])->one();
  IF(IS_NULL($model))
     throw new BadRequestHttpException(static::t('errors','There is no Current Programa'));
     if($isModel){
       return $model;
   }else{
       return $model->id;
   }
     
   }
    
}
