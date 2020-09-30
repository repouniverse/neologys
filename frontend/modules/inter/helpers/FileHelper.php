<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir los combos
 */
namespace frontend\modules\inter\helpers;


class FileHelper  extends \common\helpers\FileHelper 
{
    public static function urlFlag($codpais,$tamano=32) {
     return '@web/img/flags/'.$tamano.'/'.$codpais.'.png';
  }  
}