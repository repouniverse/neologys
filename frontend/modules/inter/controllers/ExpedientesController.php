<?php

namespace frontend\modules\inter\controllers;
use frontend\modules\inter\Module as m;
use Yii;
use frontend\modules\inter\models\InterExpedientes;
use frontend\modules\inter\models\InterEntrevistas;
use frontend\modules\inter\models\InterExpedientesSearch;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;

/**
 * ExpedientesController implements the CRUD actions for InterExpedientes model.
 */
class ExpedientesController extends baseController
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
     * Lists all InterExpedientes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InterExpedientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InterExpedientes model.
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
     * Creates a new InterExpedientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InterExpedientes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InterExpedientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
           h::session()->setFlash('success', m::t('labels','Data has been recorded'));
        }
        $convocado=$model->convocado;
         $persona=$convocado->persona;
        $identidad=$persona->identidad;
       
        
        return $this->render('/expedientes/planes/marco_general', [
            'persona' => $persona,
            'model' => $model,
            'identidad'=>$identidad,
            'convocado'=>$convocado
        ]);
    }

    /**
     * Deletes an existing InterExpedientes model.
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
     * Finds the InterExpedientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InterExpedientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InterExpedientes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base_labels', 'The requested page does not exist.'));
    }
    
    public function actionProgramInterview($id){
        $model=$this->findModel($id);
        
        $eventosHorarios=$model->plan->eventsToCalendar();
        $eventosHorarios[]=[
            'id' => '3336565',
            'title' => 'CITA',
            'start' => '2020-09-02 11:30:00',
            'end' => '2020-09-02 12:30:00',
            'color' => '#FF0000',
           // 'codtra' => $this->codtra
        ];
        $eventosHorarios[]=[
            'id' => '333446565',
            'title' => 'CITA',
            'start' => '2020-09-02 12:30:00',
            'end' => '2020-09-02 13:30:00',
            'color' => '#00ff00',
           // 'codtra' => $this->codtra
        ];
        //var_dump($eventosHorarios);die();
       return  $this->render('calendario',['model'=>$model, 'eventosHorarios'=> $eventosHorarios]);
        
    }
    
   public function actionUpdateInterEntrevista($id)
    {
       $this->layout="install";
        /*$model = $this->findModelInterEntrevista($id);
        $persona = $model->convocado->persona;
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $modelExp->redirect(['view', 'id' => $idExpediente]);
            h::session()->setFlash('success',m::t('labels','¡First step has been completed...!'));
            return array_merge(ActiveForm::validate($model),ActiveForm::validate($persona));
        }
        
        return $this->render('update_entrevista', [
            'model' => $model,'persona' => $persona
        ]);*/
        
        $model = $this->findModelInterEntrevista($id);
        $persona=$model->convocado->persona;        
        //$model->setScenario($model::SCENARIO_BASICO);
        
        if (h::request()->isPost)
        {
            $model->load(h::request()->post());
        }
        
        if (h::request()->isAjax && $model->load(h::request()->post())) 
        {
            h::response()->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            h::session()->setFlash('success',m::t('labels','¡First step has been completed...!'));
            //return $this->redirect(Url::to([h::user()->resolveUrlAfterLogin()]));
        }
        
        yii::error('a putno de renderizar',__FUNCTION__);
        return $this->render('update_entrevista', 
                      [
                        'model' => $model,
                        'persona'=>$persona
                      ]);
        
    }
    
    
    public function actionModalEditEntrevista($id){
     $this->layout = "install";
        $model = $this->findModelInterEntrevista($id);
        $persona=$model->convocado->persona; 
        $datos=[];
       
        
        if(is_null($model)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        
        
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
           return $this->renderAjax('modal_update_entrevista', [
                        'model' => $model,
                        'persona'=>$persona,
                        //'docente_id'=> $model->docente_id,
                        'gridName'=>'PjaxCalendar',
                        'idModal'=>'buscarvalor',
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  }  
    
    
    protected function findModelInterEntrevista($id)
    {
        if (($model = InterEntrevistas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(m::t('validaciones', 'The requested page does not exist.'));
    } 
    
  
   public function actionAjaxAsisteEntrevista($id){
     
      if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model= \frontend\modules\inter\models\InterEntrevistas::findOne($id);
          if(is_null($model)){
            throw new NotFoundHttpException(m::t('labels', 'Record with id {identidad} not found',['identidad'=>$id]));  
          }else{
              if($model->asiste()){
                  return ['success'=>m::t('labels','File was aprobed')];
              }else{
                  return ['error'=>m::t('labels','There were problems').$model->getFirstError()];
              }
          }
      }
     
   } 
    
    public function actionModalViewHorarios($id){
    $this->layout="install";
    $model= \frontend\modules\inter\models\InterPlan::findOne($id);
    if(is_null($model))
      throw new NotFoundHttpException(m::t('errors', 'Record not found {id}',['id'=>$id]));
     return $this->render('_view_horarios',['model'=>$model]);
    
  }  
    
}
