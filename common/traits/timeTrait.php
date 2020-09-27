<?php
/*
 * TRAIT DE USO general para saber 
 * por ejemplo si una feha e sferiado o no
 */
namespace common\traits;
use yii;
use Carbon\Carbon;
use common\helpers\RangeDates;
trait timeTrait
{
    private $_holyDays=[       
        '2020-11-01',
        '2020-12-25',
        '2020-01-01',
        '2020-10-08',
        '2020-05-01',
        '2020-06-29',
        '2020-07-28',
        '2020-07-29',
        '2020-08-30',
        '2021-11-01',
        '2020-12-25',
        '2020-04-10',
             ];

    private function holyDays(){
        return $this->_holyDays;
    }
    
    public function isHolyDay(Carbon $fecha){
        
        return (/*$fecha->isSunday()*/ /*or $fecha->isSaturday()*/ /*or*/
                in_array($fecha->format('Y-m-d'),$this->holyDays())
                )?true:false;
    }
    
    /*
     * PARA SABER SI UNA FEHA ESTA DENTRO UN INTERVALO
     */
    public function betweenDate( Carbon $fecha,
                             Carbon $finicio,
                             Carbon $ftermino,
                        $withBorder=true){
         if($withBorder){
             return($fecha->greaterThanOrEqualTo($finicio) && 
            $fecha->lessThanOrEqualTo($ftermino))?true:false;
         }else{
            return($fecha->greaterThan($finicio) && 
            $fecha->lessThan($ftermino))?true:false; 
         }
        
    }
    
    /*
     * PARA SABER SI UN RANGOD E FECHAS 
     * ESTA CONTENIDO EN OTRO RANGO DE FECHAS
     * $rango  : DateRange  , rango que se va a buscar
     * $hostRango: DateRango rango donde se va a buscar 
     * Devuelve 
     * true: Quiere decir que si opuede considerarse dentro del valordel rango a bsucar
     * false: eSTA Fuera delos valores del rango a bsucar 
     */
    public function isRangeIntoOtherRange(RangeDates $rangeCompare, //rango a buscar
            RangeDates $rangeSearch, //rANGO A COMPARAR 
            $withBorder=true){
        if(is_null($rangeCompare) or is_null($rangeSearch))return false;
        /*yii::error('****inicinac********');
         yii::error($rangeSearch->initialDate->format('Y-m-d H:i'));
        yii::error($rangeSearch->finalDate->format('Y-m-d H:i'));*/
        return (
                 $this->intofisrtCondition($rangeCompare, $rangeSearch, $withBorder) &&
                 (
                  $this->intoSecondCondition($rangeCompare, $rangeSearch) or
                  $this->intoThirdCondition($rangeCompare, $rangeSearch) or
                  $this->intoFourthCondition($rangeCompare, $rangeSearch)
                   )
                 );
    }
   
    
    /*
     * Saber si el rango a comparar  no esta fuera de las fronteras del rango
     * a buscar
     * 
     */
  private function intofisrtCondition(RangeDates $rangeCompare, 
          RangeDates $rangeSearch,$withBorder=true){
      /*yii::error('***primera condicion**');
       yii::error($rangeSearch->initialDate->format('H:i'));
        yii::error($rangeSearch->finalDate->format('H:i'));*/
      if($withBorder){
          /*yii::error(!($rangeCompare->finalDate->lessThanOrEqualTo($rangeSearch->initialDate) or
             $rangeCompare->initialDate->greaterThanOrEqualTo($rangeSearch->finalDate)));
          */
           return !($rangeCompare->finalDate->lessThanOrEqualTo($rangeSearch->initialDate) or
             $rangeCompare->initialDate->greaterThanOrEqualTo($rangeSearch->finalDate)); 
             
         }else{
             /*yii::error(($rangeCompare->finalDate->lessThan($rangeSearch->initialDate) or
             $rangeCompare->initialDate->greaterThan($rangeSearch->finalDate)));*/
             
            return !($rangeCompare->finalDate->lessThan($rangeSearch->initialDate) or
             $rangeCompare->initialDate->greaterThan($rangeSearch->finalDate));        
         }
  }

private function intoSecondCondition(RangeDates $rangeCompare, 
          RangeDates $rangeSearch){   
    /* yii::error('**Segunda condicion**');
         yii::error('Diferencia de tfc-to : '.$rangeCompare->getDiff($rangeCompare->finalDate,$rangeSearch->initialDate));
         yii::error('Duracion del rango pequeni : '.$rangeCompare->duration);
          yii::error('Porcentaje de tolerancia : '.(1-$rangeCompare->tolerance));
           yii::error('Comparando si tfc-to > ()%duracion: '.($rangeCompare->getDiff($rangeCompare->finalDate,$rangeSearch->initialDate) >= (1-$rangeCompare->tolerance)*$rangeCompare->duration)?'ok':'no cumple');
            yii::error('Comparando toc < to : '.($rangeCompare->initialDate->lessThanOrEqualTo($rangeSearch->initialDate))?'ok':'falso');
         yii::error($rangeSearch->initialDate->format('H:i'));
        yii::error($rangeSearch->finalDate->format('H:i'));*/
            /* yii::error((($rangeCompare->getDiff($rangeCompare->finalDate,$rangeSearch->initialDate) >= (1-$rangeCompare->tolerance)*$rangeCompare->duration) &&
           ($rangeCompare->initialDate->lessThanOrEqualTo($rangeSearch->initialDate))
           ));*/
             
            return (($rangeCompare->getDiff($rangeCompare->finalDate,$rangeSearch->initialDate) >= (1-$rangeCompare->tolerance)*$rangeCompare->duration) &&
           ($rangeCompare->initialDate->lessThanOrEqualTo($rangeSearch->initialDate))
           );
           
  }
 
