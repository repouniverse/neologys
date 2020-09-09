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
      $sesion->setFlash('success',yii::t('base_labels','University was selected'));
         $this->redirect(Url::toRoute([Yii::$app->user->resolveUrlAfterLogin()]));
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
            return ['error',yii::t('base_labels','There were problems')];
        }else{
            return ['success',yii::t('base_labels','User was created')];
        }
      
    }
   
    
      
  }
    
}
