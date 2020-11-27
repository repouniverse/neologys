<?php
namespace frontend\controllers;
    use yii\helpers\Url;
    use yii\web\NotFoundHttpException;
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
           $datos['success']=yii::t('base_success','Session and cache data has been updated');
           
           h::response()->format = \yii\web\Response::FORMAT_JSON;
           return $datos;
        }
    }


public function actionRutas(){
    
   /* \common\models\masters\Personas::findOne(360)->
    createUser(null, null, 'r_alumno_general');
    die();
    */

$array3=[
'816',
'4464',
'4685',
'2423',
'4038',
'602',
'1142',
'1881',
'352',
'4813',
'4143',
'5180',
'2241',
'720',
'3834',
'4149',
'6229',
'1192',
'2450',
'1945',
'3168',
'4798',
'1427',
'3111',
'3046',
'4618',
'2530',
'3733',
'2232',
'586',
'5842',
'2337',
'6262',
'312',
'1227',
'5360',
'5215',
'3523',
'5643',
'965',
'4160',
'4199',
'4775',
'5196',
'5099',
'4008',
'2145',
'2389',
'4145',
'1196',
'1292',
'6144',
'5356',
'6478',
'4269',
'5888',
'4899',
'4223',
'3738',
'4940',
'5435',
'5441',
'4708',
'337',
'2802',
'3266',
'354',
'4683',
'1281',
'3441',
'5177',
'6494',
'1155',
'2360',
'1576',
'3596',
'6183',
'1411',
'2851',
'4147',
'6227',
'2030',
'857',
'1915',
'5628',
'581',
'721',
'2219',
'4214',
'5320',
'3876',
'702',
'3295',
'4599',
'4048',
'2783',
'756',
'4408',
'3710',
'5629',
'4837',
'2169',
'3512',
'4503',
'2194',
'6123',
'5459',
'4568',
'411',
'3510',
'2139',
'4655',
'1662',
'3683',
'2593',
'1396',
'2564',
'1372',
'976',
'921',
'1446',
'4724',
'3086',
'2617',
'4654',
'2010',
'5195',
'3516',
'4883',
'1111',
'626',
'1039',
'4458',
'2220',
'4730',
'6408',
'5120',
'2747',
'4739',
'5363',
'6038',
'5396',
'5800',
'2628',
'2060',
'2847',
'6464',
'2721',
'2090',
'5943',
'1690',
'4768',
'5723',
'2641',
'3763',
'5251',
'3051',
'1585',
'1909',
'1357',
'6358',
'1272',
'6230',
'5495',
'5579',
'3959',
'3255',
'4852',
'475',
'6496',
'2547',
'1177',
'1466',
'5874',
'1570',
'4423',
'5547',
'5728',
'4058',
'2384',
'2528',
'1520',
'931',
'3617',
'5085',
'5340',
'5312',
'1331',
'5774',
'1781',
'2651',
'2776',
'2716',
'6267',
'6480',
'4504',
'2428',
'3137',
'2646',
'6329',
'1467',
'6019',
'3494',
'5061',
'2568',
'3376',
'321',
'1436',
'3650',
'4584',
'5840',
'1182',
'5564',
'2977',
'4518',
'5355',
'5937',
'2403',
'2642',
'5578',
'3211',
'2039',
'5321',
'2496',
'6023',
'3701',
'4839',
'3755',
'4159',
'2864',
'4563',
'3989',
'4359',
'1271',
'6367',
'1930',
'2711',
'2589',
'6148',
'1110',
'6147',
'2215',
'4032',
'4892',
'1071',
'3493',
'4996',
'1730',
'6467',
'1812',
'4673',
'3928',
'3900',
'4733',
'1417',
'4433',
'2601',
'3330',
'4744',
'4553',
'3705',
'2781',
'5415',
'5407',
'1141',
'3334',
'1665',
'6020',
'616',
'3933',
'3250',
'1171',
'3557',
'1485',
'1381',
'812',
'6192',
'4778',
'2525',
'4288',
'5484',
'3101',
'1775',
'4078',
'4718',
'3166',
'5176',
'1630',
'432',
'1152',
'5673',
'3938',
'2950',
'5823',
'3311',
'1575',
'1876',
'4438',
'2245',
'1835',
'1960',
'5370',
'1731',
'2335',
'4498',
'6197',
'1904',
'2831',
'1814',
'4312',
'961',
'1406',
'4779',
'3368',
'2015',
'3161',
'1631',
'2921',
'6263',
'1891',
'4508',
'3978',
'986',
'2449',
'6071',
'317',
'3585',
'5709',
'3899',
'6472',
'1371',
'1173',
'2020',
'5580',
'4715',
'315',
'6368',
'877',
'2329',
'2906',
'1176',
];

foreach($array3 as $clave=>$valor){
  $persona=\common\models\masters\Personas::findOne($valor)->
    createUser(null, null, 'r_alumno_general');  
}
    
die();
  
    
    
    
    $attributes=[
    'universidad_id' => 1,
    'facultad_id' => 1,
    'ruta' => '/intei8r/convoctrados/ajax-register-alu-with-mail',
    'idioma' => 'es_PE',
    'titulo' => 'Ingreso al programa de movilidad',
    'correoremitente' => 'neotegnia@gmail.com',
    'remitente' => 'Departamento Internacional',
    'copiato' => 'hipogea@hotmail.com',
    'activo' => true,
    'parametros' => [
        'nombre',
        'codigo',
        'periodo',
    ],
    'reply' => 'juaner45@hotmail.com',
    'cuerpo' => 'Dear<b>{nomb}',
     ];
    $model= new \common\models\MailingModel(['attributes'=>$attributes]);
    $model->save();
    die();
    
   
    
     $mailer = new \common\components\Mailer();
      $message = new \common\components\MessageMail();  
      /* $message=Yii::$app->mailer->compose('inter/postulacion_alumnos/admision_alumno',
               [
                   'content' => $contenido,
                   'fullName'=>'HERNANDO DE SOTO',
                    'entrevistador'=>'JUAN SOTELO',
                    ]); */
      $contenido='Estimado alumno <br>{{param1}}</br> <br> Te comunicamos que '
              . 'debes presentar tu solicitud a <b>{{param2}}</b>';
        $message->paramTextBody=[
            '{{param1}}'=>'JULIAN RAMIREZ',
            '{{param2}}'=>'JORGE ARAMANDO',
            ];
        $contenido=$message->replaceParams($contenido);
        //$message->ReplaceParams();
        //echo var_dump(get_class_methods($message->getSwiftMessage())); die();
        
        $message->setSubject('Mailing Internacional')
                ->setHtmlBody($contenido)
                ->setFrom([\common\helpers\h::gsetting('mail', 'userservermail') => 'Departamento Internacional'])
               /* ->setTo(['hipogea@hotmail.com','lbarrientosm@gmail.com',
                    'otejada.odm@gmail.com','xcruzd@usmp.pe','ppanduro@usmp.pe','sgarcia@usmp.pe','evilam@usmp.pe']);
               */ ->SetTo('hipogea@hotmail.com');
        
        $message->resolveMessage();
        //var_dump(['A'=>'DD','AB'=>'DSDS'],$message->ParamTextBody);
       // $cadena=str_replace(array_keys($message->ParamTextBody),array_values($message->ParamTextBody),$message->getSwiftMessage()->getBody());
        //echo $cadena;
       // echo $message->getSwiftMessage()->getBody();
        
        try {

            $result = $message->send();
            return true;
            $mensajes['success'] = yii::t('validaciones','The mail was sent, confirming the approval of the file');
        } catch (\Swift_TransportException $Ste) {
            
            $mensajes['error'] = $Ste->getMessage();
        }
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
  
    die();
    
    
    
    
    
   echo "ewew";
       $model=\common\models\masters\Personas::findOne(6546);
       
     var_dump($model->identidad_id,$model->identidad);die();
   die();
    
    $query=\common\models\CarrerasTest::find()->select(['nombre'])->distinct()
            ->orderBy(['nombre'=>SORT_ASC]);
            
    
    
    
    $model= new \common\models\CarrerasTest();
    $model->universidad_id= 1;
    echo $model->universidad->nombre;
    die();
    
    
    
    \yii\helpers\Url::to(['/site/test','param'=>9,'param2'=>3]);
    
    \common\helpers\h::request()->get('parametro',1);
    
    
    
    
    
    echo date('Y-m-d h:i:s'); die();
    $mailer = new \common\components\Mailer();
        $message =new \common\components\MessageMail();
        $message->ParamTextBody=[
            '[NOMBRE]'=>'JULIAN RAMIREZ TENORIO',
            '[EVENTO_PROGRAMADO]'=>'ENTREVISTA',
        ];
            $message->setSubject('Tienes una cita programada')
            ->setFrom([\common\helpers\h::gsetting('mail', 'userservermail')=>'Oficina Tutoría Psicológica UNI'])
            ->setTo(['hipogea@hotmail.com','neotegnia@gmail.com'])
           ->setCc('neotegnia@gmail.com')
           ->setReplyTo('caballitos@gmail.com')      
            ->SetHtmlBody(" <b>Buenas Tardes</b>  <br>"
                    . " [NOMBRE]  La presente es para notificarle que tiene "
                    . "[EVENTO_PROGRAMADO]  una");
          
             
              //echo 'remitente  '.$message->getFrom().'<br>';
              // echo 'copiato  '.$message->getCc().'<br>';
              //echo 'reply '.$message->getReplyTo().'<br>';
         // echo $message->getSwiftMessage()->getBody(); die();
           $message->ResolveMessage();
           return $mailer->sendSafe($message); 
            //echo 'titulo  '.$message->getSubject().'<br>';
           die();
                
            
    
    
    
    
    
    
    
    
    
    
    
    //$model= NEW \common\models\masters\UsersUniversities();
    //$model->setAttributes(['universidad_id'=>7,'user_id'=>56,'activo'=>true]);
    \common\models\masters\UsersUniversities::firstOrCreateStatic(
            ['universidad_id'=>7,'user_id'=>56,'activo'=>true],
            null,
            ['universidad_id'=>7,'user_id'=>56]);
    //$model->save();
    DIE();
    
    \frontend\modules\inter\models\InterPrograma::createMagicPrograma(
            4,
            10,
            '2020II',
            '118');
    die();
    
    
    
    
    
    
    echo \yii\helpers\Url::home().'<br>'; 
    echo \yii\helpers\Url::toRoute([\yii\helpers\Url::home()]).'<br>';
   die();
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
            yii::$app->session->setFlash('success',yii::t('base_success','Data has been recorded'));
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
               return ['success'=>yii::t('base_success','Route: \'{url}\' was added to favorites ',['url'=>$url])];  
           
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
     
     /*Verificando la identidad del usuario*/
      
      /*Si el`profile apunta a la person*/
   if(!is_null(($persona=h::user()->profile->persona))){
     if(!is_null($grupo=GrupoPersonas::findOne($persona->codgrupo))){
         if(!is_null($identidad=$persona->identidad)){             
                // echo $grupo->layout; die();              
                return $this->render($grupo->layout,['identidad'=>$identidad]);
                }else{
               ///Layout para personas sin identidad
                return $this->render('noidentidad',['persona'=>$persona]); 
                }
         
            }else{
                /*Es un usuario sin referencia a un grupo de personas*/
                return $this->goHome();
            }
    }else{
        //echo "ewdsdsds"; die();
        /*Es un usuario sin referencia a persona*/
       return $this->goHome();
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
            yii::t('base_success','The user has been created'));
		
                  $this->redirect('manage-users');
            }
        }
        

        return $this->render('createuser', [
            'model' => $model,
        ]);
    } 
    
      public function actionViewUsers(){
          yii::error('view users');
         $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       yii::error('retornando el rendet',__FUNCTION__);
        return $this->render('users_edit', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionViewProfile($iduser){
        
         $newIdentity=h::user()->identity->findOne($iduser);
      if(is_null($newIdentity))
          throw new BadRequestHttpException(yii::t('base_errors','User not found with id '.$iduser));  
           //echo $newIdentity->id;die();
     // h::user()->switchIdentity($newIdentity);
         
        $profile =$newIdentity->getProfile($iduser);
        
       // if($profile->multiple_universidad)
            //\common\models\masters\UsersUniversities::refreshTableByUser($iduser);
        
        
        $profile->setScenario($profile::SCENARIO_INTERLOCUTOR);
        if(h::request()->isPost){
            $arrpost=h::request()->post();
              //var_dump($arrpost);die();
            $profile->persona_id=$arrpost[$profile->getShortNameClass()]['persona_id'];
              $profile->universidad_id=$arrpost[$profile->getShortNameClass()]['universidad_id'];
             $profile->idioma=$arrpost[$profile->getShortNameClass()]['idioma'];
           
//$profile->codtra=$arrpost[$profile->getShortNameClass()]['codtra'];
            //var_dump(get_class($profile),$profile->validate());die();
            if (h::request()->isAjax) {
                h::response()->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($profile);
             }
           if ($profile->save()) {
               yii::error('el save');
             $user= \common\models\User::findOne($profile->user_id);
             $user->status=$arrpost['User']['status'];
               yii::error('el save de user');
             $user->save();
             if(array_key_exists(UsersUniversities::getShortNameClass(), $arrpost))
             $this->updateUserUniversidades($arrpost[UsersUniversities::getShortNameClass()]);
         
            /* if($profile->multiple_universidad){
                $this->updateUserUniversidades($arrpost[UsersUniversities::getShortNameClass()]);
              yii::error('update universidades');
             }else{
                 yii::error('revoke  universidades');
                 UsersUniversities::revokeAccess($profile->user_id);
             }*/
             yii::error('colcoando el flash');
             yii::$app->session->setFlash('success',yii::t('base_labels','Se grabaron los datos '));
           yii::error('redireccionando');
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
            return $this->render('index');
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

 public function actionAgregaUniversidad($id){
     $this->layout = "install";
        $modelUser =h::user()->identity->findOne($id);
        $model=New \common\models\masters\UsersUniversities();
        $datos=[];
        
        if(is_null(  $model)){
            //Si es error buttonSubmitWidget::OP_TERCERA
            //lanza un NOTY msg de error
            return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_TERCERA,'msg'=>$datos];
        }
        $model->setAttributes([
            'user_id'=>$modelUser->id,
            'activo'=>true,
                         ]);
         if(h::request()->isPost){
            //$model->setScenario(Rangos::SCENARIO_HORAS);
            $model->load(h::request()->post());
             h::response()->format = \yii\web\Response::FORMAT_JSON;
            $datos=\yii\widgets\ActiveForm::validate($model);
            if(count($datos)>0){
               return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_SEGUNDA,'msg'=>$datos];  
            }else{
                $model->save();
                
                  return ['success'=>\common\widgets\buttonsubmitwidget\buttonSubmitWidget::OP_PRIMERA,'id'=>$model->id];
            }
        }else{
            //var_dump($model->attributes);die();
           return $this->renderAjax('_modal_agrega_universidad', [
                        'model' => $model,
                        'id'=>$modelUser->id,
                        //'eval_id'=> $modelEval->id,
                        'gridName'=>h::request()->get('gridName'),
                        'idModal'=>h::request()->get('idModal'),
                        //'cantidadLibres'=>$cantidadLibres,
          
            ]);  
        }
       
  } 

 public function actionResolveTransa(){
     if(h::request()->isPost){         
         $posteador=h::request()->post('TransaccionForm',null);
         
         if(!is_null($posteador) && array_key_exists('transaccion', $posteador)){
             if(!is_null($model=\common\models\masters\Transacciones::find()->andWhere(['transaccion'=>$posteador['transaccion']])->one())){
                 $this->redirect(Url::toRoute([$model->name]));    
             }else{
                  throw new NotFoundHttpException(Yii::t('base_errors', 'The requested page does not exist.'));
                   }                 
         }else{
              throw new NotFoundHttpException(Yii::t('base_errors', 'The requested page does not exist.'));
         }
     }else{
          throw new NotFoundHttpException(Yii::t('base_errors', 'The requested page does not exist.'));
     }
   } 
   
  public function  actionNoPerson(){
      return $this->render('noperson');
  }
  
  public function  actionNoIdentity(){
      return $this->render('noidentidad');
  }
   
   
}
