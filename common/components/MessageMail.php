<?php
/**
 *  Creada por jramirez 07/11/2020
 *  Es una clase que se hereda del componente
 *  Message de yii\swiftmailer;
 * 
 */

namespace common\components;
use yii\swiftmailer\Message as Correo;
use common\helpers\h;
use yii\swiftmailer\Message;

use yii;
class MessageMail extends Message
{
 private $_route=null;
 public $classModel='common\models\MailingModel';
 public $language='es';//Español por defecto
 public $ParamTextBody=[]; 
   
  public function ReplaceParams(/*$reverse=false*/){
      //if(!$reverse)
      $this->setHtmlBody(
              str_replace(array_keys($this->ParamTextBody),
              array_values($this->ParamTextBody),$this->getSwiftMessage()->getBody())
              );
     /* $this->setHtmlBody(
              str_replace(array_values($this->ParamTextBody),
              array_keys($this->ParamTextBody),$this->getSwiftMessage()->getBody())
              );*/
      return count($this->ParamTextBody);      
  } 
  public function  getRoute(){
      if(IS_NULL($this->_route))
        return '/'.yii::$app->controller->action->getUniqueId();
      return $this->_route;
  }  
 
  private function criteriaExists(){
      return [
         'universidad_id'=>h::user()->profile->universidad_id,
         'facultad_id'=>h::resolveFaculty(),
         'ruta'=>$this->route,
          'idioma'=>$this->language,
          //'activo'=>'1'
     ];
  }
  public function ExistsMessageForThisRoute(){
       $model=$this->classModel;
       return $model::find()->where($this->criteriaExists())->exists();
  }  
    
   public function ResolveMessage(){
     //$route='/'.yii::$app->controller->action->getUniqueId();
     $model=$this->classModel;
     //$this->ReplaceParams();
     if(!$this->ExistsMessageForThisRoute()){
         $attributes=array_merge($this->criteriaExists(),[
             'titulo'=>$this->convertParams($this->getSubject()),
             'correoremitente'=>(is_string($this->getFrom()))?$this->getFrom():array_keys($this->getFrom())[0],
             'remitente'=>(is_string($this->getFrom()))?null: array_values($this->getFrom())[0],
              'copiato'=>$this->convertParams($this->getCc()),
             'idioma'=>$this->language,
             'activo'=>true,
             'parametros'=>array_keys($this->ParamTextBody),
             'reply'=>$this->convertParams($this->getReplyTo()),
             'cuerpo'=>$this->convertParams($this->getSwiftMessage()->getBody())            
                    ]);
        return $model::firstOrCreateStatic($attributes,
             null,
             $this->criteriaExists());
         
     }else{
      $current_message=$model::find($this->criteriaExists())->one();       
       $this->setSubject($current_message->titulo)
             ->setFrom([$current_message->correoremitente=>$current_message->remitente])
             ->setCc($current_message->copiato)
              ->setReplyTo($current_message->reply)
              ->setHtmlBody($current_message->cuerpo);
     }
      $this->ReplaceParams();  
     return true;
   }
   
   private function convertParams($attr)
    {
        if (is_array($attr)) {
            $attr = implode(', ', array_keys($attr));
        }
        return $attr;
    }
    
}

