<?php

namespace frontend\modules\acad\controllers;
use frontend\modules\acad\models\CabeceraAsignacionSyllabus;
use Yii;
use yii\data\ActiveDataProvider;
use common\helpers\h;
use frontend\modules\acad\models\AcadSyllabus;
use frontend\modules\acad\models\AcadSyllabusSearch;
use common\controllers\base\baseController;
use common\models\masters\Cursos;
use common\models\masters\DocentesSearch;
use common\models\masters\Docentes;
use common\models\masters\PlanesEstudio;
use frontend\modules\acad\models\AcadVwSyllabusCursoDoceSearch;
use common\models\masters\Planes;
use yii\web\NotFoundHttpException;
//use yii\base\Model;
use yii\filters\VerbFilter;

/**
 * SyllabusController implements the CRUD actions for AcadSyllabus model.
 */
class SyllabusController extends baseController
{
    public $nameSpaces = ['frontend\modules\acad\models'];
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
     * Lists all AcadSyllabus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AcadSyllabusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AcadSyllabus model.
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
     * Creates a new AcadSyllabus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($plan_id,$docente_id)
    {
       if (is_null(PlanesEstudio::findOne($plan_id)) or is_null(Docentes::findOne($docente_id)))
         return 'Valores invalidos';        
        $model = new AcadSyllabus();
        $model->setScenario($model::SCE_CREACION_BASICA);
        $model->setAttributes([
            'plan_id'=>$plan_id,
            'docente_owner_id'=>$docente_id,
            'formula_id'=>1,//HASTA TENER LA TABLA DE EWDUARDO
           ]);
        $model->setAttributes([
                        'curso_id'=>$model->plan->curso_id,
                        'codperiodo'=>$model->plan->plan->codperiodo,
                        'formula_id'=>1,
            ]);
        //var_dump($model->plan->curso_id);die();
       $otroModelo= $model::find()->andWhere([
            'plan_id'=>$plan_id,
            'docente_owner_id'=>$docente_id,
           ])->one();
       
       if(!is_null($otroModelo)){
           return $this->redirect(['update', 'id' => $otroModelo->id]); 
       }elseif($model->save()){
           $model->refresh();
           return $this->redirect(['update', 'id' => $model->id]);
       }else{
          echo $model->getFirstError();die(); 
       }
        
        
            
        
        
        

    }

