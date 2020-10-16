<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;

class timeHelper {
     
    public static function getMaxTimeExecute(){
      return ini_get('max_execution_time')+0; 
   }
   
   public static function excedioDuracion($duration, $anticipate=0){
      return ($duration + $anticipate >= static::getMaxTimeExecute());
   }
   
   public STATIC function daysOfWeek(){
       return [
           0=>yii::t('base_names','Sunday'),
           1=>yii::t('base_names','Monday'),
           2=>yii::t('base_names','Tuesday'),
           3=>yii::t('base_names','Wednesday'),
           4=>yii::t('base_names','Thursday'),
           5=>yii::t('base_names','Friday'),
           6=>yii::t('base_names','Saturday'),
        
           
       ];
   }
   
   
   public static  function cboAnnos(){
       return [
           '2018'=>'2018',
            '2019'=>'2019',
            '2020'=>'2020',
           '2021'=>'2021',
           '2022'=>'2022',
       ];
   }
 
   
    public static  function cboMeses(){
       return [
           '1'=>yii::t('base_names','JANUARY'),
           '2'=>yii::t('base_names','FEBRUARY'),
           '3'=>yii::t('base_names','MARCH'),
           '4'=>yii::t('base_names','APRIL'),
           '5'=>yii::t('base_names','MAY'),
           '6'=>yii::t('base_names','JUNE'),
           '7'=>yii::t('base_names','JULY'),
           '8'=>yii::t('base_names','AUGUST'),
           '9'=>yii::t('base_names','SEPTEMBER'),
           '10'=>yii::t('base_names','OCTOBER'),
           '11'=>yii::t('base_names','NOVEMBER'),
           '12'=>yii::t('base_names','DECEMBER'),
       ];
   }
   
   public function mapMonths($arrayIntegers){
       $arr=[];
       foreach($arrayIntegers as $key=>$value){
           $arr[$value]=substr(static::cboMeses()[$value],0,3);
       }
       return $arr;
   }
   
   public function mes($nmes){
       $meses=static::cboMeses();
       return $meses[$nmes];
   }
   
   public static function getDateTimeInitial(){
       return '1970-01-01 00:00:00';
   }
   public static function getDateInitial(){
       return '1970-01-01';
   }
   
   public static function formatMysql(){
    return h::gsetting('timeBD', 'datetime');
   } 
   
   public static function formatMysqlDate(){
    return 'Y-m-d';
   } 
   public static function formatMysqlDateTime(){
    return 'Y-m-d H:i:s';
   } 
   
   public static function regexMysqlDate(){
      return '/[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/';
  }
  public static function regexMysqlDateTime(){
      return '/[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1} [0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}:[0-5]{1}[0-9]{1}$/';
  }
  public static function IsFormatMysqlDate($fecha){
     if(preg_match(static::regexMysqlDate(),$fecha)){
         return true;
     }else{
         return false;
     }
  }
  public static function IsFormatMysqlDateTime($fecha){
     if(preg_match(static::regexMysqlDateTime(),$fecha)){
         return true;
     }else{
         return false;
     }
  }
  
  public static function Saludo(){
      $hora=Date('H');
      if ($hora <= 12)
          return yii::t('base_names','Good morning');
        else if ($hora < 19)
          return yii::t('base_names','Good afternoon');
        else
         return yii::t('base_names','Good evening');
  }
  
  public static function semanas(){
      $semanas=[];
      for ($i = 1; $i <= 52; $i++) {
          $semanas[$i]='Semana '.$i;
         }
       return $semanas;
    }
  
}  
  
   
