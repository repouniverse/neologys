<?php

namespace frontend\modules\maestros\controllers;

use yii\web\Controller;

use Yii;
use common\helpers\h;
use common\models\masters\Periodos;
use common\models\masters\Documentos;
use common\models\masters\DocumentosSearch;
use common\models\masters\Facultades;
use common\models\masters\FacultadesSearch;
use common\models\masters\Personas;
use common\models\masters\PersonasSearch;
use common\models\masters\PeriodosSearch;
use frontend\controllers\base\baseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * Default controller for the `maestros` module
 */
class DefaultController extends \common\controllers\baseController

{
     public function actionIndexPeriodo()
    {
        $searchModel = new PeriodosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_periodo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Periodos model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewPeriodo($id)
    {
        return $this->render('view_periodo', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Periodos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePeriodo()
    {
        $model = new Periodos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-periodo', 'id' => $model->codperiodo]);
        }

        return $this->render('create_periodo', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Periodos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatePeriodo($id)
    {
        $model = $this->findModelPeriodo($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-periodo', 'id' => $model->codperiodo]);
        }

        return $this->render('update_periodo', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Periodos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeletePeriodo($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Periodos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Periodos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelPeriodo($id)
    {
        if (($model = Periodos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('bigitems.labels', 'The requested page does not exist.'));
    }
    
    
    
    /**
     * Lists all Documentos models.
     * @return mixed
     */
    public function actionIndexDocu()
            
    {
       // echo yii::t('models.errors','hello friends');
        
        //die();
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_docu', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documentos model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewDocu($id)
    {
        return $this->render('view_docu', [
            'model' => $this->findModelDocu($id),
        ]);
    }

    /**
     * Creates a new Documentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateDocu()
    {
       
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-docu']);
        }

        return $this->render('create_docu', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documentos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateDocu($id)
    {
        $model = $this->findModelDocu($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['index-docu']);
        }

        return $this->render('update_docu', [
            'model' => $model,
        ]);
    }

    

    /**
     * Finds the Documentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Documentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelDocu($id)
    {
        if (($model = Documentos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
    
    
    
    
     
    /**
     * Lists all Documentos models.
     * @return mixed
     */
    public function actionIndexFacul()
            
    {
       // echo yii::t('models.errors','hello friends');
        
        //die();
        $searchModel = new FacultadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_facul', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documentos model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewFacul($id)
    {
        return $this->render('view_facul', [
            'model' => $this->findModelFacul($id),
        ]);
    }

    /**
     * Creates a new Documentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateFacul()
    {
       
        $model = new Facultades();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-facul']);
        }

        return $this->render('create_facul', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documentos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateFacul($id)
    {
        $model = $this->findModelFacul($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['index-facul']);
        }

        return $this->render('update_facul', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Documentos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteDocu($id)
    {
        $this->findModelFacul($id)->delete();

        return $this->redirect(['index-facul']);
    }

    /**
     * Finds the Documentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Documentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelFacul($id)
    {
        if (($model = Facultades::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
    
    
    
        /**
     * Lists all Trabajadores models.
     * @return mixed
     */
    public function actionIndexPersona()
    { 
        $searchModel = new PersonasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

   return $this->render('index_personas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
//}
        
    }

    /**
     * Displays a single Trabajadores model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewPersona($id)
    {
         $model=$this->findModelPersona($id);
        // var_dump(h::request()->isAjax,$model->load(h::request()->post()));die();
         if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El registro se ha grabado');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view-persona', 'id'=>$model->id]);
        } else {
            return $this->render('view_personas', ['model'=>$model]);
        }
        
        
        
        
        
       
    }

    /**
     * Creates a new Trabajadores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePersona()
    {
        $model = new Personas();
        
       
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
        }
        
        
        
        if ($model->load(h::request()->post()) && $model->save()) {
            return $this->redirect(['view_personas', 'id' => $model->id]);
        }

        return $this->render('create_personas', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Trabajadores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatePersona($id)
    {
        $model = $this->findModelPersona($id);
     
       /* $modito=\frontend\modules\import\models\ImportCargamasivaUser::find(31)->one();
        $modito->setScenario('fechita');
        $modito->fechacarga=date('Y-m-d H:i:s');
        $modito->fechacarga=$modito->swichtDate('fechacarga',true);*/
        //var_dump(Carbon::now());die();
        //var_dump($modito->fechacarga,$modito->save(),$modito->getFirstError());die();
        // var_dump(date('d/m/Y H:i:s'));die();
         if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
        }
        
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['view-persona', 'id' => $model->id]);
        }

        
        
        return $this->render('update_personas', [
          'model'=>$model
        ]);
    }

    /**
     * Deletes an existing Trabajadores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeletePersona($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index-persona']);
    }

    /**
     * Finds the Trabajadores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Trabajadores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelPersona($id)
    {
        if (($model = Personas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base.errors', 'The requested page does not exist.'));
    }
    
    
    
    
    
    
    
    
    
}
