<?php
namespace frontend\controllers;
use common\helpers\h;
use yii\helpers\Url;
use common\controllers\base\baseController;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\masters\Tenores;
use common\models\masters\TenoresSearch;

/**
 * Site controller
 */
class GeneralController extends  baseController
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

 
    
  public function actionChooseUniversity(){
      return $this->render('choose_university');
  }
  public function actionSelectedUniversity($id){
      $model= \common\models\masters\Universidades::findOne($id);
      if(is_null($model))
        throw new BadRequestHttpException(yii::t('base_errors','Record not found'));
      $sesion=h::session();
      if($sesion->has(h::NAME_SESSION_CURRENT_UNIVERSITY))
      $sesion->remove(h::NAME_SESSION_CURRENT_UNIVERSITY);
      $sesion->set(h::NAME_SESSION_CURRENT_UNIVERSITY,$model->id);
      $sesion->setFlash('success',yii::t('base_success','University was selected'));
        $this->redirect(\yii\helpers\Url::home());
      //$this->redirect(Url::toRoute(['/'.Yii::$app->user->resolveUrlAfterLogin()]));
  }
  
  public function actionCreateUserIden($id){
    if(h::request()->isAjax){
        h::response()->format = \yii\web\Response::FORMAT_JSON;
        $grupo=h::request()->get('grupo');
        $modelGrupo=\common\models\masters\GrupoPersonas::findOne($grupo);
         if(is_null($modelGrupo))
           throw new BadRequestHttpException(yii::t('base_errors','Record not found'));
       $modelo=$modelGrupo->modelo;
       $model= $modelo::findOne($id);
      if(is_null($model))
        throw new BadRequestHttpException(yii::t('base_errors','Record not found'));
        if(is_null($model->createUser())){
            return ['error',yii::t('base_errors','There were problems')];
        }else{
            return ['success',yii::t('base_success','User was created')];
        }
      
    }
   
    
      
  }
  
  
   /**
     * Lists all Tenores models.
     * @return mixed
     */
    public function actionIndexTenores()
    {
        $searchModel = new TenoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_tenores', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tenores model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewTenor($id)
    {
        return $this->render('view_tenores', [
            'model' => $this->findModelTenor($id),
        ]);
    }

    /**
     * Creates a new Tenores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateTenor()
    {
        $model = new Tenores();
        
        
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view_tenores', 'id' => $model->id]);
        }

        return $this->render('create_tenores', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tenores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateTenor($id)
    {
        $model = $this->findModelTenor($id);

        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-tenor', 'id' => $model->id]);
        }

        return $this->render('update_tenores', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tenores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteTenor($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index_tenores']);
    }

    /**
     * Finds the Tenores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tenores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelTenor($id)
    {
        if (($model = Tenores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base_errors', 'The requested page does not exist.'));
    }
}
  
    

