<?php

namespace frontend\modules\report\controllers;

use yii\web\Controller;

/**
 * Default controller for the `bigitems` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionMas()
    {
        return $this->render('index');
    }
    
    
    
    
}
