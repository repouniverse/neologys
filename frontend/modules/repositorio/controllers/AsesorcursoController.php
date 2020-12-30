<?php
namespace frontend\modules\repositorio\controllers;

use Yii;
use common\models\masters\Alumnos;
use common\models\masters\Docentes;
use common\models\masters\Matricula;
use common\models\masters\AsesoresCurso;

use common\models\masters\AsesoresCursoSearch;
use frontendRepoVwAsesoresAsignadosSearch;
use common\filters\ActionIsIdentidadFilter;
use frontend\modules\repositorio\models\RepoVwAsesoresAsignados;
use frontend\modules\repositorio\models\RepositorioAsesoresCursoDocs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;
use frontend\modules\repositorio\models\RepoVwAsesoresAsignadosSearch;

/**
 * AsesorescursoController implements the CRUD actions for AsesoresCurso model.
 */
class AsesorcursoController extends \common\controllers\base\baseController
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
       
      /* \common\helpers\ComboHelper::getCboAsesores($modelMatricula->curso_id,
               $modelMatricula->seccion);*/
       
       
       
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
                $this->redirect(Url::to(['/respositorio/asesorcurso/agradecimiento']));
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_asesorescurso', [
                        'model' => $model,
                        'matricula_id'=> $id,
               'modelMatricula'=>$modelMatricula,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  }


    public function actionCreate()
    {
       $model = new AsesoresCurso();
        $modelalumno=Yii::$app->user->profile->persona->identidad;
    if($modelalumno instanceof Alumnos ){
          if($tienecursos=$modelalumno->hasCursosTalleres(Yii::$app->controller->module::PROCESO_TALLER_TESIS)){
             $model->alumno_id=$modelalumno->id;        
        return $this->render('create', [
            'model' => $model, 'modelalumno' => $modelalumno,
            'tienecursos'=>$tienecursos
        ]); 
          }else{
               return $this->render('nocursos', [
               'model' => $model,
                 ]); 
          }
            
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
    
    
    public function actionRegularizar(){
        $ase=\common\models\masters\Asesores::find()->All();
        foreach($ase as $fila){
            $persona=\common\models\masters\Personas::find()
            ->andWhere(['id'=>$fila->persona_id])->one();
            $fila->docente_id=$persona->identidad->id;
            $fila->save();
            
        }
    }
    
    
    public function actionAjaxAsignaAsesor($id){
       if(h::request()->isAjax){
            h::response()->format = \yii\web\Response::FORMAT_JSON;
           $idMat=h::request()->get('idMat',null);
           if(is_null($idMat)){
               return ['error'=>'No paso el id correcto de curso matriculado'];
           }
           //var_dump($idMat);die();
             $modelMatricula=Matricula::findOne($idMat);
       
       if(is_null($modelMatricula))return ['error'=>'No paso el id correcto de curso matriculado'];
       
$mod=\common\models\masters\DocenteCursoSeccion::findOne($id);
       if(is_null($mod))return ['error'=>'No paso el id correcto de asesor'];
       
       
       
       $model = New AsesoresCurso();
        $model->matricula_id=$modelMatricula->id;
        $model->asesor_id=$mod->id;
        $model->alumno_id=h::user()->profile->persona->identidad->id;
        
       if( !$model->save()){
           return ['error'=>$model->getFirstError()];
       }ELSE{
           return ['success'=>'Asignaste tu asesor correctamente'];
       }
            
            
       }
        
    }
   
   public function actionAdminAsesores(){
       $searchModel = new RepoVwAsesoresAsignadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('asesores_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
       
   }
    
   
   public function actionManageFiles()
    {
      
        $modelalumno=Yii::$app->user->profile->persona->identidad;
        $modelVista=RepoVwAsesoresAsignados::find()->andWhere(['alumno_id'=>$modelalumno->id])->one();
     if(is_null($modelVista)){
         return $this->render('noesalumno', [
            'model' => $modelalumno,
        ]); 
     }
        $modelVista->generateDocs();
    if($modelalumno instanceof Alumnos ){
          if($tienecursos=$modelalumno->hasCursosTalleres(Yii::$app->controller->module::PROCESO_TALLER_TESIS)){
             //$model->alumno_id=$modelalumno->id;        
        return $this->render('filesUpload', [
             'modelalumno' => $modelalumno,'model'=>$modelVista
            //'tienecursos'=>$tienecursos
        ]); 
          }else{
               return $this->render('nocursos', [
               'model' => $model,
                 ]); 
          }
            
    }else{
        return $this->render('noesalumno', [
            'model' => $model,
        ]); 
    }
    
    
    }
   
    
 public function actionPanelAsesor()
    {
      // $model = new AsesoresCurso();
        $modelDocente=Yii::$app->user->profile->persona->identidad;
        /*var_dump(Yii::$app->user->profile->persona->id,
               Yii::$app->user->profile->persona->identidad 
                );
        die();*/
    if($modelDocente instanceof Docentes ){
          if($tieneAsesorados=$modelDocente->hasAsesorados()){
                 
        return $this->render('panel_asesor', [
             'modelDocente' => $modelDocente,
            'tieneAsesorados'=>$tieneAsesorados
        ]); 
          }else{
               return $this->render('nocursos', [
               'model' => $modelDocente,
                 ]); 
          }
            
    }else{
        return $this->render('noesalumno', [
            'model' => $modelDocente,
        ]); 
    }
    
    
    }
   
 public function actionAjaxShowDocs(){
      $this->layout="install";
        if (h::request()->isAjax) {
            var_dump($_POST);
            var_dump(h::request()->post('expandRowKey'));
            die();
            $id = h::request()->post('expandRowKey');
            
           // $dataProvider= \frontend\modules\acad\models\AcadContenidoSyllabusSe
           return $this->render('_expand_contenido',[
              'identidad_unidad'=>$id,
              
              ]);
        }
  }
  
  public function actionManageAttachments($id){
    $model=$this->findModel($id);
    $modelVista= RepoVwAsesoresAsignados::findOne(['id'=>$id]);
    $modelVista->generateDocs();
    return $this->render('manage_attachments',['model'=>$model]);
      
  }
  
 public function actionZipear(){
     $codocu=h::request()->get('codocu');
      $offset=h::request()->get('offset',1);
     RepositorioAsesoresCursoDocs::zipeaArchivos($codocu,$offset);
 } 
  
  
}