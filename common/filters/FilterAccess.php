<?php
namespace common\filters;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\Url;
use common\helpers\h;
/*
 * Este filtro se implementa para 

 */
class FilterAccess extends ActionFilter
{
    
    public function beforeAction($action)
    {
         //echo Url::current();die();
       // yii::error('Filtrando  y recordando la Url '.Url::current());
          //Url::remember(Url::current(),'intentona'); 
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
       
        return parent::afterAction($action, $result);
    }
}