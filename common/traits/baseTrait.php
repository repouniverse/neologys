<?php
namespace common\traits;
use yii;
trait baseTrait
{

    
    
    public function init(){
             
        return parent::init();
    }
    
    public function hasM(){
        return yii::$app->hasModule('settings');
    }
    
    public function hasParameterSetting($grupo,$nameParameter){
        if($this->hasM()){
            //yii::$app->settings->invalidateCache();
            if(yii::$app->settings->has($grupo,$nameParameter))
              return true;
            return false;
        }else{
            throw new \yii\base\Exception(Yii::t('base.errors', 'The module \'Settings\' doesn\'t exists '));
         }
    } 
    
    public function hasValidParameterSetting($grupo,$nameParameter,$error=false){
       
        if($this->hasParameterSetting($grupo,$nameParameter)){
           if(!is_null(yii::$app->settings->get($grupo,$nameParameter)))
                   
          return true;
         else{
            if ($error) {
               throw new \yii\base\Exception(yii::t('base.errors',' Parameter \'{grupo}\\{parameter}\'  is empty   in settings module, please fill this parameter',['parameter'=>$nameParameter,'grupo'=>$grupo]));      
           
            }else{
                return false;
            }
         } 
        } else{
            if ($error) {
            throw new \yii\base\Exception(yii::t('base.errors',' Parameter \'{grupo}\\{parameter}\'  not registered  in settings module, please register this parameter',['parameter'=>$nameParameter,'grupo'=>$grupo]));      
           }else{
                return false;
            }
        }
           
       
    } 
    
    public function gsetting($grupo,$nameParameter){
        if($this->hasValidParameterSetting($grupo,$nameParameter,true))
            return yii::$app->settings->get($grupo,$nameParameter);
         
         }
         
     public function gSettingSafe($grupo,$nameParameter,$defaultvalue){
        if($this->hasParameterSetting($grupo, $nameParameter))
            return yii::$app->settings->get($grupo,$nameParameter);
          return $defaultvalue;
         
         }    
         

  public function psetting($grupo,$nameParameter,$value,$type='string'){        
            return yii::$app->settings->set($grupo,$nameParameter,$value,$type);

  }
  
  
  /*
   * Devuelve el valor de un parametro 
   */
  public function getPm($codparam,$codcen,$codocu=null){
      
  }

}
