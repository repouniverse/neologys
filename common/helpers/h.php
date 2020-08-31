<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\masters\Valoresdefault;
use mdm\admin\models\User;
class h {
     const SESION_MALETIN = 'maletin';
     const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';   
   const FLAG_ACTIVE = '1'; 
    const FLAG_INACTIVE = '0'; 

    public static function convert($dateStr, $type='date', $format = null) {
        if ($type === 'datetime') {
              $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        }
        elseif ($type === 'time') {
              $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        }
        else {
              $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }
    
    public static function  app(){
        return yii::$app;
    }
    
    
    
    public static function  db(){
        return yii::$app->db;
    }
    
    public static function  periodos(){
        return yii::$app->periodo;
    }
    
    public static function  session(){
        return yii::$app->session;
    }
    
    public static function  user(){
        
       // var_dump(yii::$app->user);die();
        return yii::$app->user;
    }
    
    public static function  userId($username=null){
      if(!is_null($username)){
          $registro=User::findByUsername($username);
       // User::find()->where(['username'=>trim($username)])->one();
       if(!is_null($registro)){
           return $registro->id;
       }else{
           return null;
       }
      }else{
        return yii::$app->user->identity->id;  
      }
        
    }
    public static function  userName(){
        //var_dump(yii::$app->user->isGuest);die();
        return yii::$app->user->identity->username;
    }
    public static function urlManager(){
        return yii::$app->urlManager;
    }
    public static function mailer(){
        return yii::$app->mailer;
    }
    
    public static function currentController(){
        return Yii::$app->controller->id;
    }
    public static function currentAction(){
        return Yii::$app->controller->action->id;
    }
    
    public static function UserIsGuest(){
        return yii::$app->user->isGuest;
    }
    
    public static function request(){
        return yii::$app->request;
    }
    
    public static function response(){
        return yii::$app->response;
    }
    
    public static function settings(){
        return yii::$app->settings;
    }
    /*  PARA EL MODULO SETTINGS
     * Lee un valor de la tabla Parameters, 
     * si tiene esta llave la devuelve
     * Si no la encuentra devuelve el 
     * parametro $valorsino que ha especificado 
     */
    public static function gsetting($seccion,$llave,$valorsino=null){
        if(yii::$app->settings->has($seccion,$llave))
        return yii::$app->settings->get($seccion,$llave);
        return $valorsino;
    }
    
    
     /*  PARA EL MODULO SETTINGS
     * Lee un valor de la tabla Parameters, 
     * si tiene esta llave la devuelve
     * Si no la encuentra , lo registra con el tercer parametro
     * $valorsino
      *  
     */
    public static function getIfNotPutSetting($seccion,$llave,$valorsino,
            $type=\yii2mod\settings\models\enumerables\SettingType::STRING_TYPE ){
        yii::error('detectando',__FUNCTION__);
        
        yii::$app->settings->invalidateCache(); 
        
        if(yii::$app->settings->has($seccion,$llave)){
            return yii::$app->settings->get($seccion,$llave);        
        }else{
            if(is_null($valorsino)){
               throw new \yii\base\Exception(Yii::t('sta.labels', 'Debe especificar un tercer parametro al usar esta funcion'));
         
            }else{
              yii::$app->settings->set($seccion,$llave,$valorsino); 
               //die();
               return $valorsino;
            }
        }
                
       
    }
    
    public static function nSetting($key){
     return  \yii2mod\settings\models\SettingModel::find()->where(['key'=>$key])->count();
       
    }
    
    
    
    public static function UserLongName(){
        return yii::$app->user->getProfile()->names;
    }
    
    public static function getImageUser($class='user-image'){
        return Html::img('@web/img/anonimo.svg', ['class'=>$class,'alt' => 'User','width'=>40,'height'=>30]);
    }
    
    public static function getCurrencies(){
        return ['PEN'=>yii::t('base.names','NEW PERUVIAN SUN'),'USD'=>yii::t('base.names','AMERICAN DOLAR')];
    }
    
    public static function getFormatShowDate(){
      return h::settings()->get('timeUser','date');
    }
     public static function getFormatShowDateTime(){
      return h::settings()->get('timeUser','datetime');
    }
    
    
    public static function getCurrenciesNames(){
        return array_keys(static::getCurrencies());
    }
    public static function paramGen($codparam,$codcen,$codocu){
        return yii::$app->paramsGen->getP($codparam,$codcen,$codocu);

    }
    
    
    /*
     * Funciones que devuelven arrays para rellenar los combos
     * ma comunes de datos maestros 
     */
    public static function getCboMaterials(){
        return ArrayHelper::map(
                \common\models\masters\Maestrocompo::find()->all(),
                'codart','descripcion');
    }
    
    public static function getCboClipros(){
        return ArrayHelper::map(
                \common\models\masters\Clipro::find()->all(),
                'codpro','despro');
    }
    
    public static function getCboCentros(){
        return ArrayHelper::map(
                \common\models\masters\Centros::find()->all(),
                'codcen','nomcen');
    }
    
    public static function getCboTables(){
        return ArrayHelper::map(
                        \common\models\masters\ModelCombo::find()->all(),
                'parametro','parametro');
    }
    
     public static function getCboValores($tableName){
        return ArrayHelper::map(
     \common\models\masters\Combovalores::find()->where(['[[nombretabla]]'=>$tableName])->all(),
                'codigo','valor');
    }
    
     public static function getCboFavorites($iduser=null){
         $iduser=is_null($iduser)?static::userId():$iduser;        
        return ArrayHelper::map(
                        \common\models\Userfavoritos::find()->where(['[[user_id]]'=>$iduser])->all(),
                'url','alias');
    }
    
    /*Devuelve valores por defecto de cualquier 
     * modelo siempre que se hayan regsitrado estos valores e
     * mediante edfafultvalues 
     */
    public function defaultValues(&$modelo){
        ArrayHelper::map(
                Valoresdefault::find()->where(['[[nombretabla]]'=>$tableName])->all(),
                'codigo','valor');
        
    }
    
     
   
    
   public static function getDimensions(){
       return [
             'E'=> yii::t('base.names','Escalar/Units'),
           'L'=> yii::t('base.names','Lenght'),
           'M'=> yii::t('base.names','Mass'),
           'T'=> yii::t('base.names','Time'),          
            'V'=> yii::t('base.names','Volume'),
           
       ];
   } 
   
   /*Devuelve una ray con documetnos de identidad */
  public static function AdocId(){
      return [
      \BaseHelper::DOC_DNI=>yii::t('base.names','DNI'),
      \BaseHelper::DOC_PASAPORTE=>yii::t('base.names','PASAPORTE'), 
            \BaseHelper::DOC_BREVETE=>yii::t('base.names','BREVETE'),  
                \BaseHelper::DOC_PPT=>yii::t('base.names','PPT'), 
      ];
  }
  
  public static function getNameUserById($id){
     return User::findIdentity($id)->username;
  }
   
 public static function obQuery(){
     return new \yii\db\Query();
 } 
  
 
 public static function hasParametersSettings(){
    $cuantos= \yii2mod\settings\models\SettingModel::find()->count();
     return ($cuantos > 0)?true:false;
 }
 
 public static function awe($font){
     return "<span class='fa fa-".$font."'></span>";
     
    
     
 }
 public static function gly($font){
     return "<span class='glyphicon glyphicon-".$font."'></span>";
     
 }
 
 public static function space($tamano){
     $cadena='';
   if(is_integer($tamano) && $tamano > 0){
     for( $i=1; $i <= $tamano; $i++){
        $cadena.=' ';
    }
    return $cadena;  
   }else{
       return ' ';
   }
     
 }
 
}
?>