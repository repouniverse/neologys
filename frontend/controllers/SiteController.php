<?php
namespace frontend\controllers;
    use yii\helpers\Url;
use frontend\models\AuthWithQuestionForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use common\helpers\h;
use common\controllers\base\baseController;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends  baseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
       return  $this->redirect(['login']);
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        
        if (!Yii::$app->user->isGuest) {
            
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        
        
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
       //$this->layout="install";
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    
  public function actionTestConeccionOra(){
      $db = \Yii::$app->dbOracle;
      try{       
      $db->open();  
   } catch (\yii\db\Exception $exception) {
       echo $exception->getMessage(); 
       return false;
   } finally{
       unset($db);
   }   
  }

/*
 * Esta acccion para auterntica ro cpreguntas 
 */
public function actionAuthWithQuestions(){
    $model = new AuthWithQuestionForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('auth_with_question', [
            'model' => $model,
        ]);
}

 public function actionClearCache(){
       
       $datos=[];
       if(h::request()->isAjax){           
              h::settings()->invalidateCache();
              //if(h::session()->has('psico_por_dia'))
               h::session()->remove('psico_por_dia');
              //\console\components\Command::execute('cache/flush-all', ['interactive' => false]);
              //\console\components\Command::execute('cache/flush-schema', ['interactive' => false]);
           $datos['success']=yii::t('base_verbs','
Datos de sesión y de caché se han actualizado');
           
           h::response()->format = \yii\web\Response::FORMAT_JSON;
           return $datos;
        }
    }


public function actionRutas(){
var_dump(\common\models\masters\GrupoPersonas::mapFiles());
   die();
var_dump(\common\helpers\timeHelper::IsFormatMysqlDate( '2020-08-21?codfac'));
die();

   echo " Url::home()  :   ".Url::home()."<br>";
   echo " Url::home('https')  :   ".Url::home('https')."<br>";
   echo " Url::base()  :   ".Url::base()."<br>";
   echo " Url::to(['controlador/accion','param2'=>'uno','param2'=>'dos'],true)  :   ".Url::to(['controlador/accion','param1'=>'uno','param2'=>'dos'],true)."<br>";
   echo " Url::base(true)  :   ".Url::base(true)."<br>";
   echo " Url::base('https')  :   ".Url::base('https')."<br>";
   echo " Url::canonical()  :   ".Url::canonical()."<br>";
   echo " Url::current()  :   ".Url::current()."<br>";
   echo " Url::previous()  :   ".Url::previous()."<br>";
   echo " UrlManager::getBaseUrl()  :   ".yii::$app->urlManager->getBaseUrl()."<br>";
   echo " UrlManager::getHostInfo()  :   ".yii::$app->urlManager->getHostInfo()."<br>";
   echo " UrlManager::getScriptUrl()  :   ".yii::$app->urlManager->getScriptUrl()."<br>";
  
    
   
    
    
    
    return $this->render('@frontend/views/layouts/perfiles/panel_alumno_internacional'); 
   $dae= \Yii::$app->db->createCommand()->setSql("select *from {{%universidades}}")->queryAll();
    var_dump($dae);die();
    $TABLA='{{%inter_idiomasalu}}';
    $mode=new \console\migrations\baseMigration();
     $mode->putCombo($TABLA, 'codnivel',
            [
                'BASICO',
                'REGULAR'
               // 'GERENTE GENERAL'
                ]);
    die();
    
    //$modelo= \frontend\modules\inter\models\InterModos::findOne(1);
    $modeloAlumno= \common\models\masters\Alumnos::findOne(106);
    //$modelo->convocaPersona($modeloAlumno);
    var_dump($modeloAlumno->persona->profile->user->username);
    die();
    
    
    
     $modelo= \common\models\masters\Personas::findOne(14);
    var_dump($modelo->identidad);die();
    
    
    
    $modelo= \common\models\masters\Personas::findOne(14);
    var_dump($modelo->identidad);die();
    
    
    $modelo= \common\models\masters\Alumnos::findOne(4);
    var_dump($modelo->persona);die();
    
     $session=h::session();
            /*$session['login.codigo'] = 'abds33';
            $session['login.email'] = 'hipore@hotmail.com';*/
    
     //var_dump($session->has('login.codigo'), $session['login.codigo']);die();
            

    
    //$modelo->convocaMasivamente();
    
    die();
    
    echo yii::$app->periodo->currentPeriod;
    die();
    $valorfiltro=14;
    $campoclave='facultad_id';
    $camporef='desfac';
    $campofiltro='universidad_id';
    $clase='\common\models\masters\Facultades';
    $campokey='universidad_id';
    $camporef='desfac';
    $datos=\yii\helpers\ArrayHelper::map(
                        $clase::find()->where([$campofiltro=>$valorfiltro])->all(),
                $campokey,$camporef);
    
    //var_dump($datos);
     $valores=\common\helpers\ComboHelper::getCboGeneral(
               $valorfiltro, 
                 $clase,
                $campofiltro,
                $campokey,
                $camporef);
    var_dump($valores);
    
     $valores2=\common\helpers\ComboHelper::getCboGeneral(
               14, 
                 '\common\models\masters\Facultades',
                'universidad_id',
                'facultad_id',
                'desfac');
       // var_dump($valores);
    
    var_dump($valores2); 
    
    
    $valores3=\yii\helpers\ArrayHelper::map(
                        $clase::find()->where([$campofiltro=>$valorfiltro])->all(),
                $campokey,$camporef);
    var_dump($valores3);die();
    
    
    

    }
    
   public function actionProfile(){
        
       // echo \common\helpers\FileHelper::getUrlImageUserGuest();die();
     /* if(h::app()->hasModule('sta')){
          $this->redirect(\yii\helpers\Url::toRoute('/sta/default/profile'));
      }*/
        $model =Yii::$app->user->getProfile() ;
        
        $identidad=Yii::$app->user->identity;
        $identidad->setScenario($identidad::SCENARIO_MAIL);
       // var_dump($model);die();
        if ($identidad->load(Yii::$app->request->post()) && $identidad->save() &&                
                $model->load(Yii::$app->request->post()) && $model->save()) {
           // var_dump($model->getErrors()   );die();
            yii::$app->session->setFlash('success',yii::t('base_labels','Data has been recorded'));
            return $this->redirect(['profile', 'id' => $model->user_id]);
        }else{
           // var_dump($model->getErrors()   );die();
        }

        return $this->render('profile', [
            'identidad'=>$identidad,
            'model' => $model,
        ]);
    }  
    
   public function actionAjaxAddFavorite(){
         //$this->layout="install";
    if(h::request()->isAjax){
       h::response()->format = \yii\web\Response::FORMAT_JSON;
        $url=Yii::$app->request->referrer;  
        // $datos=[];
        if(!is_null($url)){
            $url=str_replace(\yii\helpers\Url::home(true),'',$url);
           
            $model= new \common\models\Userfavoritos();
            $model->setAttributes([
                            'url'=>$url,
                             'user_id'=>h::userId(),
                                ]);        
            if($model->save()){
               return ['success'=>yii::t('base_labels','Route: \'{url}\' was added to favorites ',['url'=>$url])];  
           
            }else{
              return ['error'=>yii::t('base_labels','Has errors {mierror}',['mierror'=>$model->getFirstError()])];  
            }
        }else{
           return ['error'=>yii::t('base_labels','Without Url')];
        }
    }   
    }
     
    
}
