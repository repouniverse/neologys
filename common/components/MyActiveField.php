<?php
namespace common\components;
use yii;
use yii\widgets\ActiveField;

class MyActiveField extends ActiveField
{
   
    //public $options=['disabled'=>'disabled'];
public function init(){
  if($this->isBlockedField())
  $this->inputOptions=array_merge($this->inputOptions,['disabled'=>'disabled']);
}

private function isBaseModel(){
    return ($this->model instanceof \common\models\base\modelBase );
}

private function isBlockedField(){
    //Si es model base y ademas el campo tiene registros hijos relacionados 
    // ESUN CAMO QUE NO DEBE E EDITARSE 
    if($this->isBaseModel()){
      if($this->model->isBlockedField($this->attribute)){
        return true;    
      }        
    }      
      return false;
    }
}





