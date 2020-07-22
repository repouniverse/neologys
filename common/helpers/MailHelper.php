<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir los combos
 */
namespace common\helpers;
use yii;
use backend\components\Installer;
use yii\helpers\ArrayHelper;

class MailHelper  {
    public static function fakeMail(){
       return Installer::generateRandomString(16).'@'.Installer::generateRandomString(7).'.com';
    }
    
}