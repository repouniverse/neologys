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
           0=>yii::t('base_labels','Domingo'),
           1=>yii::t('base_labels','Lunes'),
           2=>yii::t('base_labels','Martes'),
           3=>yii::t('base_labels','Miercoles'),
           4=>yii::t('base_labels','Jueves'),
           5=>yii::t('base_labels','Viernes'),
           6=>yii::t('base_labels','Sabado'),
        
           
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
           '1'=>yii::t('base.names','ENERO'),
           '2'=>yii::t('base.names','FEBRERO'),
           '3'=>yii::t('base.names','MARZO'),
           '4'=>yii::t('base.names','ABRIL'),
           '5'=>yii::t('base.names','MAYO'),
           '6'=>yii::t('base.names','JUNIO'),
           '7'=>yii::t('base.names','JULIO'),
           '8'=>yii::t('base.names','AGOSTO'),
           '9'=>yii::t('base.names','SETIEMBRE'),
           '10'=>yii::t('base.names','OCTUBRE'),
           '11'=>yii::t('base.names','NOVIEMBRE'),
           '12'=>yii::t('base.names','DICIEMBRE'),
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
          return yii::t('base.names','Buenos días');
        else if ($hora < 19)
          return yii::t('base.names','Buenas Tardes');
        else
         return yii::t('base.names','Buenas Noches');
  }
  
  public static function semanas(){
      $semanas=[];
      for ($i = 1; $i <= 52; $i++) {
          $semanas[$i]='Semana '.$i;
         }
       return $semanas;
    }
  
}  
  
   
