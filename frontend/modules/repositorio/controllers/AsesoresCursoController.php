<?php

namespace frontend\modules\repositorio\controllers;

use Yii;
use common\models\masters\Alumnos;
use common\models\masters\Matricula;
use common\models\masters\AsesoresCurso;
use common\models\masters\AsesoresCursoSearch;
use common\filters\ActionIsIdentidadFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;

/**
 * AsesorescursoController implements the CRUD actions for AsesoresCurso model.
 */
class AsesorescursoController extends \common\controllers\base\baseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'filtroIdentidad'=>[
               'class' => ActionIsIdentidadFilter::className(), 
                'only' => [
                    'modal-asesorcurso',
                    'create','update'
                ],
            ],
            
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AsesoresCurso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsesoresCursoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AsesoresCurso model.
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
     * Creates a new AsesoresCurso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

public function actionModalAsesorcurso($id){
     $this->layout = "install";
       $modelMatricula=Matricula::findOne($id);
       if(is_null($modelMatricula))return null;
        $model = New AsesoresCurso();
        $model->matricula_id=$id;
        $model->alumno_id=h::user()->profile->persona->identidad->id;
        $datos=[];
                
              
        /// $model->facultad_id=$modelFacultad->id;
        if(h::request()->isPost){
            //$model->setScenario(Rangos::SCENARIO_HORAS);
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_SEGUNDA,'msg'=>$datos];  
            }else{
                $model->save();
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_asesorescurso', [
                        'model' => $model,
                        'matricula_id'=> $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  }


    public function actionCreate()
    {
      // ECHO  Matricula::nMatriculados('2020II',null,'031652>10NLB');DIE();
        
     
        $model = new AsesoresCurso();
        $modelalumno=Yii::$app->user->profile->persona->identidad;

        if($modelalumno instanceof Alumnos){

        $model->alumno_id=$modelalumno->id;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model, 'modelalumno' => $modelalumno
        ]);
    }else{
        return $this->render('noesalumno', [
            'model' => $model,
        ]);
    }
    }

    /**
     * Updates an existing AsesoresCurso model.
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
     * Deletes an existing AsesoresCurso model.
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
     * Finds the AsesoresCurso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AsesoresCurso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AsesoresCurso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}