<?php

namespace backend\modules\base\controllers;
use backend\modules\base\Module as m;
use Yii;
//use common\filters\ActionAuditFilter;
use common\models\masters\GrupoParametros;
use common\models\masters\Combovalores;
use common\models\masters\CombovaloresSearch;
use common\models\masters\GrupoParametrosSearch;
use common\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * ConfiguracionController implements the CRUD actions for GrupoParametros model.
 */
class ConfiguracionController extends baseController
{
    /**
     * {@inheritdoc}
     */
     public function actions()
    {
        return [
            'parametros-basicos' => [
                'class' => \common\actions\ActionSettingList::class,
               'seccion'=>'general',
                'nameView' => 'admin-settings',
            ],
            
            'parametros-mail' => [
                'class' => \common\actions\ActionSettingList::class,
               'seccion'=>'mail',
                'searchClass' => 'common\models\masters\SettingsGenSearch',
                'nameView' => 'admin-settings',
            ],
            
            'crear-settings' => [
                'class' => \yii2mod\settings\actions\SettingsAction::class,
                // also you can use events as follows:
                'on beforeSave' => function ($event) {
                    // your custom code
                },
                'on afterSave' => function ($event) {
                    // your custom code
                },
                'modelClass' => \backend\modules\base\models\ConfiguracionForm::class,
                'sectionName'=>'general',
                        //'view'=>'general',
            ],
             'update-setting' => [
                'class' => \yii2mod\settings\actions\ActionSettingUpdate::class,
                // also you can use events as follows:
                'on beforeSave' => function ($event) {
                    // your custom code
                },
                'on afterSave' => function ($event) {
                    // your custom code
                },
                'modelClass' => \yii2mod\settings\models\SettingModel::class,
                'sectionName'=>'general',
                        //'view'=>'general',
            ],
        ];
    }

    /**
     * Lists all GrupoParametros models.
     * @return mixed
     */
    public function actionIndex()
    {       
        $searchModel = new GrupoParametrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GrupoParametros model.
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
     * Creates a new GrupoParametros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GrupoParametros();
        
        
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
     * Updates an existing GrupoParametros model.
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
     * Deletes an existing GrupoParametros model.
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
     * Finds the GrupoParametros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GrupoParametros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GrupoParametros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(m::t('validaciones', 'The requested page does not exist.'));
    }
    
    /*
     * Los 
     */
    public function actionIndexComboValores(){
         $searchModel = new CombovaloresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_combo_valores', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionViewComboValores($id)
    {
        return $this->render('view_combo_valores', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Combovalores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateComboValores()
    {
        $model = new Combovalores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-combo-valores', 'id' => $model->id]);
        }

        return $this->render('create_combo_valores', [
            'model' => $model,
        ]);
    }

     public function actionUpdateComboValores($id)
    {
        $model = \common\models\masters\ComboValores::findOne($id);
      if(!is_null($model)){
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) ) {
            //$model->nombreCampo=h::request()->post()['ModelCombo']['nombreCampo'];
            //$model->nombreModelo= \common\helpers\FileHelper::getShortName(h::request()->post()['ModelCombo']['nombreModelo']);
          
            if($model->save()){
                 h::session()->setFlash('success',m::t('validaciones','The record was saved...!'));
            return $this->redirect(['index-combo-valores']);
            }  else{
                //print_r($model->getErrors());die();
            }
           
        }

        return $this->render('update_combo_valores', [
            'model' => $model,
        ]);
       }else{
         throw new NotFoundHttpException(m::t('validaciones', 'The requested page does not exist.'));
     
       }
    }
    
    
    public function actionIndexCamposValores(){
         $searchModel = new \common\models\masters\ModelComboSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          return $this->render('index_campos_valores', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } 
    
    public function actionCreateCampoValores()
    {
        $model = new \common\models\masters\ModelCombo();
                
        if ($model->load(Yii::$app->request->post()) ) {
           
           IF($model->save()){
                h::session()->setFlash('success',m::t('labels','The record was saved...!'));
            return $this->redirect(['index-campos-valores', 'id' => $model->id]);
          
           }
        }else{
            //print_r($model->getErrors());die();
        }

        return $this->render('create_campo_valores', [
            'model' => $model,
        ]);
    }
    
    
    public function actionUpdateCampoValores($id)
    {
        $model = \common\models\masters\ModelCombo::findOne($id);
      if(!is_null($model)){
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) ) {
            //$model->nombreCampo=h::request()->post()['ModelCombo']['nombreCampo'];
            //$model->nombreModelo= \common\helpers\FileHelper::getShortName(h::request()->post()['ModelCombo']['nombreModelo']);
          
            if($model->save()){
                 h::session()->setFlash('success',m::t('labels','The record was saved...!'));
            return $this->redirect(['index-campos-valores']);
            }  else{
                //print_r($model->getErrors());die();
            }
           
        }

        return $this->render('update_campo_valores', [
            'model' => $model,
        ]);
       }else{
         throw new NotFoundHttpException(m::t('validaciones', 'The requested page does not exist.'));
     
       }
    }
   
    
 public function actionIndexTransacciones(){
    
     
      $searchModel = new \common\models\masters\TransaccionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          return $this->render('index_transacciones', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
 }   
 

public function actionAjaxEditTransaccion(){
   if( h::request()->isAjax)
     h::response()->format = Response::FORMAT_JSON;
   $campo=Yii::$app->request->post('name');
   $valor=Yii::$app->request->post('value');
   $pk = unserialize(base64_decode(Yii::$app->request->post('pk')));
  // var_dump(Yii::$app->request->post('pk'),$pk,$campo,$valor);die();
     $model= \common\models\masters\Transacciones::findOne(['name'=>$pk]);  
   $model->{$campo}=$valor;
   if( $model->save()){
      return ['success',m::t('validaciones','The record was saved successfully')];
    }else{
        return ['error'=>m::t('validaciones','There were problems when recording:{problem}',['problem'=>$model->getFirstError()])];
    }
               
} 
 
 public function actionAjaxEditSettingValue(){
   if( h::request()->isAjax)
     h::response()->format = Response::FORMAT_JSON;
  // $campo=Yii::$app->request->post('name');
   //$key=Yii::$app->request->post('value');
   //$model= \yii2mod\settings\models\SettingModel();
   $campo=Yii::$app->request->post('name');
    $valor=Yii::$app->request->post('value');
   $pk = unserialize(base64_decode(Yii::$app->request->post('pk')));
   $model=\yii2mod\settings\models\SettingModel::findOne($pk);
  // h::settings()->set()
  // var_dump(Yii::$app->request->post('pk'),$pk,$campo,$valor);die();
     
     
   $model->{$campo}=$valor;
   if( $model->save()){
      return ['success',m::t('validaciones','The record was saved successfully')];
    }else{
        return ['error'=>m::t('validaciones','There were problems when recording:{problem}',['problem'=>$model->getFirstError()])];
    }
               
}
    
}
