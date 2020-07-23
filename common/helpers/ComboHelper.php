<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir los combos
 */
namespace common\helpers;
use yii;
use yii\helpers\ArrayHelper;

class ComboHelper  {
    
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
    
     public static function getCboDocuments($iduser=null){
         //$iduser=is_null($iduser)?static::userId():$iduser;        
        return ArrayHelper::map(
                        \common\models\masters\Documentos::find()->all(),
                'codocu','desdocu');
    }
    
    
      public static function getCboDepartamentos(){
         //$iduser=is_null($iduser)?static::userId():$iduser;        
        return ArrayHelper::map(
                        \common\models\masters\Ubigeos::find()->
                all(),
            'coddepa','departamento');
      }
        
       public static function getCboProvincias($depa){
         //$iduser=is_null($iduser)?static::userId():$iduser;        
        return ArrayHelper::map(
                        \common\models\masters\Ubigeos::find()
                ->where(['coddepa'=>$depa])->all(),
                'codprov','provincia');
    }
    
     public static function getCboDistritos($prov){
         //$iduser=is_null($iduser)?static::userId():$iduser;        
        return ArrayHelper::map(
                        \common\models\masters\Ubigeos::find()
                ->where(['codprov'=>$prov])->all(),
                'coddist','distrito');
    }
    
    /*ESTA FUNCION ES DE PRPISTO GENERAL 
     * RECIBE EL NOBRE DE UNA CLASE 
     * CON EL CAMO CLAVE Y CAMPO REFERENCIA
     * Y UN VALOR DE FILTRO  Y CON ESTO DEVUEL UN ARRAY D
     * DE VALORES 
     */
    public static function getCboGeneral($valorfiltro,$clase,$campofiltro,$campokey,$camporef){
         //$iduser=is_null($iduser)?static::userId():$iduser;   
        if(empty($campofiltro))
            return ArrayHelper::map(
                        $clase::find()->all(),
                $campokey,$camporef);
        return ArrayHelper::map(
                        $clase::find()->where([$campofiltro=>$valorfiltro])->all(),
                $campokey,$camporef);
    }
    
    
    
    
   /*
    * Obtiene todos los nombres de los modelos de la aplicacion
    */
    public static function getCboModels(){
             
       /* return array_combine(
                        \common\helpers\FileHelper::getModels(),
                \common\helpers\FileHelper::getModels());*/
        $paths= \common\helpers\FileHelper::getModels();
             return self::map_models($paths);
    }
    
    
     /*
    * Obtiene todos los nombres de los modelos de un modulo
    */
    public static function getCboModelsByModule($moduleName){
             $paths=\common\helpers\FileHelper::getModelsByModule($moduleName);
             return self::map_models($paths);
        /*return array_combine(
                        \common\helpers\FileHelper::getModelsByModule($moduleName),
                \common\helpers\FileHelper::getModelsByModule($moduleName));*/
    }
    
    /*Funcion que arregla las rutas con los nombres de las tablas
     * 
     */
    
    private function map_models($paths){
       /*$paths=(!is_null($moduleName))?\common\helpers\FileHelper::getModelsByModule($moduleName):
         \common\helpers\FileHelper::getModels();
        */
        $models=[];
        foreach($paths as $clave=>$valor){
            $models[$valor]=\common\helpers\FileHelper::getShortName($valor);
        }
        asort($models);
      
       return $models;
      
    }
    
     /*
    * Obtiene todos los nombres de los modelos de la aplicacion
    */
    public static function getCboRoles(){
           $roles= array_keys(yii::$app->authManager->getRoles());
        return array_combine($roles,$roles);
    }
   
    /*
     * Obtiene los valores masters de la tabla combovalores
     * @key: clave para filtrar los datos 
     * @codcentro: Opcional para filtrar un parametro que depende del centro 
     */
    public static function getTablesValues($key,$codcentro=null){
       // echo \common\models\masters\Combovalores::find()->where(['[[nombretabla]]'=> strtolower($key)])->createCommand()->getRawSql();die();
        if(is_null($codcentro))
        return ArrayHelper::map(
       \common\models\masters\Combovalores::find()->where(['[[nombretabla]]'=> strtolower($key)])->all(),
               'codigo','valor');
       return ArrayHelper::map(
       \common\models\masters\Combovalores::find()->where(
               [
                   '[[nombretabla]]'=> strtolower(trim($key)),
                   '[[codcen]]'=>trim($codcentro)
                   ])->all(),
               'codigo','valor');  
        
   }
   
   
   
    /*
    * Obtiene todos los nombres de los modelos de la aplicacion
    */
    public static function getCboUms(){
         return ArrayHelper::map(
                        \common\models\masters\Ums::find()->all(),
                'codum','desum');
    }
   
   public static function getCboSex(){
         return [
                'M'=>yii::t('base.names','MASCULINO'),
                'F'=>yii::t('base.names','FEMENINO'),
             'G'=>yii::t('base.names','GENERAL'),
                        ];
    }
    
     public static function getCboBancos(){
         return ArrayHelper::map(
                        \common\models\masters\Bancos::find()->all(),
                'id','nombre');
    }
    
    public static function getCboMonedas(){
         return ArrayHelper::map(
                        \common\models\masters\Monedas::find()->all(),
                'codmon','codmon');
    }
    
     /*
      * Obtiene los valores de los camos de un modelo
      * solo hay que darlela ruta del nombre de la clase 
      */
    public function getCboCamposFromTable($nombreclase){
        $modelo=new $nombreclase();
        $valores=[];
        foreach(array_keys($modelo->attributes) as $key=>$attribute){
            $valores[$attribute]=$modelo->getAttributeLabel($attribute);
        }
        return $valores;
    }
}