<?php

namespace frontend\modules\maestros\controllers;

use yii\web\Controller;

use Yii;
use common\models\masters\Periodos;
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
}
