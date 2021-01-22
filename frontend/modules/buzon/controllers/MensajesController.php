<?php

namespace frontend\modules\buzon\controllers;

use Yii;
use frontend\modules\buzon\models\BuzonMensajes;
use frontend\modules\buzon\models\BuzonMensajesSearch;
use frontend\modules\buzon\models\BuzonVwMensajesSearch;
use common\models\masters\Trabajadores;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;

/**
 * MensajesController implements the CRUD actions for BuzonMensajes model.
 */
class MensajesController extends Controller
{    
    const BUZON_MENSAJE_ESTADO = "pendiente";
    const BUZON_MENSAJE_PRIORIDAD = "1";
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
     * Lists all BuzonMensajes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BuzonMensajesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BuzonMensajes model.
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
     * Creates a new BuzonMensajes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        
        $trabajador_por_definir = Trabajadores::findOne(['numerodoc'=>'77175855']);
        $model = new BuzonMensajes();
        //$model::guardarMensaje();
        //$this->layout= 'install';
        $model->setAttributes([
            'user_id'=>h::userId(),
            'estado'=>self::BUZON_MENSAJE_ESTADO, 
            'prioridad'=>self::BUZON_MENSAJE_PRIORIDAD,
            'trabajador_id'=>$trabajador_por_definir->id,            
            'fecha_registro'=>null,
           ]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing BuzonMensajes model.
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
     * Deletes an existing BuzonMensajes model.
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


    //PARA LA VISTA DEL ADMINISTRADOR DE MENSAJES
    public function actionPanelManagerAdmin()
    {
        $searchModel = new BuzonVwMensajesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('panel_manager_admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Finds the BuzonMensajes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BuzonMensajes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BuzonMensajes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
