<?php
namespace frontend\controllers;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
   use common\models\masters\UsersUniversities;
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
use common\models\masters\GrupoPersonas;
use mdm\admin\models\searchs\User as UserSearch;

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
           // return $this->goBack();
            //$current_uni=h::currentUniversity();
            //var_dump($current_uni);die();
            //if(is_null( $current_uni))
            ///return $this->redirect(['general/choose-university']);
           $this->redirect(Url::toRoute([Yii::$app->user->resolveUrlAfterLogin()]));
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
    $modeloConvocado= \common\models\masters\Convocados::findOne(1300);
    //$modelo->convocaPersona($modeloAlumno);
    var_dump($modeloConvocado->postulante->persona->profile->user->username);
    die();
    
    
    
   $model=\common\models\masters\Alumnos::findOne(444);
   $model->registerConvocado(2);
   die();
    
    //var_dUMP(h::user()->identity->profile->persona->identidad);
   var_dump(\common\models\masters\Trabajadores::findOne(6)->persona->profile->user->id);
    die();
   // var_dump(\common\models\masters\Docentes::findOne(2));die();
    $model= \common\models\masters\Personas::findOne(1);
     var_dump($model::className());
    die();
    $uni=h::currentUniversity();
    var_dump($uni);
    die();
    VAR_DUMP(h::currentUniversity());die();
    $convo=\frontend\modules\inter\models\InterConvocados::findOne(1234);
   var_dump($convo->currentStage());
    die();
    
    $rango=\frontend\modules\inter\models\InterHorarios::findOne(1)->range();
    var_dump($rango->initialDate->format('Y-m-d H:i:s'));
    die();
    
    
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
     
   /*
    * FUNCION DE PANEL DE BIENVENIDA 
    */
  public function actionWelcome(){
      //var_dump(yii::$app->viewPath);die();
      //var_dump(h::user()->profile->persona->identidad);die();
   if(!is_null(($persona=h::user()->profile->persona))){
     //if(is_null(($alumno=$persona->alumno))){
         if(!is_null($grupo=GrupoPersonas::findOne($persona->codgrupo))){
             if(!is_null($identidad=$persona->identidad)){
                // echo $grupo->layout; die();
             return $this->render($grupo->layout,['identidad'=>$identidad]);
         }else{
            echo " NO tiene el perfill alumno" ; die();
         }
         
     }else{
         echo " NO especigico el grupo en l atabla personas " ; die(); 
     }
    }else{
        echo " NO tiene el perfil persona  " ; die(); 
    }
  }  
  
  public function actionManageUsers(){
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('users', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }
   /*
     * Esta funcion es simlar a sign-UP
     * solo que la usa el daminsitrador de
     * de la pagina o un usuario con toles para
     * manejar RBAC
     */
       public function actionCreateUser()
    {
      // $this->layout="install";
        $model = new SignupForm();
        //$model->setScenario('createx');
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {   
                 yii::$app->session->
               setFlash('success',
            yii::t('base_verbs','The user has been created'));
		
                  $this->redirect('manage-users');
            }
        }
        

        return $this->render('createuser', [
            'model' => $model,
        ]);
    } 
    
      public function actionViewUsers(){
         $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('users_edit', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionViewProfile($iduser){
        
         $newIdentity=h::user()->identity->findOne($iduser);
      if(is_null($newIdentity))
          throw new BadRequestHttpException(yii::t('base.errors','User not found with id '.$iduser));  
           //echo $newIdentity->id;die();
     // h::user()->switchIdentity($newIdentity);
         
        $profile =$newIdentity->getProfile($iduser);
        
        if($profile->multiple_universidad)
            \common\models\masters\UsersUniversities::refreshTableByUser($iduser);
        
        
        $profile->setScenario($profile::SCENARIO_INTERLOCUTOR);
        if(h::request()->isPost){
            $arrpost=h::request()->post();
              //var_dump($arrpost);die();
            $profile->persona_id=$arrpost[$profile->getShortNameClass()]['persona_id'];
              $profile->universidad_id=$arrpost[$profile->getShortNameClass()]['universidad_id'];
            //$profile->codtra=$arrpost[$profile->getShortNameClass()]['codtra'];
            //var_dump(get_class($profile),$profile->validate());die();
            if (h::request()->isAjax) {
                h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($profile);
             }
           if ($profile->save()) {
             $user= \common\models\User::findOne($profile->user_id);
             $user->status=$arrpost['User']['status'];
             $user->save();
             if($profile->multiple_universidad){
                $this->updateUserUniversidades($arrpost[UsersUniversities::getShortNameClass()]);
             
             }else{
                 UsersUniversities::revokeAccess($profile->user_id);
             }
             yii::$app->session->setFlash('success',yii::t('base_labels','Se grabaron los datos '));
            return $this->redirect(['view-users']);
           }else{
              //var_dump($profile->getErrors());die(); 
           }
            //var_dump(h::request()->post());die();
        }
        //echo $model->id;die();
       // var_dump(UserFacultades::providerFacus($iduser)->getModels());die();
        return $this->render('_formtabs', [
            'profile' => $profile,
            'model'=>$newIdentity,
            'useruniversidades'=> \common\models\masters\UsersUniversities::providerUniversidadesAll($iduser)->getModels(),
        ]);
    }
   
    /*
     * Actualizacion de los valores del aacultades uausuarios 
     */
    private function updateUserUniversidades($arrpostUserFac){
        $ar=array_combine(ArrayHelper::getColumn($arrpostUserFac,'id'),
                ArrayHelper::getColumn($arrpostUserFac,'activo'));
        foreach($ar as $clave=>$valor){
           \Yii::$app->db->createCommand()->
             update(UsersUniversities::tableName(),
             ['activo'=>$valor],['id'=>$clave])->execute();
        }
        
    } 
    
    public function actionUniqueUniversity($id){
      $model= \common\models\Profile::findOne($id);
      if(is_null($model))
          throw new BadRequestHttpException(yii::t('base_errors','Profile not found with id '.$id));  
      if(h::request()->isAjax){
          h::response()->format = \yii\web\Response::FORMAT_JSON;
          $model->multiple_universidad=!$model->multiple_universidad;
          $model->save();
          if(!$model->multiple_universidad){
              UsersUniversities::revokeAccess($model->user_id);
          }
         return ['success'=>yii::t('base_labels','User has changed multiple Universities')];
      } 
          
    }
    
    public function actionWelcomeTrabajador(){
       
      //var_dump(yii::$app->viewPath);die();
      //var_dump(h::user()->profile->persona->identidad);die();
   if(!is_null(($persona=h::user()->profile->persona))){
     //if(is_null(($alumno=$persona->alumno))){
         if(!is_null($grupo=GrupoPersonas::findOne($persona->codgrupo))){
             if(!is_null($identidad=$persona->identidad)){
                // echo $grupo->layout; die();
             return $this->render($grupo->layout,['identidad'=>$identidad]);
         }else{
            echo " NO tiene el perfill alumno" ; die();
         }
         
     }else{
         echo " NO especigico el grupo en l atabla personas " ; die(); 
     }
    }else{
        echo " NO tiene el perfil persona  " ; die(); 
    }
    
  
    }
    
     public function actionWelcomeDocente(){
       
      //var_dump(yii::$app->viewPath);die();
      //var_dump(h::user()->profile->persona->identidad);die();
   if(!is_null(($persona=h::user()->profile->persona))){
     //if(is_null(($alumno=$persona->alumno))){
         if(!is_null($grupo=GrupoPersonas::findOne($persona->codgrupo))){
             if(!is_null($identidad=$persona->identidad)){
                 //echo $grupo->layout; die();
             return $this->render($grupo->layout,['identidad'=>$identidad]);
         }else{
            echo " NO tiene el perfill alumno" ; die();
         }
         
     }else{
         echo " NO especigico el grupo en l atabla personas " ; die(); 
     }
    }else{
        echo " NO tiene el perfil persona  " ; die(); 
    }
    
  
    }
    
  public function actionSetHomeUrl($id){
      if(h::request()->isAjax){
          
         h::response()->format = \yii\web\Response::FORMAT_JSON;
        $registro=  \common\models\Userfavoritos::findOne($id);
        if(is_null($registro)){
            return ['error'=>yii::t('base_errors','No se encontró el registro para este id')];
        }else{
            $registro->setHomeUrl();
            return ['success'=>yii::t('base_errors','The initial page was changed')]; 
        }
      }
  }   
}
