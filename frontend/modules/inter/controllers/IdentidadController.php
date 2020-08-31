<?php

namespace frontend\modules\inter\controllers;

use Yii;
use frontend\modules\inter\models\InterConvocados;
use frontend\modules\inter\models\InterConvocadosSearch;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;
use common\models\masters\AlumnosSearch;
use common\models\masters\Alumnos;
use frontend\modules\inter\Module AS m;
/**
 * ConvocadosController implements the CRUD actions for InterConvocados model.
 */
class IdentidadController extends baseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

 public function actionApplyProgram($stage){
     
     
 }
    
    
    
    
}
