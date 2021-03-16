<?php

namespace frontend\modules\tramdoc\controllers;

use Yii;
use frontend\modules\tramdoc\models\Matriculareact;
use frontend\modules\tramdoc\models\MatriculareactSearch;
use common\models\User;
use common\helpers\h;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \common\models\base\modelBase;
use common\models\masters\Personas;
use common\models\masters\Trabajadores;
use frontend\modules\tramdoc\models\TramdocFiles;

/**
 * MatriculareactController implements the CRUD actions for Matriculareact model.
 */
class MatriculareactController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /*const DOCU_PAGO_TRAMITE_ADJUNTO='156';
    const DOCU_RECORD_NOTAS_ADJUNTO='157';
    const DOCU_CURSOS_APTO_ADJUNTO='159';*/
    const DOCU_PAGO_TRAMITE_ADJUNTO='211';
    const DOCU_RECORD_NOTAS_ADJUNTO='213';
    const DOCU_CURSOS_APTO_ADJUNTO='215';

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
     * Lists all Matriculareact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MatriculareactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $tramdocsMat = TramdocFiles::find()->alias('p')->select(['p.matr_id as id'])->distinct()->asArray()->all();
        $docsMat = Matriculareact::find()->where(['not in','id',$tramdocsMat])->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'docsMat' => $docsMat
        ]);
    }
 
    /**
     * Displays a single Matriculareact model.
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
     * Creates a new Matriculareact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Matriculareact();

        $model->setAttributes([
            'fecha_registro' => modelBase::CarbonNow()->format('Y-m-d'),
            'estado' => '1'
        ]);
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Matriculareact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $persona_actual_id = User::findOne(h::userId())->profile->persona->id;
        $trabajador = Trabajadores::findOne(['persona_id'=>$persona_actual_id]);
        $file_pago_tram =  TramdocFiles::findOne(['matr_id'=>$id, 'docu_id' => self::DOCU_PAGO_TRAMITE_ADJUNTO]);
        $file_record_notas = TramdocFiles::findOne(['matr_id'=>$id, 'docu_id' => self::DOCU_RECORD_NOTAS_ADJUNTO ]);
        $file_cursos_apto = TramdocFiles::findOne(['matr_id'=>$id, 'docu_id' =>self::DOCU_CURSOS_APTO_ADJUNTO ]);
        if(is_null($trabajador)){
            return $this->render('_no_es_trabajador');
        }

        $model = $this->findModel($id);
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'trabajador' => $trabajador,
            'file_pago_tram' => $file_pago_tram,
            'file_record_notas' => $file_record_notas,
            'file_cursos_apto' => $file_cursos_apto,
        ]);
    }
    public function actionAjaxDocsTram(){
        $tramdocsMat = TramdocFiles::find()->alias('p')->select(['p.matr_id as id'])->distinct()->asArray()->all();
        $docsMat = Matriculareact::find()->where(['not in','id',$tramdocsMat])->all();
        if (h::request()->isAjax) {
            h::response()->format = \yii\web\Response::FORMAT_JSON;
            //$unidad->load(h::request()->post());
            if (sizeof($docsMat)==0) {
                //return ['success' => yii::t('base_labels', 'No es necesario generar los archivos.')];
                return $this->redirect(['index']);
            } else {
                foreach($docsMat as $model){
                    $model->crearDocsReactMat();
                }
                return $this->redirect(['index']);
                //return ['success' => yii::t('base_labels', 'Archivos generados con éxito.')];
            }
        }
    }

    /**
     * Deletes an existing Matriculareact model.
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
     * Finds the Matriculareact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Matriculareact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Matriculareact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base_labels', 'The requested page does not exist.'));
    }
}
