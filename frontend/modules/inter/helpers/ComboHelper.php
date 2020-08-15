<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir los combos
 */
namespace frontend\modules\inter\helpers;
use common\helpers\ComboHelper as combo;
use common\helpers\h;
use yii;
use yii\helpers\ArrayHelper;

class ComboHelper  extends combo{
    
 
    
  public static function getCboModos($programa_id=null){
      $query= \frontend\modules\inter\models\InterModos::find();
      if(!is_null($programa_id)){
          $query->andWhere(['programa_id'=>$facultad_id]);
      }else{
       $mp=\frontend\modules\inter\models\InterPrograma::find() 
        ->andWhere(['codperiodo'=>h::periodos()->currentPeriod])->one();
        $query->andWhere(['programa_id'=>$mp->id]);  
       }
        return ArrayHelper::map(
                       $query->all(),
                'id','descripcion');
    }     
}