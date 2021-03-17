<?php

namespace frontend\modules\encuesta\controllers;

use Yii;
use frontend\modules\encuesta\models\EncuestaPreguntaEncuesta;
use frontend\modules\encuesta\models\EncuestaPreguntaEncuestaSearch;
use frontend\modules\encuesta\models\EncuestaEncuestaGeneral;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PreguntaEncuestaController implements the CRUD actions for EncuestaPreguntaEncuesta model.
 */
class PreguntaEncuestaController extends Controller
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
     * Lists all EncuestaPreguntaEncuesta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EncuestaPreguntaEncuestaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EncuestaPreguntaEncuesta model.
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
     * Creates a new EncuestaPreguntaEncuesta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_encuesta)
    {
        $model = new EncuestaPreguntaEncuesta([
            'id_encuesta' => $id_encuesta,
            'id_tipo_pregunta'=>1,
            'pregunta'=>"wsasd",
        ]);
        $model_encuesta = EncuestaEncuestaGeneral::findOne(['id'=>$id_encuesta]);
        $numero_preguntas = $model_encuesta->numero_preguntas;
        $titulo_encuesta = $model_encuesta->titulo_encuesta;

        if ($model->load(Yii::$app->request->post())/*$model->load(Yii::$app->request->post()) && $model->save()*/) {            
             for ($i=0; $i <$numero_preguntas ; $i++) { 
                 # code...                
                 $newmodel = new EncuestaPreguntaEncuesta([
                    'id_encuesta' => $id_encuesta,
                     'id_tipo_pregunta'=>$model->array_id_tipo_pregunta[$i],
                     'pregunta'=>$model->array_pregunta[$i],
                ]);
                 

                 $newmodel->save(false);
            }
            
            return $this->redirect(['index']);
            
            
        }

        return $this->render('create', [
            'model' => $model,
            'numero_preguntas' =>$numero_preguntas,
            'titulo_encuesta' => $titulo_encuesta
        ]);
    }

    /**
     * Updates an existing EncuestaPreguntaEncuesta model.
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
     * Deletes an existing EncuestaPreguntaEncuesta model.
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
     * Finds the EncuestaPreguntaEncuesta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EncuestaPreguntaEncuesta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EncuestaPreguntaEncuesta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
