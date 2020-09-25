<?php
namespace frontend\modules\report\traits;
use yii;
trait testTrait
{
  public $camposAdd=['nunca'=>0,'siempre'=>1,'jamas'=>3];
    
   public function init(){
       foreach($this->camposAdd as $clave=>$valor){
           $this->{$clave}=$valor;
       }
       
   } 
  
    
    
}
