<?php

namespace frontend\modules\encuesta\controllers;

use Yii;
use frontend\modules\encuesta\models\EncuestaOpcionesPregunta;
use frontend\modules\encuesta\models\EncuestaOpcionesPreguntaSearch;
use frontend\modules\encuesta\models\EncuestaPreguntaEncuesta;
use frontend\modules\encuesta\models\EncuestaEncuestaGeneral;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;

/**
 * OpcionesPreguntaController implements the CRUD actions for EncuestaOpcionesPregunta model.
 */
class OpcionesPreguntaController extends Controller
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
     * Lists all EncuestaOpcionesPregunta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EncuestaOpcionesPreguntaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EncuestaOpcionesPregunta model.
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
     * Creates a new EncuestaOpcionesPregunta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_encuesta)
    {
        $model = new EncuestaOpcionesPregunta();
        $model_encuesta = EncuestaEncuestaGeneral::findOne(['id'=>$id_encuesta]);
        $numero_preguntas = $model_encuesta->numero_preguntas;
        
        $model_preguntas = EncuestaPreguntaEncuesta::find()->andWhere(['id_encuesta'=>$id_encuesta])->all();
        // yii::error('PPPPPP');
        // foreach ($model_preguntas as $pregunta){
            
        //     yii::error('PRUEBA OPCIONES PREGUNTA.. '.$pregunta);
             

        // }

        if ($model->load(Yii::$app->request->post())) {
            
            foreach ($model_preguntas as $i => $pregunta) {
                # code...
                $indice = 'array'.($i+1);
                var_dump("asd");die();
                if(h::getTipoPreguntaEncuesta($pregunta->id_tipo_pregunta) == 'MULTIPLE'){
                    
                    foreach ($model->$indice as $index => $array) {
                        # code...
                        $opcion = new EncuestaOpcionesPregunta([
                            'id_pregunta' =>$pregunta->id,
                            'valor' => $array['valor'],
                            'descripcion' =>$array['descripcion'],
                        ]);
                           
                        $opcion->save(false);
                    }
                    
                }
            }
           // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'model_preguntas' => $model_preguntas,
            'numero_preguntas'=> $numero_preguntas,

        ]);
    }

    /**
     * Updates an existing EncuestaOpcionesPregunta model.
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
     * Deletes an existing EncuestaOpcionesPregunta model.
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
     * Finds the EncuestaOpcionesPregunta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EncuestaOpcionesPregunta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EncuestaOpcionesPregunta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
