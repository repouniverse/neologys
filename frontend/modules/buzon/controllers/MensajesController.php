<?php

namespace frontend\modules\buzon\controllers;

use Yii;
use frontend\modules\buzon\models\BuzonMensajes;
use frontend\modules\buzon\models\BuzonMensajesSearch;
use frontend\modules\buzon\models\BuzonVwMensajes;
use frontend\modules\buzon\models\BuzonVwMensajesSearch;
use common\models\masters\Personas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\h;
use yii\base\DynamicModel;
use common\models\User;
use frontend\modules\buzon\models\BuzonCordiAcad;
use frontend\modules\buzon\models\BuzonUserNoreg;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * MensajesController implements the CRUD actions for BuzonMensajes model.
 */
class MensajesController extends Controller
{
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

        $trabajador_por_definir = Personas::findOne(['numerodoc' => '77175855']);
        $model = new BuzonMensajes();
        //$model::guardarMensaje();
        //$this->layout= 'install';

        $model->setAttributes([
            'user_id' => h::userId(),
            'prioridad' => self::BUZON_MENSAJE_PRIORIDAD,
            'trabajador_id' => $trabajador_por_definir->id,
            'fecha_registro' => null,
        ]);
        //para las validaciones mediante ajax
        /*if($model->load(Yii::$app->request->post()) && yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
           }*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreatenr()
    {
        $trabajador_por_definir = Personas::findOne(['numerodoc' => '77175855']);
        $model = new BuzonMensajes();
        /*$modelusernr = new BuzonUserNoreg([
            'bm_id'=> 1,
            'esc_id' => 1,
            'nombres' => 'asldk',
            'ap' => 'ram',
            'am' => 'mon',
            'numerodoc' => 12313,
            'email' => 'iam@gmail.com',
            'celular' => '995595955',                  
        ]);*/
        
        //$model = new BuzonCordiAcad();
        
        $model->setAttributes([
            'user_id' => null,
            'prioridad' => self::BUZON_MENSAJE_PRIORIDAD,
            'trabajador_id' => $trabajador_por_definir->id,
            'fecha_registro' => null,
        ]);
        //$model::guardarMensaje();
        $this->layout = 'install';


        if ($model->load(Yii::$app->request->post()) && $model->save()) {


                yii::error("CON FE 5");
                return $this->redirect(['index']);
            
            //var_dump($modelusernr->bm_id.$modelusernr->ap.$modelusernr->celular.$modelusernr->nombres);die();
              
      
        }


        return $this->render('createnr', [
            'model' => $model,
            
        ]);
    }
    public function actionModalPrueba(){
        //$this->layout = 'install';
        return $this->renderAjax('modal_prueba', [
            
            'idModal' => h::request()->get('idModal'),
            
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

        return $this->render("panel_manager_admin", [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //PORA MOSTRA EL MODAL DE VER DETALLES DE UN MENSAJE 
    public function actionModalVerMensaje($id)
    {
        $this->layout = 'install';
        $model = BuzonVwMensajes::findOne(['buzon_mensaje_id' => $id]);
        if (is_null(BuzonMensajes::findOne($id))) {
            return 'no hay registro';
        } else {
            // $model = BuzonMensajes::findOne(['id' => $id]);
            if (!is_null($model)) {
                return $this->renderAjax('modal_ver_mensaje', [
                    'model' => $model,
                    'gridName' => h::request()->get('gridName'),
                    'idModal' => h::request()->get('idModal'),
                ]);
            } else {
                return 'no hay registro';
            }
        }
    }

    public function actionModalResponderMensaje($id)
    {

        $this->layout = 'install';
        $model = BuzonMensajes::findOne(['id' => $id]);
        if (is_null($model)) return 'No hay registro';
        $datos = [];
        if (h::request()->isPost) {
            $model->load(h::request()->post());
            $userActual = User::findOne(h::userId());
            $model->trabajador_id = $userActual->profile->persona->id;
            h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos = \yii\widgets\ActiveForm::validate($model);
            if (count($datos) > 0) {
                return ['success' => 2, 'msg' => $datos];
            } else {
                $model->save();
                return ['success' => 1, 'id' => $model->id];
            }
        } else {
            return $this->renderAjax('modal_responder_mensaje', [
                'model' => $model,
                'id' => $id,
                'gridName' => h::request()->get('gridName'),
                'idModal' => h::request()->get('idModal'),
            ]);
        }
    }

    public function actionAjaxDeleteMensaje($id)
    {
        $mensaje = BuzonMensajes::findOne($id);

        if (h::request()->isAjax) {
            h::response()->format = \yii\web\Response::FORMAT_JSON;
            //$unidad->load(h::request()->post());
            if (is_null($mensaje)) {
                //$unidad->delete();
            } else {
                if ($mensaje->user_id == null) {
                    $user = BuzonUserNoreg::findOne(['bm_id' => $id]);
                    $user->delete();
                }
                ///////////////////////////////////////
                //FALTA PONER PARA ELIMINAR CORDI_ACAD 
                //FALTA ELIMINAR AULA_VIRTUAL 
                //CUANDO TE DEN EL MODELO PONLO!!! LUIS !!!
                /////////////////////////////////////////////
                $mensaje->delete();

                return ['success' => yii::t('base_labels', 'Mensaje eliminado.')];
            }
        }
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
