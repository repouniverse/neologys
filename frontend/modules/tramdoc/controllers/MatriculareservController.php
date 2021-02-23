<?php

namespace frontend\modules\tramdoc\controllers;

use Yii;
use frontend\modules\tramdoc\models\TramdocMatriculaReserv;
use frontend\modules\tramdoc\models\TramdocMatriculaReservSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use common\helpers\h;
use \common\models\base\modelBase;
use common\models\masters\Personas;
use common\models\masters\Trabajadores;
use frontend\modules\tramdoc\models\TramdocFilesReserv;

/**
 * MatriculareservController implements the CRUD actions for TramdocMatriculaReserv model.
 */
class MatriculareservController extends Controller
{   
    //PARA LOS DOCUMENTOS DE FILE_RESERV
    const DOCU_COMPROBANTE_PAGO_ADJUNTO='211';
    const DOCU_SOLICITUD_REGISTRADA_ADJUNTO='235';

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
     * Lists all TramdocMatriculaReserv models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TramdocMatriculaReservSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TramdocMatriculaReserv model.
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
     * Creates a new TramdocMatriculaReserv model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TramdocMatriculaReserv();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TramdocMatriculaReserv model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {   
        $persona_actual_id = User::findOne(h::userId())->profile->persona->id;
        $trabajador = Trabajadores::findOne(['persona_id'=>$persona_actual_id]);
        $file_pago_tram =  TramdocFilesReserv::findOne(['matr_reserv_id'=>$id, 'docu_id' => self::DOCU_COMPROBANTE_PAGO_ADJUNTO]);
        $file_solicitud = TramdocFilesReserv::findOne(['matr_reserv_id'=>$id, 'docu_id' => self::DOCU_SOLICITUD_REGISTRADA_ADJUNTO ]);

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'trabajador' => $trabajador,
            'file_pago_tram' => $file_pago_tram,
            'file_solicitud' => $file_solicitud,
        ]);
    }

    /**
     * Deletes an existing TramdocMatriculaReserv model.
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
     * Finds the TramdocMatriculaReserv model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TramdocMatriculaReserv the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TramdocMatriculaReserv::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
