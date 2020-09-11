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
class ConvocadosController extends baseController
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
     * Lists all InterConvocados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelPrograma= \frontend\modules\inter\models\InterPrograma::findOne(1);
        if(is_null($modelPrograma))
            throw new NotFoundHttpException(Yii::t('base_labels', 'The requested page does not exist.'));
  
        $searchModel = new \frontend\modules\inter\models\VwInterConvocadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'id'=>$modelPrograma->id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelPrograma'=>$modelPrograma,
        ]);
        
           
    }

    /**
     * Displays a single InterConvocados model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         $model=$this->findModel($id);
         $model->createExpedientes($model->currentStage());
       // $alumno=$model->alumno;
        $persona=$model->persona;
        $identidad=$persona->identidad;
        $current_expediente=$model->currentExpediente();
        $eventos=$current_expediente->plan->populateEventosToCalendar();
       // var_dump($eventos);die();
       
      
     
     
     
       
        $eventos=$current_expediente->plan->populateEventosToCalendar();
        $eventos=$current_expediente->putColorEventsCalendar($eventos);
        
       /* $eventos=[
                    [
                'title' => m::t('labels','eet'),
              'start' =>date('Y-m-d H:i:s'),
                'end' =>$model::CarbonNow()->addMinutes(30)->format('Y-m-d H:i:s'),
                'color' => '#e9f72057',
                     ] 
            ];*/
        return $this->render('view', [
            'current_expediente'=>$current_expediente,
            'eventos'=>$eventos,
            'model' =>$model ,
            'persona'=>$persona,
            'identidad'=>$identidad
                                ]);
    }

    /**
     * Creates a new InterConvocados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InterConvocados();
        
        
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InterConvocados model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        $modelP=$model->alumno->persona;
     /*
      * Mejora reste codigo, debe ser tartado en un accesFilter
      * no de esta manera por nurencia se ha escrito asi 
      * debe de ahber un filtro para saber si el aluunoq ue accede 
      * a su ficha de personal
      */
     //try{//intentando obtener el id de persona del usuario que iongresa a este actio
      // $currentPerson=h::user()->profile->persona;
     //} catch (Exception $ex) {
        
    // }
        
        $modelP->setScenario($modelP::SCE_INTERMEDIO);
        if (h::request()->isPost){
            //yii::error(h::request()->post()['InterConvocados'],__FUNCTION__);
         //yii::error(h::request()->post()['Personas'],__FUNCTION__);
        $model->load(h::request()->post());
        $modelP->load(h::request()->post());
        }
         
        
       // var_dump($modelP);die();
        if (h::request()->isAjax &&
            $model->load(h::request()->post()) &&
            $modelP->load(h::request()->post())    
                ) {
                  //var_dump($modelP->attributes);die();
            //yii::error('paso el ajzx',__FUNCTION__);
                h::response()->format = Response::FORMAT_JSON;
            //  yii::error('Los errores',__FUNCTION__);  
              // yii::error(ActiveForm::validateMultiple([$model,$modelP]),__FUNCTION__);
               //yii::error(ActiveForm::validate($model),__FUNCTION__);
              //  yii::error(array_merge(ActiveForm::validate($model),ActiveForm::validate($modelP)),__FUNCTION__);
                return array_merge(ActiveForm::validate($model),ActiveForm::validate($modelP));
        }
        //yii::error('continuado',__FUNCTION__);
        if ($model->load(Yii::$app->request->post()) && 
             $modelP->load(Yii::$app->request->post()) &&
                $model->save() && $modelP->save()) {
        //    yii::error('apunto de redireccionar',__FUNCTION__);
        //    if(h::userName()=='admin')
        //    return $this->redirect(['view', 'id' => $model->id]); 
            h::session()->setFlash('success',m::t('labels','¡First step has been completed...!'));
            return $this->redirect(Url::to([h::user()->resolveUrlAfterLogin()]));
        }
 yii::error('a putno de renderizar',__FUNCTION__);
        return $this->render('update', [
            'model' => $model,
            'modelP'=>$modelP
        ]);
    }

    /**
     * Deletes an existing InterConvocados model.
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

    public function actionModalNewOpuniv($id){
     $this->layout = "install";
        $model = New \frontend\modules\inter\models\InterOpuniv();
        $datos=[];
        $modelUniv= InterConvocados::findOne($id);
        
        
        if(is_null( $modelUniv)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        $model->setAttributes([
            'universidad_id'=>$modelUniv->universidad_id,
            'facultad_id'=>$modelUniv->facultad_id,
            'convocatoria_id'=>$modelUniv->id,
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
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->convocatoria_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_opuniv', [
                        'model' => $model,
                        //'codigo_fac'=> $model->facultad_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
    }
    
    public function actionModalEditOpuniv($id){
     $this->layout = "install";
        $model = \frontend\modules\inter\models\InterOpuniv::findOne($id);
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
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->convocatoria_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_opuniv', [
                        'model' => $model,
                        //'codigo_fac'=> $model->facultad_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
     } 
    
    public function actionIndexAlumnos()
    { 
        $searchModel = new AlumnosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

   return $this->render('index_alumnos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);         
    }
    
    public function actionViewAlumno($id)
    { 
        $model=Alumnos::findOne($id);
        if (is_null($model)){
            throw new NotFoundHttpException(m::t('labels', 'The requested page does not exist.'));
        }
        if (isset($_POST['hasEditable'])) {
        // use Yii's response format to encode output as JSON
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        // read your posted model attributes
        if ($model->load($_POST)) {
            // read or convert your posted information
            $value = $model->mail;
            $model->save();
            // return JSON encoded output in the below format
            return ['output'=>$value, 'message'=>''];
            
            // alternatively you can return a validation error
            // return ['output'=>'', 'message'=>'Validation error'];
        }
        // else if nothing to do always return an empty JSON encoded output
        else {
            return ['output'=>'', 'message'=>''];
            }
        }
        return $this->render('view_alumno', [
            'model' => $model,
        ]);       
    }
    
    /**
     * Finds the InterConvocados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InterConvocados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InterConvocados::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(m::t('labels', 'The requested page does not exist.'));
    }
    
    
     public function actionDeleteUnivConvo($id){
     
     //var_dump($model);die();
      if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model= \frontend\modules\inter\models\InterOpuniv::findOne($id);
            
          if(is_null($model))
                 throw new NotFoundHttpException(m::t('labels', 'The requested page does not exist.'));
                //var_dump($model::className());die();
          $this->deleteModel($id, $model::className());       
      
      return ['warning'=>m::t('labels','The record was deleted')];
            }
     }
   
     
      public function actionModalNewIdioma($id){
     $this->layout = "install";
        $model = New \frontend\modules\inter\models\InterIdiomasalu();
        $datos=[];
        $modelUniv= $this->findModel($id);
        
        
        if(is_null( $modelUniv)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        $model->setAttributes([
            'convocatoria_id'=>$modelUniv->id,
            'programa_id'=>$modelUniv->programa_id,
            'modo_id'=>$modelUniv->modo_id,
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
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->convocatoria_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_idiomas', [
                        'model' => $model,
                        //'codigo_fac'=> $model->facultad_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
    }
    
    public function actionModalEditIdioma($id){
     $this->layout = "install";
        $model = \frontend\modules\inter\models\InterIdiomasalu::findOne($id);
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
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->convocatoria_id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_idiomas', [
                        'model' => $model,
                        //'codigo_fac'=> $model->facultad_id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
    }   
      
   public function actionDeleteOpIdioma($id){
     
     //var_dump($model);die();
      if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model= \frontend\modules\inter\models\InterIdiomasalu::findOne($id);
            
          if(is_null($model))
                 throw new NotFoundHttpException(m::t('labels', 'The requested page does not exist.'));
                //var_dump($model::className());die();
          $this->deleteModel($id, $model::className());       
      
      return ['warning'=>m::t('labels','The record was deleted')];
            }
     }
     
     
     public function actionAjaxCreaExpedientes($id){
         if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model=$this->findModel($id);
          $model->createExpedientes();
           return ['success'=>'hola esto esta ok'];
         }
     }
     
   public function actionFillFicha($id){
        $model = $this->findModel($id);
        $model->setScenario($model::SCENARIO_FICHA);
        $modelP=$model->alumno->persona;
     
        $modelP->setScenario($modelP::SCE_INTERMEDIO);
        if (h::request()->isPost){
           // $model->load(h::request()->post());
            //$modelP->load(h::request()->post());
           // yii::error(h::request()->post()['InterConvocados'],__FUNCTION__);
         //yii::error(h::request()->post()['Personas'],__FUNCTION__);
        //yii::error($model->load(h::request()->post()),__FUNCTION__);
       // yii::error($modelP->load(h::request()->post()),__FUNCTION__);
        }
         
        
       // var_dump($modelP);die();
        if (h::request()->isAjax &&
            $model->load(h::request()->post()) &&
            $modelP->load(h::request()->post())    
                ) {
                  //var_dump($modelP->attributes);die();
            //yii::error('paso el ajzx',__FUNCTION__);
                h::response()->format = Response::FORMAT_JSON;
              //yii::error('Los errores',__FUNCTION__);  
              // yii::error(ActiveForm::validateMultiple([$model,$modelP]),__FUNCTION__);
               //yii::error(ActiveForm::validate($model),__FUNCTION__);
               // yii::error(array_merge(ActiveForm::validate($model),ActiveForm::validate($modelP)),__FUNCTION__);
                return array_merge(ActiveForm::validate($model),ActiveForm::validate($modelP));
        }
       // yii::error('continuado',__FUNCTION__);
        if ($model->load(Yii::$app->request->post()) && 
             $modelP->load(Yii::$app->request->post()) &&
                $model->save() && $modelP->save()) {
            //var_dump(!is_null($exp=$model->firstExpediente()));die();
            if(!is_null($exp=$model->firstExpediente()))
                if($exp->aprove()){
//aprobar le primer expediente la ficha de
                }else{
                    print_r($exp->getErrors());DIE();
                }
              //var_dump($model->currentStage());die();
//yii::error('apunto de redireccionar',__FUNCTION__);
            //if(h::userName()=='admin')
            //return $this->redirect(['view', 'id' => $model->id]); 
            h::session()->setFlash('success',m::t('labels','¡First step has been completed...!'));
            return $this->redirect(Url::to([h::user()->resolveUrlAfterLogin()]));
        }
 //yii::error('a putno de renderizar',__FUNCTION__);
        return $this->render('ficha_postulante', [
            'model' => $model,
            'modelP'=>$modelP
        ]); 
   }  
   
  public function actionUploadsDocs($id){
      $model = $this->findModel($id);
      $model->createExpedientes($model->currentStage());
      return $this->render('uploads_postulante',['model'=>$model]);
  }
   
   public function actionExpandAttachments(){
       $this->layout="install";
        if(h::request()->isAjax)  {
     $id=h::request()->post('expandRowKey');
    $model= \frontend\modules\inter\models\InterExpedientes::findone($id); 
    if(!is_null($model)){
      return $this->renderAjax('@frontend/views/comunes/adjuntos', [
                        'model' => $model,
                 //'allowedExtensions' => $allowedExtensions,
                        //'vendorsForCombo' => $vendorsForCombo,
            ]); 
        
       
    }else{
        
    }}
    }
  
  public function actionAjaxAproveExpediente($id){
      if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model=\frontend\modules\inter\models\InterExpedientes::findOne($id);
          if(is_null($model)){
            throw new NotFoundHttpException(m::t('labels', 'Record with id {identidad} not found',['identidad'=>$id]));  
          }else{
              if($model->aprove()){
                  return ['success'=>m::t('labels','File was aprobed')];
              }else{
                  return ['error'=>m::t('labels','There were problems')];
              }
          }
      }
  }
  
  public function actionAjaxDisapbrobeExpediente($id){
      if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model=\frontend\modules\inter\models\InterExpedientes::findOne($id);
          if(is_null($model)){
            throw new NotFoundHttpException(m::t('labels', 'Record with id {identidad} not found',['identidad'=>$id]));  
          }else{
              if($model->aprove(false)){
                  return ['warning'=>m::t('labels','File was disapprobed')];
              }else{
                  return ['error'=>m::t('labels','There were problems')];
              }
          }
      }
  }
  
  /*
   * Refresca el campo
   * current_etapa de la tala expedientes
   */
  public function actionAjaxRefreshEtapaExp($id){
      if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model=\frontend\modules\inter\models\InterModos::findOne($id);
          if(is_null($model)){
            throw new NotFoundHttpException(m::t('labels', 'Record with id {identidad} not found',['identidad'=>$id]));  
          }else{
              if($model->refreshStageConvocados()){
                  return ['warning'=>m::t('labels','Records were updated')];
              }else{
                  return ['error'=>m::t('labels','There were problems')];
              }
          }
      }
  }
  
 
  public function actionInterViews($id){
      
      $model = $this->findModel($id);
      
       $model->createExpedientes($model->currentStage());
      $current_expediente=$model->currentExpediente();
       $persona=$model->persona;
        $identidad=$persona->identidad;
        $eventos=$current_expediente->plan->populateEventosToCalendar();
        $eventos=$current_expediente->putColorEventsCalendar($eventos);
       // var_dump($current_expediente->id);
        //print_r($eventos);die();
      return $this->render('calendar_postulante',['eventos'=>$eventos,'persona'=>$persona,'identidad'=>$identidad,'model'=>$model,'current_expediente'=>$current_expediente]);
  }
 
  
 public function actionMakeCitaByExpediente(){
    if(h::request()->isAjax){
        h::response()->format = \yii\web\Response::FORMAT_JSON;
      
        $id=h::request()->get('id');
        $codalu=h::request()->get('codalu');
        $fecha=h::request()->get('fecha');
        $model= \frontend\modules\inter\models\InterExpedientes::findOne($id);
        $datos=[];
        $error=false; 
         
      if(is_null($model)) {
             $error=true; $datos['error']=m::t('errors','No existe el registro Expediente para el id '.$id);
         }
        if(!\common\helpers\timeHelper::IsFormatMysqlDateTime($fecha)) {
             $error=true; $datos['error']=m::t('errors','La fecha {fecha} suministrada no tiene el formato adecuado ',['fecha'=>$fecha]);
         }
          
        if(!$error) { //BUSCAR LA PERSONA ID
            /*de donde sacamos a la persona? de los departamenteos */
            $nombre= $model->depa->persona->fullName();
            $attributes=[
                'universidad_id'=>$model->universidad_id,
                'facultad_id'=>$model->facultad->id,
                'fechaprog'=>$model::SwichtFormatDate($fecha,$model::_FDATETIME,true),
                'etapa_id'=>$model->etapa_id,
                'plan_id'=>$model->plan_id,
                'persona_id'=>$model->depa->persona->id,
                'expediente_id'=>$model->id,
                'modo_id'=>$model->modo_id,
                'convocado_id'=>$model->convocado->id,
                'codperiodo'=>\common\helpers\h::periodos()->currentPeriod,
                
            ];
           // var_dump($fecha,$model::_FDATETIME,$model::SwichtFormatDate($fecha,$model::_FDATETIME,true));die();
         yii::error('creando la cita'.date('Y-m-d H:i:s'));
            $entre=New \frontend\modules\inter\models\InterEntrevistas();
           $entre->setScenario($entre::SCENARIO_BASICO);
           $entre->attributes=$attributes;
           
              if($entre->save()){
                 yii::error('grabo'.date('Y-m-d H:i:s'));
               if(h::gsetting('sta','notificacitasmail')){
                   //$cita->enviacorreo();
               }else{
                 //  print_r($entre->getErrors());
               }
               
              $datos=['success'=>m::t('errors','Se ha creado la cita {numero} con {psico} satisfactoriamente',['psico'=>$nombre,'numero'=>$entre->numero])];
              // RETURN $datos; 
            }else{
             $datos=['error'=>m::t('errors','Hubo un problema : '.$entre->getFirstError())];
                UNSET($entre);
               }
             //print_r($datos); die();
           }
            //var_dump(count($datos),$datos);die();
           //return ['success'=>'pirata'];
            return $datos; 
            
                } 
    
       
    }
 
  
}
