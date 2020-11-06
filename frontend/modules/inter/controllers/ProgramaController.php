<?php

namespace frontend\modules\inter\controllers;
USE frontend\modules\inter\Module as m;
use Yii;
use frontend\modules\inter\models\InterPrograma;
use frontend\modules\inter\models\InterProgramaSearch;
use frontend\modules\inter\models\InterEtapas;
use frontend\modules\inter\models\InterEventos;
use frontend\modules\inter\models\InterInvitaciones;
use frontend\modules\inter\models\InterInvitacionesSearch;
use frontend\modules\inter\models\InterEventosSearch;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\BadRequestHttpException;
/**
 * ProgramaController implements the CRUD actions for InterPrograma model.
 */
class ProgramaController extends baseController
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
     * Lists all InterPrograma models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InterProgramaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InterPrograma model.
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
     * Creates a new InterPrograma model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InterPrograma();
        
        
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);


        }ELSE{
           //PRINT_R($model->getErrors());DIE();

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InterPrograma model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InterPrograma model.
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
     * Finds the InterPrograma model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InterPrograma the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InterPrograma::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(m::t('validaciones', 'The requested page does not exist.'));
    }
    
    
    
     public function actionModalNewModo($id){
     $this->layout = "install";
        $model = New \frontend\modules\inter\models\InterModos();
        $datos=[];
        $modelPrograma= InterPrograma::findOne($id);
        
        
        if(is_null( $modelPrograma)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        $model->setAttributes([
            'universidad_id'=>$modelPrograma->universidad_id,
             'facultad_id'=>$modelPrograma->facultad_id,
             'depa_id'=>$modelPrograma->depa_id,
            'programa_id'=>$modelPrograma->id,
        ]);
         if(h::request()->isPost){
            //$model->setScenario(Rangos::SCENARIO_HORAS);
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_SEGUNDA,'msg'=>$datos];  
            }else{
                $model->save();
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->facultad_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_modo', [
                        'model' => $model,
                        //'codigo_fac'=> $model->facultad_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  }  
  
  
   public function actionModalEditModo($id){
     $this->layout = "install";
        $model = \frontend\modules\inter\models\InterModos::findOne($id);
        if(is_null( $model)){
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
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->facultad_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_modo', [
                        'model' => $model,
                        //'codigo_fac'=> $model->facultad_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
     }  
     
     
      public function actionModalNewEval($id){
     $this->layout = "install";
        $model = New \frontend\modules\inter\models\InterEvaluadores();
        $datos=[];
        $modelPrograma= InterPrograma::findOne($id);        
        
        if(is_null( $modelPrograma)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        $model->setAttributes([
            'universidad_id'=>$modelPrograma->universidad_id,
             'facultad_id'=>$modelPrograma->facultad_id,
             'depa_id'=>$modelPrograma->depa_id,
            'programa_id'=>$modelPrograma->id,
        ]);
         if(h::request()->isPost){
            //$model->setScenario(Rangos::SCENARIO_HORAS);
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_SEGUNDA,'msg'=>$datos];  
            }else{
                $model->save();
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->facultad_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_eval', [
                        'model' => $model,
                        'facultad_id'=> $modelPrograma->facultad_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  }  
   public function actionModalEditEval($id){
     $this->layout = "install";
        $model = \frontend\modules\inter\models\InterEvaluadores::findOne($id);
        $datos=[];
              
        
        if(is_null( $model)){
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
           return $this->renderAjax('_modal_eval', [
                        'model' => $model,
                        'facultad_id'=> $model->facultad_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  } 
  
  
   public function actionModalNewPlan($id){
     $this->layout = "install";
        $model = New \frontend\modules\inter\models\InterPlan();
        $datos=[];
        $modelEval= \frontend\modules\inter\models\InterModos::findOne($id);        
        
        if(is_null(  $modelEval)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        $model->setAttributes([
            'universidad_id'=>$modelEval->universidad_id,
             'facultad_id'=>$modelEval->facultad_id,
            'modo_id'=>$modelEval->id,
            'depa_id'=>$modelEval->depa_id,
            'programa_id'=>$modelEval->programa_id,             
           // 'eval_id'=>$modelEval->id,
            
            
        ]);
         if(h::request()->isPost){
            //$model->setScenario(Rangos::SCENARIO_HORAS);
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_SEGUNDA,'msg'=>$datos];  
            }else{
                $model->save();
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->facultad_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_eval_plan', [
                        'model' => $model,
                        'eval_id'=> $modelEval->id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  }  
   public function actionModalEditPlan($id){
     $this->layout = "install";
        $model = \frontend\modules\inter\models\InterPlan::findOne($id);
        $datos=[];
              
        
        if(is_null( $model)){
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
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->facultad_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_eval_plan', [
                        'model' => $model,
                        'eval_id'=> $model->eval_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  } 
  
  /*aja que ocnvoca alos alumnos o docentes de un tdereminado modo
    @id: Id del Itermodos 
   *    */
  public function actionAjaxConvoca($id){
     $model= \frontend\modules\inter\models\InterModos::findOne($id);
    if(is_null($model))
     throw new NotFoundHttpException(m::t('validaciones', 'The requested page does not exist.'));
   if(h::request()->isAjax){
       h::response()->format = \yii\web\Response::FORMAT_JSON;
      
      return ['success'=>m::t('validaciones','{cantidad} records were incorporated',['cantidad'=> $model->convocaMasivamente()])];
   }
     
  }
  
  /*
   * Crea una etapa del programa 
   */
  public function actionCreateEtapa(){
  $model=New InterEtapas();
  //$model = new InterPrograma();
        
        
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            h::session()->setFlash('success', m::t('validaciones','Stage created in {modo}',['modo'=>$model->modo->descripcion]));
            return $this->redirect(['update', 'id' => $model->id]);


        }ELSE{
           //PRINT_R($model->getErrors());DIE();

        }

        return $this->render('create_etapa', [
            'model' => $model,
        ]);
      
  }
  
  
    public function actionModalNewEtapa($id){
     $this->layout = "install";
        $model = New InterEtapas();
        $datos=[];
        $modelPrograma= \frontend\modules\inter\models\InterPrograma::findOne($id);        
        
        if(is_null(  $modelPrograma)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        $model->setAttributes([
            
            'programa_id'=>$modelPrograma->id,             
           // 'eval_id'=>$modelEval->id,
            
            
        ]);
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
           return $this->renderAjax('_modal_etapa', [
                        'model' => $model,
                        'programa_id'=> $modelPrograma->id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  }  
   public function actionModalEditEtapa($id){
     $this->layout = "install";
        $model = InterEtapas::findOne($id);
        $datos=[];
              
        
        if(is_null( $model)){
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
           return $this->renderAjax('_modal_etapa', [
                        'model' => $model,
                        'programa_id'=> $model->programa_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  } 
  
  public function actionViewPlan($id){
    $model= \frontend\modules\inter\models\InterPlan::findOne($id);
    if(is_null($model))
      throw new NotFoundHttpException(m::t('validaciones', 'Record not found {id}',['id'=>$id]));
     return $this->render('_view_plan',['model'=>$model]);
    
  } 
  
  public function actionCreateHorario($id){
     $this->layout = "install";
       $modelPlan= \frontend\modules\inter\models\InterPlan::findOne($id);
         if(is_null($modelPlan))
      throw new NotFoundHttpException(m::t('validaciones', 'Record not found {id}',['id'=>$id]));
     
       $model = New \frontend\modules\inter\models\InterHorarios();
        $datos=[];
        //$modelPlan= Talleres::findOne($id);
        if(is_null($modelPlan)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        $model->setAttributes([
       //'universidad_id'=>$$modelPlan->universidad_id,
             'facultad_id'=>$modelPlan->facultad_id,
            'etapa_id'=>$modelPlan->etapa_id,
            'plan_id'=>$modelPlan->id,
            'programa_id'=>$modelPlan->programa_id, ]);  
      
        if(h::request()->isPost){
            $model->setScenario(\frontend\modules\inter\models\InterHorarios::SCENARIO_HORAS);
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
           return $this->renderAjax('_modal_rangos', [
                        'model' => $model,
                        'idTaller' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  } 
  public function actionEditHorario($id){
     $this->layout = "install";
        $model = \frontend\modules\inter\models\InterHorarios::findOne($id);
        $datos=[];
        if(is_null($model)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        
      
        if(h::request()->isPost){
            $model->setScenario(\frontend\modules\inter\models\InterHorarios::SCENARIO_HORAS);
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
           return $this->renderAjax('_modal_rangos', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  } 

  
  public function actionIndexPlans(){
       $searchModel = new \frontend\modules\inter\models\InterVwPlanesSearch();
      
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_planes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
  }
  
  public function actionAjaxRellenaHorarios($id){
      if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model= \frontend\modules\inter\models\InterPlan::findOne($id);
    if(is_null($model))
      throw new NotFoundHttpException(m::t('validaciones', 'Record not found {id}',['id'=>$id]));
      $model->generateRangos();
       return ['success'=>m::t('validaciones','Schedules have been generated')];
      
    
      }
  }
  
   /*
   * Crea una etapa del programa 
   */
  public function actionCreateEvento(){
  $model=New InterEventos();
  //$model = new InterPrograma();
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //h::session()->setFlash('success', m::t('labels','Stage created in {modo}',['modo'=>$model->modo->descripcion]));
            return $this->redirect(['index-eventos', 'id' => $model->id]);
        }ELSE{
           //PRINT_R($model->getErrors());DIE();

        }
        return $this->render('create_evento', [
            'model' => $model,
        ]);
      
  }
  
   /*
   * Crea una etapa del programa 
   */
  public function actionEditEvento($id){
  $model= InterEventos::findOne($id);
  if(is_null($model))
  throw new NotFoundHttpException(m::t('validaciones', 'Record not found'));
   
  //$model = new InterPrograma();
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //h::session()->setFlash('success', m::t('labels','Stage created in {modo}',['modo'=>$model->modo->descripcion]));
            return $this->redirect(['index-eventos', 'id' => $model->id]);
        }ELSE{
           //PRINT_R($model->getErrors());DIE();

        }
        return $this->render('update_evento', [
            'model' => $model,
        ]);
      
  }
  
  
  public function actionIndexEventos(){
     $searchModel = new InterEventosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       //echo yii::$app->language; die();
        return $this->render('index_eventos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);  
  }
  
   /*
   * Crea una etapa del programa 
   */
  public function actionCreateInvitacion($id){
    $docente= \common\models\masters\Docentes::findOne($id);
    
    
    if(is_null($docente))
    throw new BadRequestHttpException(m::t('validaciones','Teacher not found'));
     if(!$docente->isExternal())
    throw new BadRequestHttpException(m::t('validaciones','This teacher is not external'));
   
     $model=New InterInvitaciones(); 
        $model->docenteinv_id=$docente->id;
         $model->universidad_id=$docente->universidad_id;
         $model->facultad_id=$docente->facultad_id;
         
      
       
      $programa=$this->findModel(m::currentPrograma());
        
  //$model->facultad_id=
  //$model = new InterPrograma();
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //h::session()->setFlash('success', m::t('labels','Stage created in {modo}',['modo'=>$model->modo->descripcion]));
            return $this->redirect(['index-invitaciones', 'id' => $model->id]);
        }ELSE{
           //PRINT_R($model->getErrors());DIE();

        }
        return $this->render('create_invitacion', [
            'model' => $model,'programa'=>$programa,'docente'=>$docente
        ]);
      
  }
  
   /*
   * Crea una etapa del programa 
   */
  public function actionEditInvitacion($id){
  $model= InterInvitaciones::findOne($id);
  $docente=$model->docenteanfi;
  $programa=$this->findModel(m::currentPrograma());
  if(is_null($model))
  throw new NotFoundHttpException(m::t('validaciones', 'Record not found'));
   
  //$model = new InterPrograma();
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //h::session()->setFlash('success', m::t('labels','Stage created in {modo}',['modo'=>$model->modo->descripcion]));
            return $this->redirect(['index-invitaciones', 'id' => $model->id]);
        }ELSE{
           //PRINT_R($model->getErrors());DIE();

        }
        return $this->render('update_invitacion', [
            'model' => $model,'programa'=>$programa,'docente'=>$docente
        ]);
      
  }
  
  
  public function actionIndexInvitaciones(){
     $searchModel = new InterInvitacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_invitaciones', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);  
  }
  
public function actionRutas(){
 $model=   \frontend\modules\inter\models\InterConvocados::findOne(1428);
 //var_dump($model->currentStage());die();
 $model->createExpedientes($model->currentStage());
}
  

public function actionTest(){
    \frontend\modules\inter\models\InterPrograma::createMagicPrograma(
            4,
            10,
            '2020-II',
            '118');
    die();
    
}

public function actionGenerateUsers($id){
    if(h::request()->isAjax){
       h::response()->format = \yii\web\Response::FORMAT_JSON;  
     $modoId=h::request()->get('idmodo',null);
     if(!is_null($modoId) && !is_null(\frontend\modules\inter\models\InterModos::findOne($modoId)) ){
        $model=$this->findModel($id);
         $model->generateUsers($modoId);
         return ['success'=>m::t('labels','Users has been generated')];
      }else{
          return ['error'=>m::t('labels','There is not idMode parameter')];
      }
      
     }
         
      
   }


}
