<?php
namespace frontend\modules\report\models;
use common\models\base\modelBase;
use Yii;
use common\helpers\h;
class baseReporte extends modelBase
{
   const PREFIJO_METODO='report';
    private static function methods(){
        return get_class_methods(static::className());
    }
    public static function methodsReport(){
        $metodsReport=[];
        $metodos=static::methods();
       // var_dump($metodos);
       foreach($metodos as $metodo){
           if(strtolower(substr($metodo,0,strlen(self::PREFIJO_METODO)))==self::PREFIJO_METODO){
              $metodsReport[]=$metodo; 
           }
           
       }
       return $metodsReport;
    }
}
