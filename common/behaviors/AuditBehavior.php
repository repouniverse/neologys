<?php
/**
 * Created by Jramirez
 * User: Алимжан
 * Date: 20.11.2018
 * Time: 12:24
 */

namespace common\behaviors;
use yii;
use yii\base\Behavior;
use yii\helpers\Json;
use common\models\audit\Activerecordlog;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;
use yii\base\Exception;

class AuditBehavior extends Behavior
{
    const ES_GET='GET';
    const ES_POST='POST';
    const ES_AJAX='AJAX';
    const ES_PAJAX='PAJAX';
     const ES_UNKNOWN='UNKNOWN';
     const ES_NUEVO='CREATE';
     const NO_ES_NUEVO='UPDATE';
     const ES_BORRADO='DELETE';
    // public $_owner=null;
     
     public function username(){
         $identidad=yii::$app->user->identity;
         if(is_object($identidad)){
           $username=$identidad->username;  
         }else{
           $username='ANONIMO';  
         }
         
         RETURN $username;
     }
     
   public function events()
    {
        
         
       return  [
         //  ActiveRecord::EVENT_BEFORE_INSERT => 'doBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'doBeforeSave',
            ActiveRecord::EVENT_BEFORE_DELETE => 'doBeforeDelete',
            ActiveRecord::EVENT_AFTER_INSERT => 'doAfterInsert',
            //ActiveRecord::EVENT_AFTER_UPDATE => 'doAfterSave',
           // ActiveRecord::EVENT_AFTER_DELETE => 'doAfterDelete'
        ];
      
       return parent::events();
    }
    
    
    /*Par evitar llamar
   public function getOwner(){
      if(is_null($this->_owner)){
         $this->_owner=$this->owner; 
      }else{
         return $this->_owner; 
      }
   }
    
     * 
     * 
     * 
     * 
     */
    /*
     * Se ejecuta previamente a un evento de insertar o modificar
     * SI NO ESTA DENTRO DE UNA TRANSACCION:: NO HACE NADA 
     */
    
