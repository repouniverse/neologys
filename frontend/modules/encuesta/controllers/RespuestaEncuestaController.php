<?php

namespace frontend\modules\encuesta\controllers;

use frontend\modules\encuesta\models\EncuestaEncuestaGeneral;
use Yii;
use frontend\modules\encuesta\models\EncuestaRespuestaEncuesta;
use frontend\modules\encuesta\models\EncuestaRespuestaEncuestaSearch;
use frontend\modules\encuesta\models\EncuestaEncuestaGeneralSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \common\models\base\modelBase;
use common\helpers\h;
use common\models\masters\GrupoPersonas;
use frontend\modules\encuesta\models\EncuestaPreguntaEncuesta;
use common\models\masters\Trabajadores;

/**
 * RespuestaEncuestaController implements the CRUD actions for EncuestaRespuestaEncuesta model.
 */
class RespuestaEncuestaController extends Controller
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

    /**
     * Lists all EncuestaRespuestaEncuesta models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new EncuestaEncuestaGeneralSearch();
        
        if (!is_null(($persona = h::user()->profile->persona))) {
            if (!is_null($grupo = GrupoPersonas::findOne($persona->codgrupo))) {
                //var_dump(  $grupo->codgrupo);die();
                
                if($grupo->codgrupo == '100' && !is_null($trabjador = Trabajadores::findOne(['persona_id'=>$persona->id]))){
                    //id_dep_encargado
                    //$searchModel->id_dep_encargado = $trabjador->depa_id;
                
                }else{

                
                $searchModel->id_tipo_usuario = $grupo->codgrupo;
                $searchModel->id_persona = h::user()->profile->persona->id;
                }

            }
        }


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
     * Displays a single EncuestaRespuestaEncuesta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EncuestaRespuestaEncuesta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EncuestaRespuestaEncuesta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EncuestaRespuestaEncuesta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EncuestaRespuestaEncuesta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EncuestaRespuestaEncuesta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EncuestaRespuestaEncuesta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EncuestaRespuestaEncuesta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
