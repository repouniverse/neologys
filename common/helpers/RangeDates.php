<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;
 

class RangeDates extends \yii\base\Component{
    use \common\traits\timeTrait;
     const ESCALE_SECONDS='Seconds';
    const ESCALE_MINUTES='Minutes';
    const ESCALE_HOURS='Hours';
    const ESCALE_DAYS='Days';
    const ESCALE_WEEKS='Weeks';
     const ESCALE_MONTHS='Meses';
     const ESCALE_YEARS='Years';
    
  /*
   * Esta propiedad define la tolerancia que se aplicara 
   * para la verificación de los decalajes, en decimales
   */  
    
   public $tolerance=0.0; //10%
   /*
    * Array de fechas 
    * [Carbon finicio,Carbon ftermino]
    * de
    * dos objetos Carbon
    */
  public $_dates=[];
   
  
   /*
    * Escala en la que se va a trabajar
    */
   public $scale=self::ESCALE_MINUTES;
   
   /*
    * Array de subRangos, e sdecir 
    * dentro de rANGE HAY OTROS OBJETOS RANGE
    */
   public $subRanges=[];
   
   /*
    * Determina si puedne coexistir subrnagos que se cruzan en el horario 
    */
   public $isPossibleInterference=false;
   
   
    public function __construct(Array $dates){
        //var_dump($dates[0]->greaterThanOrEqualTo($dates[1]));die();
        if(count($dates) <> 2)
         throw new \yii\base\Exception(Yii::t('base.errors', 'La propiedad dates Debe de contener {can} elementos',['can'=>2]));
        if(!($dates[0] instanceof \Carbon\Carbon) or 
           !($dates[1] instanceof \Carbon\Carbon))
          throw new \yii\base\Exception(Yii::t('base.errors', 'La propiedad dates debe ser un array debe contener instancias de Carbon'));
         
       if($dates[0]->greaterThanOrEqualTo($dates[1]))           
         throw new \yii\base\Exception(Yii::t('base.errors', 'La fecha de inicio es mayor o igual que la fecha de termino'));
       
   $this->_dates=$dates;
   }
   
   public function getDates(){
       return $this->_dates;
   }
   public function getInitialDate(){
       return $this->_dates[0];
   }
   public function getFinalDate(){
       return $this->_dates[1];
   }
   public function getDuration(){
   return $this->_dates[1]->{$this->getFunctionScale()}($this->_dates[0]);
   }
   
   public function getDiff(\Carbon\Carbon $dateini, \Carbon\Carbon $datefinal){
   return $datefinal->{$this->getFunctionScale()}($dateini);
   }
   
   private function getFunctionScale(){
       return 'diffIn'.$this->scale;
   }
   
   
  /*
   * Agrega unsibrango 
   * verdficanod primero si hay esacio para el 
   */
   public function pushRange(RangeDates $range){
       if($this->isPossibleInSubRanges($range)){
           $this->subRanges[]=$range;
       }ELSE{
           return false;
       }
       
   }
   
   
   /*
    * verifica que un rango puede incluirse en 
    * el subrango, sin cruces
    */
   public function isPossibleInSubRanges(RangeDates $range){
        $hayCruce=false;
      if($this->isPossibleInterference){
        return true; 
      } else{
          /*Verificamos primero que este entre los bordes   */
          if($this->isRangeIntoOtherRange($range, $this)){
               /*Ahora Verificamos que nos e curce con otreos subrangos que ya existen   */
          foreach($this->subRanges as $rangoInterno){
                
                 if($this->isRangeIntoOtherRange($range,$rangoInterno)){
                    $hayCruce=true;break;
                 }
                 
               }
             if(!$hayCruce){
                 //$this->subRanges[]=$range; 
                  return true;
                 
             }else{
                 return false;
             }
             
          }else{
              return false;
          }
          
      }
   }
   
   /*
    * Busca el primer  lugar libre, según los surangos que tenga
    * subrabgos, si este rango no tiene subrangos entonce 
    * siempre devuelve falso
    * Si no encuentra lugar libre decuelve null
    * @intervalo: integer valor de tiempo emdido en la proprieda scale
    * por eemplo si pones 5 , y la esca es MINUTES, es 5 minutos
    * return   Rango con las fronteras del primer lugar libre que encuentra
    */
  public function findFirstFreePlace($intervalo){
      if(count($this->subRanges)==0)return null;
      $clase=self::class();
      $rangoAux=null; //Auxiliar para almaenar temporal
       $rangoLibre=null;
      foreach($this->subRanges as $rango){
          if(is_null($rangoAux)){ // si es la primera vez
              $limiteInf=$this->getInitialDate();
              $limiteSup=$rango->getInitialDate();
              $intervaloLibre=$limiteSup->{$this->getFunctionScale()}($limiteInf);
              
          }else{
              
              $limiteInf=$rangoAux->getFinalDate();
              $limiteSup=$rango->getInitialDate();
              $intervaloLibre=$limiteSup->{$this->getFunctionScale()}($limiteInf); 
              
          }
          if($intervaloLibre >=0.8*$intervalo){
              $rangoLibre=new $clase([$limiteInf,$limiteSup]);
               break;   
          }
          
          
        $rangoAux=$rango;  
      }
      
      /*
           * FALT VERIFICAR EL ULTIMO TRAMO, ES DECIR 
           * ENTRE EL EXTERMO FINAL DEL ULTIMO RANGO Y EL EXERMO FINAL 
           * DEL RANGO PADRE 
           */
          IF(is_null($rangoLibre)){//Sio no ha encontrado nada anteriormete en el bucle
              $limiteInf=$rangoAux->getFinalDate();
              $limiteSup=$rango->getFinalDate();
              if($limiteInf->lt($limiteSup)){
                 $intervaloLibre=$limiteSup->{$this->getFunctionScale()}($limiteInf); 
                 if($intervaloLibre >=0.8*$intervalo){
                      $rangoLibre=new $clase([$limiteInf,$limiteSup]);
                     }
              }
              
              
          }
          
      
      return $rangoLibre;
  } 
   
   
   
}
   


  
   
