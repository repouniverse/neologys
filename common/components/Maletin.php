<?php
namespace common\components;
use common\helpers\h;
use common\helpers\FileHelper;
use yii;
class Maletin {
 const SESION_MALETIN='maletin';
public $preserve=true;  
public $_sesion=null; 
public $contenido=[];



 public function  addItem($nombreclase,$valor){
    
     $this->contenido=h::session()[self::SESION_MALETIN];
    if(array_key_exists($nombreclase, $this->contenido)){
      if(array_search($valor,$this->contenido[$nombreclase]['datos'])===false){
          $this->contenido[$nombreclase]['datos'][]=$valor;   
        }
    }else{
        $this->contenido[$nombreclase]=[
            'preserve'=>$this->preserve,
            'datos'=>[$valor],
        ]; 
    }
   h::session()[self::SESION_MALETIN]=$this->contenido;
 }
 
public function  removeItem($nombreclase,$valor){
   
     // $this->contenido=h::session()[self::SESION_MALETIN];
      $contenido=h::session()[self::SESION_MALETIN];
   if(array_key_exists($nombreclase, $contenido)){
        
      if(array_search($valor,$contenido[$nombreclase]['datos'])>0){
         $key=array_search($valor,$contenido[$nombreclase]['datos']);
          
          array_splice($contenido[$nombreclase]['datos'],$key,1);
         
       }
    }
    h::session()[self::SESION_MALETIN]=$contenido;
    $this->contenido=$contenido;
 } 
 
 public static function findDatosClase($nombreclase){
     $esta=in_array($nombreclase, array_key_exists($nombreclase, h::session()[self::SESION_MALETIN]));
     if($esta){
         return h::session()[self::SESION_MALETIN][$nombreclase]; 
     }else{
        return []; 
     }
      
 }
 
 public function clearMaletin($nombreclase=null){
    
  if(is_null($nombreclase)){ //limpiar todo el maletin
        h::session()[self::SESION_MALETIN]=[];
     }else{
      $this->contenido=h::session()[self::SESION_MALETIN];
        if(array_key_exists($nombreclase, $this->contenido)){
                unset($this->contenido[$nombreclase]);
      
                }
            h::session()[self::SESION_MALETIN]=$this->contenido;
    }
   
  }
 

 private static function filterSlashes($nombreclase){
    return FileHelper::replaceSlashesPath($nombreclase);
 } 
 
 /*Ubic un registro active RECORD 
  * Solo ocn darle le nomnbre del modelo,
  * Si no lo encuentra arroja null, 
  * ojo 
  */
 public function getModel($nombreclase,$id){  
     
     
 }
 /*
  * Devuelve un dataprovider, de una clase determinada
  */
 public function dataProvider($nombreclase){
     $datosId=self::findDatosClase($nombreclase)['datos'];
     $clase=New $nombreclase;
     
     return New \yii\data\ActiveDataProvider([
         'query'=>$clase->find()->andWhere([
         array_keys($nombreclase->getPrimaryKey(true))[0]=>$datosId
         ])
     ]);
 }
    
}