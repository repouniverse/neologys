<?php
/*
 * Clase creada por JRamírez 24/074/2020
 * Para registrar los actions en la auditoría
 * Anteriormente la auditorái solo registraba 
 * lso cambios en las tablas, con este filtro
 * podemos detectar los actions importantes 
 * registrados en cada controlador y poder
 * regiostrar auditoría, y rstrear no sólo los cambios 
 * en los datos, si no también las rutas o proced
 * efetuados por el usuario, siempre que estén
 * marcados como importantes. 
 */
namespace common\filters;
use common\helpers\h;
use Yii;
use yii\base\ActionFilter;

class LanguageFilter extends ActionFilter
{
    public function beforeAction($action)
    {
       if(!h::UserIsGuest()){
        if(!empty($lan=h::user()->language))
          \Yii::$app->language=$lan;  
       }
       
        return parent::beforeAction($action);
    }
    
    
}

