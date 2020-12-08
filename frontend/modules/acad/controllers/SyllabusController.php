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
use yii\web\NotFoundHttpException;
//use yii\base\Model;
use yii\filters\VerbFilter;

/**
 * SyllabusController implements the CRUD actions for AcadSyllabus model.
 */
class SyllabusController extends baseController
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
    public function actionCreate()
    {
        $model = new AcadSyllabus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
    
}
