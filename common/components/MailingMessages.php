<?php
/* 
 * JRAMIREZ 06/11/2020
 * Clase creada para manejar los mensajes personalizados de
 * correo, trabaja en conjunto con el Componente
 * Mailer.
 * 
 * 
 */
namespace common\components;
use yii\base\Component;
use common\models\MailingModel;
use common\helpers\h;
class MailingMessages extends component 
{
    
 public $classModel='common\models\MailingModel';
 
 public function registerRoute(){
     $route='/'.yii::$app->controller->action->getUniqueId();
     $model=New MailingModel();
     $model->setAttributes([
         'universidad_id'=>h::user()->profile->universidad_id,
         'facultad_id'=>h::resolveFaculty(),
         'ruta'=>$route,
     ]);
     return $model->save();
     
 }
    
}


