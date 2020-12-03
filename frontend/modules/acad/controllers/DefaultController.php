<?php

namespace frontend\modules\acad\controllers;

use yii\web\Controller;
use common\controllers\base\baseController;
/**
 * Default controller for the `acad` module
 */
class DefaultController extends baseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    
    
   
}