  private function intoThirdCondition(RangeDates $rangeCompare, 
          RangeDates $rangeSearch){  
           /* yii::error('**Tercera condicion**');
       yii::error('Comparando toc >=to : '.($rangeCompare->initialDate->greaterThanOrEqualTo($rangeSearch->initialDate))?'yes':'falso');
        yii::error($rangeCompare->initialDate->format('H:i'));
       yii::error($rangeCompare->finalDate->format('H:i'));
        yii::error($rangeSearch->initialDate->format('H:i'));
        yii::error($rangeSearch->finalDate->format('H:i'));
       yii::error('Comparando tfc <= tf : '.($rangeCompare->finalDate->lessThanOrEqualTo($rangeSearch->finalDate))?'yes':'falso');
        yii::error('Porcentaje de tolerancia : '.(1-$rangeCompare->tolerance));
          */
          
          $valida=(($rangeCompare->initialDate->greaterThanOrEqualTo($rangeSearch->initialDate)) &&
           ($rangeCompare->finalDate->lessThanOrEqualTo($rangeSearch->finalDate))
           );
         // yii::error($valida);
         return $valida;
           
  }

  
  private function intoFourthCondition(RangeDates $rangeCompare, 
          RangeDates $rangeSearch){  
  /*yii::error('**Cuarta  condicion**');
       yii::error('Diferencia de tfc-tf : '.($rangeCompare->getDiff($rangeCompare->finalDate,$rangeSearch->finalDate))?'yes':'no');
         yii::error('Duracion del rango pequeni : '.$rangeCompare->duration);
          yii::error('Tolerancia del rango grande : '.($rangeCompare->tolerance));
           yii::error('Comparando si tfc-tf < tolerancia*duracion: '.($rangeCompare->getDiff($rangeCompare->finalDate,$rangeSearch->finalDate) < ($rangeCompare->tolerance)*$rangeCompare->duration)?'ok':'no cumple');
            yii::error('Comparando toc <= tf : '.($rangeCompare->initialDate->lessThanOrEqualTo($rangeSearch->finalDate))?'ok':'falso');
        yii::error((($rangeCompare->getDiff($rangeCompare->finalDate,$rangeSearch->finalDate) < ($rangeCompare->tolerance)*$rangeCompare->duration) &&
           ($rangeCompare->initialDate->lessThanOrEqualTo($rangeSearch->finalDate))
           ));*/
         return (($rangeCompare->getDiff($rangeCompare->finalDate,$rangeSearch->finalDate) < ($rangeCompare->tolerance)*$rangeCompare->duration) &&
           ($rangeCompare->initialDate->lessThanOrEqualTo($rangeSearch->finalDate))
           );
           
  }
  
  /*Verifica que rangecompare
   * si s etraslapand dos rangos 
   */
  public function isTraslapedRanges(RangeDates $rangeCompare, 
          RangeDates $rangeSearch){
      return !($rangeSearch->initialDate->greaterThan($rangeCompare->finalDate) or
       $rangeCompare->initialDate->greaterThan($rangeSearch->finalDate));
  }
  
  
  public function isRangeInOtherGroupRanges(RangeDates $rangeCompare,$groupRanges,$withBorders=true){
      $retorno=false;
      foreach($groupRanges as $rangeSearch){
          yii::error('rango base  comparar');
          yii::error($rangeCompare->rawInitialDate.'-'.$rangeCompare->rawFinalDate);
          yii::error('rango de busqueda');
          yii::error($rangeSearch->rawInitialDate.'-'.$rangeSearch->rawFinalDate);
          if($this->isRangeIntoOtherRange($rangeCompare, $rangeSearch, $withBorders)){
              $retorno=true;
              break;
          }
      }
      return $retorno;
  }
  
