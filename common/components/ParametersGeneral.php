<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\components;
 use yii\base\Exception;
 use common\models\config\Parametroscentros;
  use common\models\config\Parametroscentrosdocu;
  use common\models\config\Parametros;
//use yii\db\Connection as conexion;
//use common\traits\baseTrait;
//use backend\components\Installer;
class ParametersGeneral extends \yii\base\Component
{
  //use baseTrait;
    public function init(){
          
        return parent::init();
    }
 public function getP($codparam=null,$codcen=null,$codocu=null){
     if(is_null($codparam))        
        throw new Exception(yii::t('base.errors','The "codparam" parameter is not defined'));
      if(is_null($codcen))
          throw new Exception(yii::t('base.errors','The "codcen" parameter is not defined'));
     if(is_null($codocu)){
         return $this->getParamCentro($codparam, $codcen);
     }else{// si estan los 3 parametros 
         return $this->getParamCentroDocu($codparam,$codcen,$codocu);
     }
 }
    
 private function getParamCentro($codparam,$codcen){
     $model= Parametroscentros::findOne(['codcen'=>$codcen,'codparam'=>$codparam]);
     if(!is_null($model)){
         return $model->getValue();
     }else{
        throw new Exception(yii::t('base.errors','Value for parameter "{parameter}" and center "{center}" Not found',['parameter'=>$codparam,'center'=>$codcen]));
     
     }
 }
 
 private function getParamCentroDocu($codparam,$codcen,$codocu){
     $model= Parametroscentrosdocu::findOne(['codcen'=>$codcen,'codocu'=>$codocu,'codparam'=>$codparam]);
    // var_dump($model);
     if(!is_null($model)){
        //var_dump($model->getValue());
         return $model->getValue();
     }else{
         //Si no encuentra buscarlo en la tabla paraetrso centros 
        return $this->getParamCentro($codparam, $codcen);
        throw new Exception(yii::t('base.errors','Value for parameter "{parameter}" and center "{center}" and document "{document}" Not found',['parameter'=>$codparam,'center'=>$codcen,'document'=>$codocu]));
     
     }
 }
 
}
