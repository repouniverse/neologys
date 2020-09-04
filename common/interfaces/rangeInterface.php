<?php
/* Esta interface implementa la funcion range()
 * que devuelve dos objetos Carbones, estableciendo los 
 * limites inferior y superior del parametro $fecha
 *   
 */
namespace common\interfaces;
interface rangeInterface {
/*
 * devuelve un objeto Range con dos objetos carbon
 *  que devuelve dos objetos Carbones, estableciendo los 
 * limites inferior y superior del parametro $fecha
 *   
 */
public function range($fecha);

/*
 * Devuelve un objeto plantilla
 * para una semana
 *   
 */
public function rangesToWeek(\Carbon\Carbon $carbon,$arrayWhere=null);
  



public function rangesToDay(\Carbon\Carbon $carbon,array $arrayWhere=null);
  
}

