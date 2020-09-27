<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use common\helpers\RangeDates;
use yii;


class RangeDay extends RangeDates{
    
   private $_carbon_inicio;
   private $_carbon_final;
   public $ranges=[];
   public $day;
   
  public function __construct(\Carbon\Carbon $carbon) {
      $this->day=$carbon->dayOfWeek;
      $dates=[$carbon->copy()->endOfDay()->subDay(),$carbon->copy()->endOfDay()];
      $this->setDates($dates);
     parent::__construct($dates);
  }
  
  public function insertRange(RangeDates $rango){
      $this->ranges[]=$rango;
      $this->setDates([$this->minCarbon(),$this->maxCarbon()]); 
  }
  
  private function maxCarbon(){
      //$carbonAux=$this->initialDate;
      $carbonMax=$this->initialDate->copy();
      foreach($this->ranges as $rango){
         if($rango->finalDate->gt($carbonMax)){
           $carbonMax= $rango->finalDate->copy(); 
         }
          
      }
    return $carbonMax;
  }
  
  
  private function minCarbon(){
      //$carbonAux=$this->initialDate;
      $carbonMin=$this->finalDate->copy();
      foreach($this->ranges as $rango){
         if($rango->initialDate->lt($carbonMin)){
           $carbonMin= $rango->initialDate->copy(); 
         }
          
      }
    return $carbonMin;
  }
  
  
  
  
  
  /*
   * Mdofoca la proeida dates 
   * esta funcion no la tiene el parent
   */
  public function setDates($carbones){
      //VAR_DUMP($carbones);DIE();
      $this->_dates=[];
      $this->_dates[]=$carbones[0];
      $this->_dates[]=$carbones[1];
      
  }
  
  
  
  
 
}
   
   
   
   

   


  
   
