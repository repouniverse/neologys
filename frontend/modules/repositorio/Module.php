<?php

namespace frontend\modules\repositorio;
use common\models\masters\PlanesEstudio;
use yii\helpers\ArrayHelper;
/**
 * repositorio module definition class 
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    const PROCESO_TALLER_TESIS='100';
    //const PROCESO_TALLER_TESIS='100';
    public $controllerNamespace = 'frontend\modules\repositorio\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public static function getCursosTalleres($tipoproceso){
       $filas= PlanesEstudio::find()->
        select(['curso_id','codcurso'])->andWhere(['tipoproceso'=>$tipoproceso])->all();
       return ArrayHelper::map($filas,'curso_id','codcurso');
       
        
    }
    
    
}