  /*
   * Funcion que devuelve un rango vacio
   * tecnicamente vacio
   */
  public static function RangeNull(){
      return New RangeDates(\Carbon\Carbon::now(),\Carbon\Carbon::now());
  }
  /*
 * ESTA FUNCION hace la diferencia de rangos 
 * Solo hay que introducir un rango minuenso
 * y un rango sustraendo, muysimilar a los conjuntos
 *  
 * rango1 - rango2 : devuelve rango 1  si no hay inteseccion
 * rango1- rango2 : devuelve un rango vacío si rango2 contiene a rango 1
 * rango 1- rango2: Devuelve la diferencia  si rango1 contiene o es mayor que rango2
 * 
 * reurn ; Devuelve un Array de objetos RANGE dates 
 */
  public function DiffRanges($rangoMinuendo,$rangoSustraendo){
      /*Si se traslapan*/
      if($this->isTraslapedRanges($rangoMinuendo, $rangoSustraendo)){
          /*Si rango sutraend contiene a minuendo*/
          if($this->isRangeIntoOtherRange($rangoMinuendo,$rangoSustraendo)){
                    /*Si esta traslapado asi          ---------------  minuendo
                       *                            ---------------------      sustraendo
                       */
             return [self::RangeNull()]; 
          }else{/*Minuendo no est contenido en sustranedo*/
              if($this->isRangeIntoOtherRange($rangoSustraendo,$rangoMinuendo)){
                   /*Si esta traslapado asi          ---------------  minuendo
                       *                                 ------       sustraendo
                       */
               /*Dos posibilidades, 1)  sustraendo esta contenido en minuendo ó */
                  /*LA DIFERENCIA SERIA UN ARRAY DE 2 RANGOS*/
                 RETURN [
                     /*Observe como le saca un agujero*/
                  new RangeDates([$rangoMinuendo->initialDate,
                                    $rangoSustraendo->initialDate]),
                   new RangeDates([$rangoSustraendo->finalDate,
                                    $rangoSustraendo->finalDate]),
                     
                     ];
              }else{/* 2) O no lo esta */
                  /*Solo queda ver estas dos condiciones*/
                  if($rangoSustraendo->finalDate->lt($rangoSustraendo->finalDate)){
                      /*Si esta traslapado asi          ---------------  minuendo
                       *                           -----------     sustraendo
                       */
                        RETURN [
                     
                            new RangeDates([$rangoSustraendo->initialDate,
                                    $rangoMinuendo->initialDate]),
                                new RangeDates([$rangoSustraendo->finalDate,
                                    $rangoMinuendo->finalDate]),
                     
                            ];
                  }else{
                      /*Si esta traslapado asi   ---------------  minuendo
                       *                                -----------     sustraendo
                       */
                      RETURN [
                     
                            new RangeDates([$rangoMinuendo->initialDate,
                                    $rangoSustraendo->initialDate]),
                                new RangeDates([$rangoMinuendo->finalDate,
                                    $rangoMinuendo->finalDate]),
                     
                            ];
                  }
              }
              
          }
          
          
      }else{
          return [$rangoMinuendo];
      }
  }
  
 /*
   * Dada una fecha CARBON 
   * Y dos textos de horas saca
   * un objeto range 
   * limite inferior:  CARBON CON LA HORA DE IINCIO
   * limite superios: CARBON CON LA HORA FINA 
   * 
   * @carbonEjemplo : Objeto carbon indica la fecha o fecha y hora ejemploS: 2012-04-28 , 2012-04-28 15:23:12
   * @hinicio: hora de inicio en texto formato :  hh:mm  ejemplo  '08:23'
   * @hfinal: hora final  en texto formato :  hh:mm  ejemplo  '11:45'
   * 
   * Devuelve  RANGE [ CARBON1 2012-04-28 08:23:00 , CARBON2 2012-04-28 11:45:00]
   */
  
public static function RangeFromCarbonAndLimits($miCarbon,$hinicio,$hfinal){
    
     return RangeDates::RangeFromCarbonAndLimits($miCarbon,$hinicio,$hfinal);

}


}
