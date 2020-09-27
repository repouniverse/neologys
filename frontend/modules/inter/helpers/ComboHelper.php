<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir los combos
 */
namespace frontend\modules\inter\helpers;
use common\helpers\ComboHelper as combo;
use common\helpers\h;
use yii;
use yii\helpers\ArrayHelper;

class ComboHelper  extends combo{
    
 
    
  public static function getCboModos($programa_id=null){
      $query= \frontend\modules\inter\models\InterModos::find();
      if(!is_null($programa_id)){
          $query->andWhere(['programa_id'=>$programa_id]);
      }else{
       $mp=\frontend\modules\inter\models\InterPrograma::find() 
        ->andWhere(['codperiodo'=>h::periodos()->currentPeriod])->one();
        $query->andWhere(['programa_id'=>$mp->id]);  
       }
        return ArrayHelper::map(
                       $query->all(),
                'id','descripcion');
    }  
    
    
    public static function getCboProgramas(){
      $query= \frontend\modules\inter\models\InterPrograma::find();
      
        return ArrayHelper::map(
                       $query->all(),
                'id','descripcion');
    }   
    
    public static function getCboEtapas($modo_id=null){
      if(is_null($modo_id)){
        $query= \frontend\modules\inter\models\InterEtapas::find();
       
      }else{
         $query= \frontend\modules\inter\models\InterEtapas::find()->andWhere(['modo_id'=>$modo_id]);
       
      }
       
      
        return ArrayHelper::map(
                       $query->all(),
                'id','descripcion');
    }  
    
   public static function getCboEvaluadores($programa_id){
      $query= \frontend\modules\inter\models\InterEvaluadores::find()->andWhere(['programa_id'=>$programa_id]);
      
        return ArrayHelper::map(
                       $query->all(),
                'id','descripcion');
    }  
    
     public static function getCboStages($modo_id){
      $query= \frontend\modules\inter\models\InterEtapas::find()->andWhere(['modo_id'=>$modo_id]);
      
        return ArrayHelper::map(
                       $query->all(),
                'id','descripcion');
    }  
    
    public static function getCboStatusConvocado(){
       return [
       \frontend\modules\inter\models\InterConvocados::FLAG_ACTIVO=>'En proceso',
       \frontend\modules\inter\models\InterConvocados::FLAG_ADMITIDO=>'Admitido', 
         \frontend\modules\inter\models\InterConvocados::FLAG_ELIMINADO=>'Eliminado', 
       ]; 
    }
}