<?php
/**
 * Created by Jramirez
 * User: 
 * Date: 20.11.2018
 * Time: 12:24
 */

namespace common\components;
use yii;
use yii\base\Behavior;
use yii\helpers\Json;
use common\models\audit\Activerecordlog;
use yii\db\ActiveRecord;
use \yii\web\ServerErrorHttpException;

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
     
   public function events()
    {
        
       return [
           ActiveRecord::EVENT_BEFORE_INSERT => 'doBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'doBeforeSave',
            ActiveRecord::EVENT_BEFORE_DELETE => 'doBeforeDelete',
            //ActiveRecord::EVENT_AFTER_INSERT => 'doAfterSave',
           // ActiveRecord::EVENT_AFTER_UPDATE => 'doAfterSave',
           // ActiveRecord::EVENT_AFTER_DELETE => 'doAfterDelete'
        ];
    }
    
    
    /*Par evitar llamar
   public function getOwner(){
      if(is_null($this->_owner)){
         $this->_owner=$this->owner; 
      }else{
         return $this->_owner; 
      }
   }
    
    /*
     * Se ejecuta previamente a un evento de insertar o modificar
     * SI NO ESTA DENTRO DE UNA TRANSACCION:: NO HACE NADA 
     */
    
    public function doBeforeSave(){
    if($this->owner->withAudit)
       foreach($this->owner->attributes as $attribute=>$value){
          if($this->hasChanged($attribute)){ 
             // ECHO '<br><br>'.$attribute;DIE();
              $model=New Activerecordlog();
               $model=$this->setLogValues($model, $attribute);
              if(!$model->save()){
                  throw new ServerErrorHttpException(Yii::t('base_errors', 'Could not be recorded'.serialize($model->geterrors())));
              }
              unset($model);
          }          
       } 
    }
    
    public function doBeforeDelete(){
       if($this->owner->withAudit)         
       foreach($this->owner->attributes as $attribute=>$value){
          $model=New Activerecordlog();
              $model=$this->setLogValues($model, $attribute,true);              
              $model->save();unset($model);
                }
            //}
         RETURN TRUE;
       }
    
    
    private function setLogValues(&$model,$attribute,$delete=false){
        $model->setAttributes([
            'model'=>get_class($this->owner),
           // 'idModel'=>Json::encode($this->owner->getPrimaryKey(true)),
            'field'=>$attribute,
            'ip'=>trim(yii::$app->request->getRemoteIP()),
            'creationdate'=>date('Y-m-d H:i:s'),
            //'ip'=>yii::$app->request->getUrl(),
            'controlador'=>Yii::$app->controller->id,
            'description'=>Yii::$app->request->getUrl(),
            'nombrecampo'=>$attribute,
            'oldvalue'=>$this->owner->getOldAttribute($attribute),
            'newvalue'=>$this->owner->{$attribute}.'',
             'username'=>yii::$app->user->identity->username, 
              'metodo'=> $this->getTypeRequest(),
               ]);
           if(!$delete){
               $model->action=($this->owner->isNewRecord)?static::ES_NUEVO:static::NO_ES_NUEVO;
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
     if($this->owner->hasMethod('hasChanged'))      
       return $this->owner->hasChanged($attribute);     
       return (!($this->owner->{$attribute}==$this->owner->getOldAttribute($attribute)));
    }

    
    private function isInTransaction(){
        return !is_null($this->owner->getDb()->getTransaction());
    }
    
   
  
}

