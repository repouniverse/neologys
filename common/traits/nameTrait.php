<?php
/*******************************************
 * TRAIT PARA COGER EL NOMBRE COMPLETO 
 * DE UNA PERSONA
 ******************************************/
namespace common\traits;
use yii;

trait nameTrait
{
   private $camposComunes=[
       'ap','am','nombres','tipodoc','numerodoc'
   ];
  
  public function fullName($asc=TRUE,$ucase=true,$delimiter=' '){       
         $strname=($asc)?$this->nombres.' '.$this->ap.' '.$this->am:$strname= $this->ap.' '.$this->am.' '.$this->nombres;
         $strname= ($ucase)?\yii\helpers\StringHelper::mb_ucwords($strname):$strname;
       return str_replace(' ',$delimiter, $strname);
     }
}
