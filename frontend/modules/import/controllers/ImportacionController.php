<?php
namespace frontend\modules\import\controllers;
/*Paquete de importacion */
/*use ruskid\csvimporter\CSVReader;
use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\BaseUpdateStrategy;
use ruskid\csvimporter\BaseImportStrategy;
use ruskid\csvimporter\ARUpdateStrategy;
use ruskid\csvimporter\ARImportStrategy;*/
/*fin del paquetre de importacion*/

use Yii;
use frontend\modules\import\models\ImportCargamasiva;
use frontend\modules\import\ModuleImport AS m;
use frontend\modules\import\models\ImportCargamasivaSearch;
use frontend\modules\import\models\ImportLogcargamasivaSearch;
use frontend\modules\import\models\ImportCargamasivadet;
use frontend\modules\import\models\ImportCargamasivadetSearch;
use frontend\modules\import\models\ImportCargamasivaUser;
use frontend\modules\import\models\ImportCargamasivaUserSearch;
//use frontend\modules\import\models\ImportLogcargamasivaSearch;
use common\controllers\baseController;
use common\helpers\timeHelper;
use common\helpers\h;
use common\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\db\Exception;
use yii\web\Response;
use yii\web\Request;
use yii\filters\VerbFilter;
//use common\helpers\h;

/**
 * ImportController implements the CRUD actions for ImportCargamasiva model.
 */
class ImportacionController extends baseController
{
    /**
     * {@inheritdoc}
     */
    
    public $vTime;

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
     * Lists all ImportCargamasiva models.
     * @return mixed
     */
    public function actionIndex()
    {
       /// $importer = new CSVImporter;  die();
        $searchModel = new ImportCargamasivaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImportCargamasiva model.
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
     * Creates a new ImportCargamasiva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImportCargamasiva();

        if ($model->load(Yii::$app->request->post())  && $model->save()) {
            //print_r($model->ordenCampos());die();
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            //print_r($model->getErrors());die();
        }
        
         
        
        
        
        
        
        

        return $this->render('create', [
            'model' => $model,
           // 'itemsFields'=>$itemsFields,
            // 'itemsLoads'=>$itemsLoads,
        ]);
    }