    /**
     * Updates an existing AcadSyllabus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    { 
        $model = $this->findModel($id);  
       
        /*Lineas para hacer funcional el edit-column*/
         if ($this->is_editable() && h::request()->isAjax)
            return $this->editField();
         /*nada mas */
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AcadSyllabus model.
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
     * Finds the AcadSyllabus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AcadSyllabus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AcadSyllabus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base_labels', 'The requested page does not exist.'));
    }
    
    public function actionSyllabusAsignarDocente(){
       /* echo \frontend\modules\acad\models\AcadRespoSyllabus::find()
         ->alias('t')
        ->select(['t.id','x.ciclo','x.codcursocorto','c.descripcion'])->
          rightJoin('{{%planes_estudio}} x', "x.id=t.plan_estudio_id")->
          innerJoin('{{%cursos}} c',"c.id=x.curso_id ")->createCommand()->rawSql;
         die();*/
        $model=new CabeceraAsignacionSyllabus();
        return $this->render('asignar_syllabus_docentes',['model'=>$model]);
        
    }
    
     public function actionAjaxPrueba(){
         $this->layout="install";
       if(h::request()->isAjax){
         
       $dataProvider=new ActiveDataProvider(
        [
          'query'=>(new \yii\db\Query())->
        select(['x.id','x.ciclo','x.codcursocorto','c.descripcion'])->
        from('{{%acad_responsables_syllabus}} t')->
       // alias('t')->
          rightJoin('{{%planes_estudio}} x', "x.id=t.plan_estudio_id")->
          innerJoin(Cursos::tableName().' c',"c.id=x.curso_id "),
            'pagination'=>[
                'pageSize'=>20,
            ]
            
        ]);
           
           
         RETURN  $this->render('grilla_curso_docente',['dataProvider'=>$dataProvider]);
           
       }
        
     }
   
    public function actionPlanes(){
        $searchModel = new \frontend\modules\acad\models\AcadVwPlanesEstudioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index_planes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } 
    
      public function actionModalCreaDocente($id){        
         $this->layout = "install";
        $modelPlan = \common\models\masters\PlanesEstudio::findOne($id);
        if(is_null($modelPlan))return '';
        
        $model=New \frontend\modules\acad\models\AcadRespoSyllabus([
            'plan_estudio_id'=>$id
        ]);
       $datos=[];
        if(h::request()->isPost){
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();                
                return ['success'=>1,'id'=>$model->id];
            }
        }else{
           return $this->renderAjax('modal_docente_responsable', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
            ]);  
        }
       
    }
    
    
     public function actionModalEditaDocente($id){        
        
        $model= \frontend\modules\acad\models\AcadRespoSyllabus::findOne($id);
        if(is_null($model))return '';
       
       $datos=[];
        if(h::request()->isPost){
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();                
                return ['success'=>1,'id'=>$model->id];
            }
        }else{
           return $this->renderAjax('modal_docente_responsable', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
            ]);  
        }
       
    }
    
    public function actionIndexDocentes(){
        $searchModel = new DocentesSearch();
        $dataProvider = $searchModel->
           search(Yii::$app->request->queryParams);
        return $this->render(
                             'index_docente', 
                             [
                              'searchModel' => $searchModel,
                              'dataProvider' => $dataProvider,
                             ]
                            ); 
    }
    
    public function actionManageDocente($id){
        $model= \common\models\masters\Docentes::findOne($id);
        if(is_null($model))return 'no hay registro';
        $searchModel = new \frontend\modules\acad\models\AcadVwPlanesEstudioSearch();
       // VAR_DUMP(Yii::$app->request->queryParams);DIE();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       // VAR_DUMP($dataProvider->query->createCommand()->rawSql);DIE();
        return $this->render('manage_docente', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
        
        
    }
    
   public function actionAjaxAsignaCurso(){
       if(h::request()->isAjax){
            h::response()->format = \yii\web\Response::FORMAT_JSON;
           $plan_id=h::request()->get('plan_id');
           $docente_id=h::request()->get('docente_id');
           $plan=\common\models\masters\PlanesEstudio::findOne($plan_id);
           $docente=\common\models\masters\Docentes::findOne($docente_id);
           if(is_null($docente) or is_null($plan))
             return ['error'=>yii::t('base_errors','Record not found')];  
           $model=New \frontend\modules\acad\models\AcadRespoSyllabus([
               'docente_id'=>$docente_id,
               'plan_estudio_id'=>$plan_id,
           ]);
          if($model->save()){
              return ['success'=>yii::t('base_errors','Course has been added')];
          }else{
              return ['error'=>yii::t('base_errors',$model->getFirstError())];
          }
           
       }
   }
   
   public function actionIndexCursosAsignados(){
        $searchModel = new AcadVwSyllabusCursoDoceSearch();
        $dataProvider = $searchModel->
           search(Yii::$app->request->queryParams);
        return $this->render(
                             'index_cursos_asignados', 
                             [
                              'searchModel' => $searchModel,
                              'dataProvider' => $dataProvider,
                             ]
                            ); 
    }
    
    
    public function actionModalCrearUnidad($id){
        $this->layout='install';
        if(is_null(AcadSyllabus::findOne($id)))return 'no hay registro';        
        $model= new \frontend\modules\acad\models\AcadSyllabusUnidades([
            'syllabus_id'=>$id
        ]);
       $datos=[];
        if(h::request()->isPost){
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();                
                return ['success'=>1,'id'=>$model->id];
            }
        }else{
           return $this->renderAjax('modal_unidad', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
            ]);  
        }
    }
   
     public function actionModalEditarUnidad($id){
        $this->layout='install';
       $model= \frontend\modules\acad\models\AcadSyllabusUnidades::findOne($id);
       if(is_null($model))return 'No hay registro';
       $datos=[];
        if(h::request()->isPost){
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();                
                return ['success'=>1,'id'=>$model->id];
            }
        }else{
           return $this->renderAjax('modal_unidad', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
            ]);  
        }
    }
    
    public function actionModalEditarCompe($id){
        $this->layout='install';
       $model= \frontend\modules\acad\models\AcadSyllabusCompetencias::findOne($id);
       if(is_null($model))return 'No hay registro';
       $datos=[];
        if(h::request()->isPost){
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();                
                return ['success'=>1,'id'=>$model->id];
            }
        }else{
           return $this->renderAjax('modal_compe', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
            ]);  
        }
    }
    
    public function actionAjaxGenerateContent($id){
          
         $model= \frontend\modules\acad\models\AcadSyllabusUnidades::findOne($id);
        if(h::request()->isAjax){  
            h::response()->format = \yii\web\Response::FORMAT_JSON;
            $model->generateContenidoSyllabusByUnidad();
            return ['success'=>yii::t('base_labels','The content has been generated')];
        }
    }
    
    public function actionAjaxShowContent(){
        $this->layout="install";
        if (h::request()->isAjax) {
            $id = h::request()->post('expandRowKey');
           // $dataProvider= \frontend\modules\acad\models\AcadContenidoSyllabusSe
            
            
            
            
             return $this->render('_expand_contenido',[
              'identidad_unidad'=>$id,
              
              ]);
        }
        
        
         
         
    }
    
     public function actionModalEditContent($id){
        $this->layout='install';
       $model= \frontend\modules\acad\models\AcadContenidoSyllabus::findOne($id);
       if(is_null($model))return 'No hay registro';
       $datos=[];
        if(h::request()->isPost){
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();                
                return ['success'=>1,'id'=>$model->id];
            }
        }else{
           return $this->renderAjax('modal_contenido', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
            ]);  
        }
    }
    
     public function actionModalAddTeacher($id){
        $this->layout='install';
        if(is_null($modelSyllabus= AcadSyllabus::findOne($id))){
            return 'No existe registro';
        }
       $model= new \frontend\modules\acad\models\AcadSyllabusDocentes([
           'syllabus_id'=>$modelSyllabus->id,
       ]);
       
       if(is_null($model))return 'No hay registro';
       $datos=[];
        if(h::request()->isPost){
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>2,'msg'=>$datos];  
            }else{
                $model->save();                
                return ['success'=>1,'id'=>$model->id];
            }
        }else{
           return $this->renderAjax('modal_add_teacher', [
                        'model' => $model,
                        'id' => $id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
            ]);  
        }
    }
    
    public function actionMakeSyllabusPdf($id){
        $this->layout="install";
        $model=$this->findModel($id);
        
        $vistaHtml=$this->render('/reportes/syllabus',['model'=>$model]);
        $mpdf=$this->preparePdf($vistaHtml);
        $mpdf->Output();
       // return $vistaHtml;
        
        //return  $vistaHtml;
    }
    
    
    
    
   private function preparePdf($contenidoHtml) {
        //  $contenidoHtml = \Pelago\Emogrifier\CssInlinerCssInliner::fromHtml($contenidoHtml)->inlineCss()->render();
        //->renderBodyContent(); 
        $mpdf = \frontend\modules\report\Module::getPdf();
        // $mpdf->SetHeader(['{PAGENO}']);
       /// $mpdf->margin_header = 1;
        //$mpdf->margin_footer = 1;
        //$mpdf->setAutoTopMargin = 'stretch';
       // $mpdf->setAutoBottomMargin = 'stretch';

        $stylesheet = file_get_contents(\yii::getAlias("@frontend/web/css/documentos.css")); // external css
        //$stylesheet2 = file_get_contents(\yii::getAlias("@frontend/web/css/reporte.css")); // external css
       $mpdf->WriteHTML($stylesheet, 1);
        //$mpdf->WriteHTML($stylesheet2,1);

        /*$mpdf->DefHTMLHeaderByName(
                'Chapter2Header', $this->render("/citas/reportes/cabecera")
        );*/
        //$mpdf->DefHTMLFooterByName('pie',$this->render("/citas/reportes/footer"));
        //$mpdf->SetHTMLHeaderByName('Chapter2Header');
        // $contenidoHtml = \Pelago\Emogrifier\CssInliner::fromHtml($contenidoHtml)->inlineCss($stylesheet)->render();
        $mpdf->WriteHTML($contenidoHtml);
        return $mpdf;
    }
    
}