    public function doBeforeSave(){
        //echo "hola"; die();
     //if($this->isInTransaction())
       $owner=$this->owner; 
      if(Yii::$app instanceof Yii\web\Application){
       $ip=yii::$app->request->getRemoteIP();   
      }else{
         $ip='';     
      }
          
       //$username=yii::$app->user->identity->username;
      $username=$this->username();
       $controllerId=yii::$app->controller->id;
       $currentUrl=Yii::$app->request->getUrl();
     
       foreach($owner->attributes as $attribute=>$value){
           //yii::error($attribute);
          if($this->hasChanged($attribute)){ 
              // yii::error('este atributo ha cambiado  '.$attribute);
             //ECHO '<br><br>'.$attribute;
              $model=New Activerecordlog();
               $model=$this->setLogValues($model,$attribute,
            false,
            $owner,
            $username,
            false,
            $ip,
            $controllerId,
            $currentUrl  
                       );
                //yii::error('grabando');
              try{
                        if(!$model->save()){
                  //yii::error('huboerror'); 
                   //yii::error($model->getErrors());
                         throw new ServerErrorHttpException(Yii::t('models.errors', 'NO SE PUDO GRABAR  '.serialize($model->geterrors())));
                         }else{
             //yii::error('grabo'); 
                        }
                  } catch (Exception $ex) {
                      $MENSAJE=$ex->getMessage();
                      yii::error('ActiveRecordLog-Se ha presentado un error',__FUNCTION__);
                      yii::error(substr($MENSAJE,0,100),__FUNCTION__);
                      
                      //echo $ex->getMessage(); die();
                     
                   }
          }       
       } 
      
    }
    
    
    public function doAfterInsert(){
     //if($this->isInTransaction())
       $owner=$this->owner;
         $owner=$this->owner;
         if(Yii::$app instanceof Yii\web\Application){
       $ip=yii::$app->request->getRemoteIP();   
      }else{
         $ip='';     
      }
      //$username=yii::$app->user->identity->username;
      $username=$this->username();
       $controllerId=yii::$app->controller->id;
       $currentUrl=Yii::$app->request->getUrl();
       $arrttribute=array_keys($owner->getPrimaryKey(true));
       $attribute= $arrttribute[0];
         $model=New Activerecordlog();
          $model=$this->setLogValues($model,$attribute,
            false,
            $owner,
            $username,
            true,
            $ip,
            $controllerId,
            $currentUrl );
         //yii::error('grabando');
         try{
               if(!$model->save()){
                      //yii::error($model->getErrors());
                    throw new ServerErrorHttpException(Yii::t('models.errors', 'NO SE PUDO GRABAR  '.serialize($model->geterrors())));
                       }else{
                      // yii::error('grabo'); 
                  } 
         } catch (Exception $ex) {
             
            $MENSAJE=$ex->getMessage();
                      yii::error('ActiveRecordLog-Se ha presentado un error',__FUNCTION__);
                      yii::error(substr($MENSAJE,0,100),__FUNCTION__);
                      
             
             
            
         }
        
    }
    
    
    
    
    public function doBeforeDelete(){
       // if($this->isInTransaction()){
         $model=New Activerecordlog();
           $owner=$this->owner;
         if(Yii::$app instanceof Yii\web\Application){
       $ip=yii::$app->request->getRemoteIP();   
      }else{
         $ip='';     
      }
      //$username=yii::$app->user->identity->username;
      $username=$this->username();
       $controllerId=yii::$app->controller->id;
       $currentUrl=Yii::$app->request->getUrl();
       foreach($this->owner->attributes as $attribute=>$value){
          
              $model=$this->setLogValues($model,$attribute,
            true,
            $owner,
            $username,
            false,
            $ip,
            $controllerId,
            $currentUrl  );              
              $model->save();
                }
           
         RETURN TRUE;
       }
    
    
    private function setLogValues(&$model,
            $attribute,
            $delete=false,
            $owner,
            $username,
            $insert=false,
            $ip,
            $controllerId,
            $currentUrl 
            ){
        //$owner=$this->owner;
        //$username=yii::$app->user->identity->username;
          
        $identidad=$owner->getPrimaryKey().'';
        $oldValue=$owner->getOldAttribute($attribute).'';
       //$oldValue=$owner->getOldAttribute($attribute).'';
        if(strlen($oldValue)>80){
          $oldValue=substr($oldValue,0,80);  
        }
        $newValue=$owner->{$attribute}.'';
       
         //$newValue=$owner->{$attribute}.'';
        if(strlen($newValue)>80){
          $newValue=substr($newValue,0,80); 
        }
   /* print_r([
            'model'=>$owner::className(),
            'clave'=>$identidad,
            'field'=>$attribute,
            'ip'=>trim($ip),
            'creationdate'=>date('Y-m-d H:i:s'),
            //'ip'=>yii::$app->request->getUrl(),
            'controlador'=>$controllerId,
            'description'=>substr($currentUrl,0,105),
            'nombrecampo'=>substr($owner->getAttributeLabel($attribute),0,45),
            'oldvalue'=>$oldValue,
            'newvalue'=>$newValue,
             'username'=>$username, 
              'metodo'=> $this->getTypeRequest(),
               ]);die();*/
        
       
        $model->setAttributes([
            'model'=>$owner::className(),
            'clave'=>$identidad/*Json::encode($this->owner->getPrimaryKey(true))*/,
            'field'=>$attribute,
            'ip'=>trim($ip),
            'creationdate'=>date('Y-m-d H:i:s'),
            //'ip'=>yii::$app->request->getUrl(),
            'controlador'=>$controllerId,
            'description'=>substr($currentUrl,0,105),
            'nombrecampo'=>substr($owner->getAttributeLabel($attribute),0,45),
            'oldvalue'=>$oldValue,
            'newvalue'=>$newValue,
             'username'=>$username, 
              'metodo'=> $this->getTypeRequest(),
               ]);
           if(!$delete){
               
               $model->action=($insert)?static::ES_NUEVO:static::NO_ES_NUEVO;
           }else{
               $model->action=static::ES_BORRADO;
           }          
            return $model;
    }
    
    private function getTypeRequest(){
        if(yii::$app->request->isAjax) return static::ES_AJAX;
        elseif(yii::$app->request->isPjax) return static::ES_PAJAX;
        elseif(yii::$app->request->isGet) return static::ES_GET;
        elseif(yii::$app->request->isPost) return static::ES_POST;
        else return static::ES_UNKNOWN;
    }
    
    
    private function hasChanged($attribute){
     if($this->owner->hasMethod('hasChanged')){
        // yii::error('tiene metodo has cange  '.$attribute);
        return $this->owner->hasChanged($attribute);       
     } else{
       return (!($this->owner->{$attribute}==$this->owner->getOldAttribute($attribute)));
     
     } 
        }

    
    private function isInTransaction(){
        return !is_null($this->owner->getDb()->getTransaction());
    }
    
   
  
}