    /**
     * Updates an existing ImportCargamasiva model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
       $model = $this->findModel($id);
      /*  $path='/home/wwwcase/public_html/frontend/uploads/store/dd/4b/71/dd84bb713ed92ca03e6363bd73f6625f.txt';  
       $model->importCargamasivaUser[0]->attachFromPath($path);
       die();*/
        //echo get_class($model->importCargamasivaUser[0]);die();
        //print_r($model->camposClave());die();
        $searchModelFields = new ImportCargamasivadetSearch();
        $dataProviderFields = $searchModelFields->searchById($id);
            $searchModelLoads = new ImportCargamasivaUserSearch();
        $dataProviderLoads = $searchModelLoads->searchById($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'itemsFields'=> $dataProviderFields,
            'itemsLoads'=> $dataProviderLoads,
        ]);
    }

    /**
     * Deletes an existing ImportCargamasiva model.
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
     * Finds the ImportCargamasiva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImportCargamasiva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImportCargamasiva::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(m::t('m_import', 'The requested page does not exist.'));
    }
    
    
  public function actionImport($id){
      
     // set_time_limit(300); // 5 minutes 
      //$id=h::request()->get('id');
      $tinicial= microtime(true);
     $verdadero=(h::request()->get('verdadero')=='1')?true:false; //Verdadero=true , ya no es una simulacion
     $carga=$this->findModelCarga($id);
     yii::error('Comenzando la importacion',__METHOD__);
     
     $numeroregistros=$carga->importar($verdadero);
    //var_dump($carga->getErrors());die();
     $searchModel = new \frontend\modules\import\models\ImportLogCargamasivaSearch();
     $dataProvider = $searchModel->searchByCarga(Yii::$app->request->queryParams,$carga->id);
    //se interrumpio por falta de tiempo, se grabo el registro con status abierto porque falta 
     
      
     $nerrores=$dataProvider->getTotalCount();
     $arrayResumen=[
         'Numero de línea de inicio de proceso'=>$carga->firstLineTobegin(),         
         'Numero de registros a Procesar'=>$carga->total_linea-$carga->firstLineTobegin()+1 ,
         'Número de registros Procesados'=>$numeroregistros,
         //'Porcentaje de registros Procesados'=>($numeroregistros*100/($carga->total_linea-$carga->firstLineTobegin()+1 )). ' % ',
         'Numero de registros encontrados con errores'=>$nerrores,
         'Numero de registros Totales en el Archivo'=>$carga->total_linea,
         'Tiempo transcurrido'=> ((integer)(microtime(true)-$tinicial)).' '.m::t('base.names','Segundos'),
         'Numero de errores de carga'=>$nerrores,
     ];
    $resultado=$this->renderAjax('_resultados',[
         'resumen'=>$arrayResumen,
       'dataProvider'=>$dataProvider,
         //'searchModel' =>$searchModel,
       //'deltaTime'=>microtime(true)-$tinicial,
       'errores'=>$carga->getErrors(),
       'nerrores'=>$nerrores,
       'model'=>$carga
                                ]); 
    
   if(h::request()->get('isJson')=='si'){
      h::response()->format = \yii\web\Response::FORMAT_JSON;  
       $resul=[];
       $resul['success']= \yii\helpers\Json::encode($resultado);
       return $resul;
   }else{  
     return $resultado;
    }
  } 
    
    
    
    public function actionImportar($id){ //id carga el ID del importimportacionuser
        ///$namemodule=$this->module->id;
        $verdadero=(h::request()->get('verdadero')=='1')?true:false; //Verdadero=true , ya no es una simulacion
        $interrumpido=false;
        $this->vTime=microtime(true);
        $carga=$this->findModelCarga($id);
        /*Verificando si tiene el archivo de carga adjunto*/
        $this->VerifyHasAttachment($carga);
         $cargamasiva=$carga->cargamasiva;
      //$cargamasiva=$this->findModel($id);//carga ell modelo cabecera
      $cargamasiva->verifyChilds();//Verificando las filas hijas de metadatos
     // $carga=$cargamasiva->activeRecordLoad();   //Sel eccionamos el registro que esta pendieente
      /*
       * AQUI VERIFICAMOS EL STATUS DEL REGISTRO A CARGAR
       * DEPENDIENDO DE SI ES MODON PRUEBA SIMUALCRO() O MODO CARGA
       * 
       */
      $this->validateStatus($carga->activo, $verdadero);      
      $datos=$carga->dataToImport(); //todo el array de datos para procesar, siempre empezara desde current_linea para adelante 
     $carga->verifyFirstRow(); //Verifica la primera fila valida del archivo csv, esto quiere decir que no neesarimente sera la primer linea 
       $carga->flushLogCarga();//Borra cualquier huella anterior en el log de carga
        $filashijas=$cargamasiva->ChildsAsArray();
   $linea=1;
    foreach ($datos as $fila){  
        //Devuelve el modelo asociado a la importacion
        //dependiendo si es insercion o actualizacion usa una u otra funcion
         $model=($cargamasiva->insercion)?
                 $cargamasiva->modelAsocc():
                 $cargamasiva->findModelAsocc($fila);         
       //var_dump($fila,$filashijas); die();
      //$model->setAttributes($cargamasiva->AttributesForModel($fila,$filashijas));
       //var_dump($model->attributes);DIE();
      //var_dump($model->attributes,$model->validate(),$model->getErrors()); die(); 
      $carga->setAttributes([
                  'current_linea'=>$linea,
                   //'total_linea'=>$this->count($datos),
                   'status'=>$carga::STATUS_ABIERTO,
                  ]);
      //print_r($fila);print_r($cargamasiva->AttributesForModel($fila,$filashijas));die();
        $model->setAttributes($cargamasiva->AttributesForModel($fila,$filashijas));
      if(/*$verdadero*/true){
          $model->save();
      }  else{
         $model->validate(); 
      } 
      if($model->hasErrors()){
          // var_dump($model->getErrors()); die(); 
          $carga->logCargaByLine($linea,$model->getErrors());
      }
     unset($model);  
     $deltaTime=microtime(true)-$this->vTime;
      if(timeHelper::excedioDuracion($deltaTime)){
             // $carga->status=$carga::STATUS_ABIERTO;
              $carga->save();
              $interrumpido=!$interrumpido;
             break;
       }  
      $linea++;   
          
    } 
    $searchModel = new \frontend\modules\import\models\ImportLogCargamasivaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //se interrumpio por falta de tiempo, se grabo el registro con status abierto porque falta 
    if($interrumpido){
        return $this->render('break',['model'=>$carga,'dataprovider'=>$dataprovider]);
    }else{
        ///SI  HAY ERRORES MANTENER EL STATUS ABIERTO PORQUE NO ESTA PROBADO OK
        $carga->setScenario('status');
        if($carga->nerrores()>0){
            $carga->activo=$carga::STATUS_PROBADO_ERRORES;
        }else{ //Si no hay errores  CAMBIAR STATUS adecuado 
          
          $carga->activo=($verdadero)?$carga::STATUS_CARGADO:$carga::STATUS_PROBADO; 
        }        
        $carga->save();
      //Mostar errores o nada  
   return $this->renderAjax('_resultados',[
       'dataprovider'=>$dataProvider,
       'deltaTime'=>$deltaTime
                                ]); 
    }
    
    
    }
    
    
    private function error($mensaje){
        throw new \yii\base\Exception(m::t('import.errors',$mensaje));
    }
  
      
    
    
  public function actionImportarTrue($id){
      ///$namemodule=$this->module->id;
      $cargamasiva=$his->findModel($id); 
      
      /*Si no encuentra errores 
       * hay que hacerlo*/
      
     if($cargamasiva->nerrores()==0){
        $datos=$cargamasiva->dataToImport();
        $model=$cargamasiva->modelAsocc();
        $filashijas=$cargamasiva->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
   
            foreach ($datos as $fila){
                $model->setAttributes(prepareAttributesToModel($fila,$filashijas));
                $model->save();      
          
                } 
          }
      /*Borramos el archivo csv de carga*/
        $cargamasiva->deleteCsvFile();
   $searchModel = new ImportLogCargamasivaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('info',['dataprovider'=>$dataprovider]);
      
  }
  
  public function actionEscenarios(){
      /* Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $clave = $parents[0];
           $modelo=new $clave;
           $escenarios=array_keys($modelo->scenarios());
           foreach($escenarios as $clave=>$escenario){
          $out[]=['id'=>$escenario,'name'=>$escenario];
             }
           
            return ['output'=>$out, 'selected'=>''];
        }
    }
    return ['output'=>'', 'selected'=>''];*/
     if(h::request()->isAjax){
       $clase=h::request()->post('filtro'); 
       $clase=new $clase;
       $arr=array_keys($clase->scenarios());
     }
      
     return \yii\helpers\Html::renderSelectOptions(null,array_combine($arr,$arr));
}

