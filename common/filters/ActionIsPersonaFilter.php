<?php
/*
 * Clase creada por JRamírez 24/011/2020
 * Para detectar lso casos en los cuales
 * el usuario ingresa sin  ser identidad
 */
namespace common\filters;
//use common\controllers\baseController;
use Yii;
use common\helpers\h;

use yii\base\ActionFilter;

class ActionIsPersonaFilter extends ActionFilter
{
    

   

    public function beforeAction($action)
    {
        if(!h::user()->isPersona())
        return $this->owner->redirect(['/site/no-person']);
        return parent::beforeAction($action);
    }
    
    
}

