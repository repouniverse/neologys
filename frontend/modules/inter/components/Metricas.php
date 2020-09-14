<?php
namespace frontend\modules\inter\components;
use yii\base\Component;
use common\helpers\h;
use frontend\modules\inter\models\InterConvocados;
use frontend\modules\inter\models\InterPrograma;
use frontend\modules\inter\models\InterEntrevistas;
use frontend\modules\inter\models\InterExpedientes;
use frontend\modules\inter\models\InterE;
use frontend\modules\inter\Module as m;

class Metricas extends Component
{
   
public static function nConvocados(){
  return   InterConvocados::find()->count();
}    

public static function nExpedientes(){
  return InterExpedientes::find()->count();
} 


public static function nEntrevistas(){
  return InterEntrevistas::find()->count();
} 


    
    
    
    
}