/*agrega una carga */
public function actionNewCarga(){
    
    if(h::request()->isAjax){
         h::response()->format =Response::FORMAT_JSON;
        $model=$this->findModel(h::request()->post('identidad'));
        //$detalle=New ImportCargamasivaUser();
        $attributes=[
            'cargamasiva_id'=>$model->id,
             'descripcion'=>'CARGA MASIVA-'. uniqid(),
            'activo'=>'10',
             'tienecabecera'=>$model->tienecabecera,
            ];
        $errores=[];
        if(ImportCargamasivaUser::firstOrCreateStatic($attributes,'minimo')){
            $errores['success']=m::t('sta.messages','Se creó la carga exitosamente');
        }else{
             $errores['error']=ym::t('sta.messages','No se pudo crear la carga');
        }
       return $errores;
     }
}





public function actionDeleteCarga(){
    
}

public function actionLoadCarga($idcarga){
    $modeloCarga=$this->findModelCarga($idcarga);
    
}



/*MATRIZ DE ACCIONES Y ESTADOS PARA 
 * VER QUE BOTEONES ESTAN VISIBELS 
 * O QUE ACCIONES TOMAR EN FUNCION DEL ESTADO
 * DEL MODELO ImportCargamasivaUser
 */
 public function isVisible($buttonName,$status){
    //$status=$status.'';
     $access[ ImportCargamasivaUser::STATUS_ABIERTO]=[
           'deleteCarga',
          // 'loadCarga',
           'attachCarga',
           //'detachCarga',
           //'tryCarga',
           'detailCarga',
                        ];
         $access[ ImportCargamasivaUser::STATUS_ADJUNTO]=[
           'deleteCarga',
          'pushCarga',
           //'attachCarga',
           'detachCarga',
           'tryCarga',
           'detailCarga',
                        ];
        $access[ ImportCargamasivaUser::STATUS_PROBADO]=[
           'deleteCarga',
          'pushCarga',
           //'attachCarga',
           'detachCarga',
           'tryCarga',
           'detailCarga',
                        ];
         $access[ ImportCargamasivaUser::STATUS_CARGADO]=[
           //'deleteCarga',
          'pushCarga',
           //'attachCarga',
           //'detachCarga',
           'tryCarga',
           'detailCarga',
                        ];
         $access[ ImportCargamasivaUser::STATUS_CARGADO]=[
           //'deleteCarga',
          //'pushCarga',
           //'attachCarga',
           //'detachCarga',
          // 'tryCarga',
           'detailCarga',
                        ];
     
    //VAR_DUMP(ImportCargamasivaUser::STATUS_ABIERTO,$buttonName,$status+0,array_values($access[$status+0]));DIE();
    // var_dump($buttonName,array_values($access[$status+0]));die();
        // $arri1=array_values($access[$status.'']);
         $arri2=array('deleteCarga','pushCarga','detailCarga','tryCarga','detachCarga');
        // var_dump($access[$status],$buttonName);die();
         return in_array($buttonName,$access[$status]/*array_values($access[$status+0])*/);
 } 
 
 public function  findModelCarga($idcarga){
     if (($model = ImportCargamasivaUser::findOne($idcarga)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(m::t('sta.errors', 'El registro no existe'));
    
     
 }
 
 /*VERIFICA QUE EL ARCHIVO DE CARGA TENGA YA EL ADJUNTO */
 public function  VerifyHasAttachment($carga){
     if (!$carga->hasFileCsv()) { 
         throw new NotFoundHttpException(m::t('sta.errors', 'No hay archivo adjunto'));
        }
 }
 
 /*Gnerera un archivo csv ejemplo*/
 public function actionExampleCsv($id){
     $model=$this->findModel($id); 
     //$model=new ImportCargamasiva();
    // $model->attachBehavior($name, $behavior);
     $route=$model->generateExampleCsv(
             $model->modelAsocc()
             );
    
      return Yii::$app->response->sendFile($route);   
     }
  public function actionExampleFileCsv($id){
     
     $clase='\\'.str_replace('_','\\',h::request()->get('calse'));
     $campoforaneo=h::request()->get('campoforaneo');
      $model=$this->findModel($id); 
     $route=$model->generateExampleCsv(
             new $clase,$campoforaneo
             );
    
      return Yii::$app->response->sendFile($route);   
     }   
     
 
 
       
}
      
      
      
   

