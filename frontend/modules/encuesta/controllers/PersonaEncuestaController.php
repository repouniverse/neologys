<?php

namespace frontend\modules\encuesta\controllers;

use Codeception\Lib\Di;
use frontend\modules\encuesta\models\EncuestaEncuestaGeneral;
use Yii;
use frontend\modules\encuesta\models\EncuestaPersonaEncuesta;
use frontend\modules\encuesta\models\EncuestaOpcionesPregunta;
use frontend\modules\encuesta\models\EncuestaPersonaEncuestaSearch;
use frontend\modules\encuesta\models\EncuestaEncuestaGeneralSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use \common\models\base\modelBase;
use common\helpers\h;
use common\models\User;
use common\models\masters\GrupoPersonas;
use frontend\modules\encuesta\models\EncuestaPreguntaEncuesta;
use common\models\masters\Trabajadores;
use \yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

/**
 * PersonaEncuestaController implements the CRUD actions for EncuestaPersonaEncuesta model.
 */
class PersonaEncuestaController extends Controller
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
     * Lists all EncuestaPersonaEncuesta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EncuestaEncuestaGeneralSearch();

        if (!is_null(($persona = h::user()->profile->persona))) {
            if (!is_null($grupo = GrupoPersonas::findOne($persona->codgrupo))) {
                //var_dump(  $grupo->codgrupo);die();

                if ($grupo->codgrupo == '100' && !is_null($trabjador = Trabajadores::findOne(['persona_id' => $persona->id]))) {
                    //id_dep_encargado
                    $searchModel->id_dep_encargado = $trabjador->depa_id;
                }
                else {
                    $searchModel->id_tipo_usuario = $grupo->codgrupo;
                    $searchModel->id_persona = h::user()->profile->persona->id;
                    
                }
            }
        }

        //var_dump(h::user()->profile->persona->id);die();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(!is_null($grupo->codgrupo) && $grupo->codgrupo == '200')
        $dataProvider = $this->getEncuestasAlumno();
        

        //var_dump($models); die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single EncuestaPersonaEncuesta model.
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
     * Creates a new EncuestaPersonaEncuesta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EncuestaPersonaEncuesta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EncuestaPersonaEncuesta model.
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

    public function actionEncuesta($id)
    {
        //$model = $this->findModel($id);
        $is_encuestador = false;

        if (!is_null(($persona = h::user()->profile->persona))) {
            if (!is_null($grupo = GrupoPersonas::findOne($persona->codgrupo))) {
                //var_dump(  $grupo->codgrupo);die();
                if ($grupo->codgrupo == '100' && !is_null($trabjador = Trabajadores::findOne(['persona_id' => $persona->id]))) {
                    $is_encuestador = true;
                }
            }
        }


        $encuestado_encuesta = EncuestaPersonaEncuesta::findOne(['id_encuesta' => $id, 'id_persona' => h::user()->profile->persona->id]);
        if (!is_null($encuestado_encuesta)) {
            return $this->render('layout', [
                'mensaje' => $mensaje = "USTED YA DESARROLLÓ ESTA ENCUESTA."
            ]);
        }
        $encuesta = EncuestaEncuestaGeneral::findOne(['id' => $id]);
        $listaPreguntas = EncuestaPreguntaEncuesta::findAll(['id_encuesta' => $encuesta->id]);
        if (sizeof($listaPreguntas) == 0) {
            return $this->render('layout', [
                'mensaje' => $mensaje = "ESTA ENCUESTA SE ENCUESTRA EN DESARROLLO."
            ]);
        }
        $model = new EncuestaPersonaEncuesta();

        $model->setAttributes([
            'id_encuesta' => $id,
            'id_persona' =>  h::user()->profile->persona->id,
            'fecha' => modelBase::CarbonNow()->format(\common\helpers\timeHelper::formatMysqlDateTime()),
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {

            return $this->redirect(['index']);
        } else {


            return $this->render('encuesta', [
                'encuesta' => $encuesta,
                'listaPreguntas' => $listaPreguntas,
                'model' =>  $model,
                'is_encuestador' =>  $is_encuestador
            ]);
        }
    }

    /**
     * Deletes an existing EncuestaPersonaEncuesta model.
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
     * Finds the EncuestaPersonaEncuesta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EncuestaPersonaEncuesta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EncuestaPersonaEncuesta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    private function getEncuestasAlumno(){
        $count = Yii::$app->db->createCommand('
        SELECT count(*) FROM encuesta_encuesta_general as ee WHERE  ee.codescuesla IN (
            SELECT DISTINCT  s.nomplan  FROM alumnos a inner join personas p
            ON a.persona_id = p.id
            INNER JOIN sap_matcursec s
            ON a.codalu = s.nummat 
            WHERE p.id = :id
            ) AND 
            
            ee.codciclo IN (
            SELECT DISTINCT SUBSTRING( s.seccur , LOCATE(">",s.seccur) + 1 , 2)  FROM alumnos a inner join personas p
            ON a.persona_id = p.id
            INNER JOIN sap_matcursec s
            ON a.codalu = s.nummat 
            WHERE p.id = :id
            )
            AND ee.id NOT IN (
                SELECT id_encuesta FROM encuesta_persona_encuesta WHERE id_persona = :id
               );
        ')->bindValue(':id', h::user()->profile->persona->id)->queryScalar();


        $provider = new SqlDataProvider([
            'sql' => 'SELECT * from encuesta_encuesta_general ee WHERE  ee.codescuesla IN (
                SELECT DISTINCT  s.nomplan  FROM alumnos a inner join personas p
                ON a.persona_id = p.id
                INNER JOIN sap_matcursec s
                ON a.codalu = s.nummat 
                WHERE p.id = :id
                ) AND 
                
                ee.codciclo IN (
                SELECT DISTINCT SUBSTRING( s.seccur , LOCATE(">",s.seccur) + 1 , 2)  FROM alumnos a inner join personas p
                ON a.persona_id = p.id
                INNER JOIN sap_matcursec s
                ON a.codalu = s.nummat 
                WHERE p.id = :id
                )AND ee.id NOT IN (
                SELECT id_encuesta FROM encuesta_persona_encuesta WHERE id_persona = :id
                );',
            'params' => [':id' => h::user()->profile->persona->id],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'title',
                    'view_count',
                    'created_at',
                ],
            ],
        ]);

        return $provider;
    }
}
