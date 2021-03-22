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
 //public $language='es';//Español por defecto
 public $paramTextBody=[]; 
   
  public function replaceParams($cuerpo,$reverse=false){
      if(!$reverse){
          //echo "*****************inicio*************";
          $cadena=str_replace(array_keys($this->paramTextBody),
              array_values($this->paramTextBody),$cuerpo);
        /* var_dump($this->getSwiftMessage()->getBody(),
                  $cadena
                  );*/
          //$this->setHtmlBody($cadena);
          //echo $this->getSwiftMessage()->getBody();
          //echo "*****************Final*************<br><br>";
         
      }else{
           $cadena=str_replace(array_values($this->paramTextBody),
              array_keys($this->paramTextBody),$cuerpo);
      }
      
      /*$this->setHtmlBody(
              str_replace(array_values($this->paramTextBody),
              array_keys($this->paramTextBody),$this->getSwiftMessage()->getBody())
              );*/
      return $cadena;      
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
          'idioma'=>yii::$app->language,
          //'activo'=>'1'
     ];
  }
  public function ExistsMessageForThisRoute(){
       $model=$this->classModel;
       //echo $model::find()->where($this->criteriaExists())->createCommand()->rawSql;die();
       return $model::find()->where($this->criteriaExists())->exists();
  }  
    
    public function resolveMessage() {
        //$route='/'.yii::$app->controller->action->getUniqueId();
        //var_dump(!$this->ExistsMessageForThisRoute());die();
        $model = $this->classModel;
        //$this->ReplaceParams();
        if (!$this->ExistsMessageForThisRoute()) {
            $attributes = array_merge($this->criteriaExists(), [
                'titulo' => $this->convertParams($this->getSubject()),
                'correoremitente' => (is_string($this->getFrom())) ? $this->getFrom() : array_keys($this->getFrom())[0],
                'remitente' => (is_string($this->getFrom())) ? null : array_values($this->getFrom())[0],
                'copiato' => $this->convertParams($this->getCc()),
                'idioma' => yii::$app->language,
                'activo' => true,
                'parametros' => array_keys($this->paramTextBody),
                'reply' => $this->convertParams($this->getReplyTo()),
                'cuerpo' => $this->getSwiftMessage()->getBody(),
            ]);

            yii::error($attributes);
            return $model::firstOrCreateStatic($attributes,
                null,
                $this->criteriaExists());

        } else {
            ///echo '<pre>';
            //var_dump($this->paramTextBody);
            //echo '</pre>';
            //die();
            $current_message = $model::find()->andWhere($this->criteriaExists())->one();
            if ($current_message->activo) {
                $contenido = $current_message->cuerpo;
                /*$this->paramTextBody = [
                    '{{param1}}' => 'CARLOS',
                    '{{param2}}' => 'APRO. EXPEDIENTE',
                ];*/
                ///$contenido = $current_message->replaceParams($contenido);
                //$body = $contenido;
                $this->paramTextBody = $this->buildArray($current_message->parametros);

                //                echo '<pre>';
                //                var_dump($this->buildArray($current_message->parametros));
                //                echo '</pre>';
                //                die();

                $contenido = $this->replaceParams($contenido);
                //var_dump($contenido);
                //die();
                $this->setSubject($current_message->titulo)
                    ->setFrom([$current_message->correoremitente => $current_message->remitente])
                    ->setCc($current_message->copiato)
                    ->setReplyTo($current_message->reply)
                    ->setHtmlBody($contenido);
            }
        }

        return true;
    }
   
   /*ESTA FUNCION se encarga de conciliar los 
    * parametros encontrados en tablas con los parametros 
    * originales del código. Puede ser que coincidan totalmente
    * o parcialmente, según como el usuario lo vaya mdificando
    * en tablas 
  
    * @paramsFromTable array  parametros que se leen de tablas
    *                        
    */
   private  function buildArray($paramsFromTable=[]){
       $paramsFinal=[];
       foreach($paramsFromTable as $key=>$value){
           if(array_key_exists($value,$this->paramTextBody))
              $paramsFinal[$value]=$this->paramTextBody[$value];
       }
      return  $paramsFinal;
   }
   
   private function convertParams($attr)
    {
        if (is_array($attr)) {
            $attr = implode(', ', array_keys($attr));
        }
        return $attr;
    }
    
}

