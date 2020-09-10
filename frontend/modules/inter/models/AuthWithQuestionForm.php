<?php
namespace frontend\modules\inter\models;
  use Yii;
  use common\helpers\h;
use yii\base\Model;
use yii\helpers\Url;
use common\models\User;
use frontend\modules\inter\Module;
class AuthWithQuestionForm extends Model 

{
  public $codigo;
  public $modo_id;
  public $email;
  public $pregunta1;
  public $pregunta2;
  public $pregunta3;
  private $_modelPostulante=null;
  CONST SCE_AUTH_BASE='base';
  CONST SCE_AUTH_ADITIONAL='adicional';
  public function rules()
    {
        return [
            ['codigo', 'trim'],
            [['codigo','email','modo_id'], 'required','on'=>self::SCE_AUTH_BASE],
            [['codigo','email'], 'validateBasic','on'=>self::SCE_AUTH_BASE],
            
            ['email', 'trim'],
          ['email', 'email'],
             ['modo_id', 'safe'],
             ['email', 'string', 'max' => 100],
             ['email', 'unique', 'targetClass' => '\common\models\User', 'message' =>yii::t('base_labels', 'This email address has already been taken.')],

          [['pregunta1','pregunta2','pregunta3'], 'trim'],
          [['pregunta1','pregunta2'], 'required','on'=>self::SCE_AUTH_ADITIONAL],
          [['pregunta1','pregunta2'], 'validateAnswers','on'=>self::SCE_AUTH_ADITIONAL],
           
           
           
        ];
    }
  
    public function attributeLabels()
    {
        
        
        return [
            //'id' => Yii::t('base_labels', 'ID'),
            'codigo' => Yii::t('base_labels', 'Code'),
            'email' => Yii::t('base_labels', 'Email'),
            'modo_id' => Yii::t('base_labels', 'Modalidad'),
            'pregunta1' => Yii::t('base_labels', 'First question'),
             'pregunta2' => Yii::t('base_labels', 'Second question'),
             'pregunta3' => Yii::t('base_labels', 'Codper'),
        ];
        
    }
    
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_AUTH_BASE] = [
           'codigo','email','modo_id'
            ];
        return $scenarios;
    }
    
    
  public function login(){
      
      if(!is_null($modelPostulante=$this->modelPostulante)){
          $preguntas=$modelPostulante->questionsForAutenticate();
          return ($preguntas['email']==$this->email);
      }else{
        return false;  
      }
  }  
  
  
    
  public function getModelPostulante(){
    if($this->_modelPostulante===null){
        $modo=$this->modo;
        if(is_null($modo)){
            //var_dump($this->modo_id,$modo); die();
            $this->_modelPostulante=null;
        }else{
            //echo "asa"; die();
            $modelo= Yii::createObject($modo->modelofuente);
          $this->_modelPostulante=$modelo->modelByCode($this->codigo);
          unset($modelo);
        }
    }
    return $this->_modelPostulante;
  }
  
  public function getModo(){
        return InterModos::find()->andWhere(['id'=>$this->modo_id])->one();     
  }
  
  public function validateAnswers($attribute, $params){
      $valido=true;
     $modelPostulante=$this->modelPostulante;
     if(!is_null($modelPostulante)){
         $preguntas=$modelPostulante->questionsForAutenticate();
        
        foreach($preguntas['questions'] as $question=>$consulta){
            $queryx=array_values($consulta)[0];
            if( $queryx instanceof \yii\db\ActiveQuery){
                if($this->{$question}==$queryx->scalar()){
                    
                }else{
                   $this->addError($question,yii::t('base_labels','Incorrect Answer')); 
                }
            }else{
                if($this->{$question}==$queryx){
                    
                }else{
                  $this->addError($question,yii::t('base_labels','Incorrect Answer'));   
                }
            }
        }        
     }else{
         $this->addError('codigo',yii::t('base_labels','Code doesn \'t  match'));
     }     
  }
  
  
  public function validateBasic($attribute, $params){
      if(!is_null($modelPostulante=$this->modelPostulante)){
          $preguntas=$modelPostulante->questionsForAutenticate();
          /*if(!($preguntas['email']==$this->email)){
            $this->addError('email',yii::t('base_labels','Email doesn \'t  match'));
          
          }*/
      }else{
         $this->addError('codigo',yii::t('base_labels','Code doesn \'t  match'));
        }
  }
  
  
  public function sendEmailToVerifyMail($codalu) {
      h::settings()->invalidateCache();
       $token=  \common\components\token\Token::create('auten', 'token_'.$codalu, null, time());
      // $replyTo=$examen->cita->taller->correo;
        $link= Url::to(['/inter/default/verify-email-token-auth',
            'id'=> base64_encode($codalu),
            'modo_id'=>base64_encode($this->modo_id),
            'param'=>base64_encode($this->email),
            'token'=>$token->token],
                
                true);
        $mailer = new \common\components\Mailer();
        $message =new  \yii\swiftmailer\Message();
            $message->setSubject('Verificación de correo')
            ->setFrom(['neotegnia@gmail.com'=>'Internacional'])
            ->setTo($this->email)
            ->SetHtmlBody("Buenas Tardes <br>"
                    . "La presente es para verificar tu correo  "
                    . " <br> Presiona el siguiente link "
                    . "para confirmar: <br>"
                    . "    <a  href=\"".$link."\" >Presiona aquí </a>");
           if(!empty($replyTo)){
              $message->setReplyTo($replyTo); 
           }
    try {
        
           $result = $mailer->send($message);
           $mensajes['success']='Se envió un mensaje al correo que indicaste';
    } catch (\Swift_TransportException $Ste) {      
         $mensajes['error']=$Ste->getMessage();
    }
    return $mensajes;
    
    }
    
  
  
  
  
  public function sendEmailToCreateUser(){      
        /* @var $user User */
        $user = User::findOne([
            //'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);         
        if (!is_null($user)) { //Si el usuario ya existe
            //verifia rque si sttus este activo 
        }else{ //Si el usuario no existe hay que crearlo
          $user= $this->modelPostulante->
         persona->createUser($this->codigo,
                 $this->email,
                 \Yii::$app->authManager->getRole(Module::ROL_POSTULANTE)
                 );
          //Asignar el rol 
        
          /*Luego hay que actualizar tamb e record modelpostualnte 
           * 
           */
          $this->modelPostulante->hasuser=true;
          $this->modelPostulante->save();
            /*
             $user = new \mdm\admin\models\User();
            $user->username= strtolower($this->codigo);
             $user->email=$this->email;   
             $user->password= uniqid(); 
             //$model->retypePassword='123456'; 
               $user->status=\mdm\admin\models\User::STATUS_ACTIVE;
            if (!$user->save()) {
                                return false;
             }
             */
            
        }
         if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                        $user->generatePasswordResetToken();
                            if (!$user->save()) {
                                return false;
                            }
                     }
           $user->status=User::STATUS_ACTIVE;
                  if (!$user->save()) {
                                return false;
                            }
       return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html',
                 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([h::gsetting('mail', 'userservermail') => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();  
        
   }
  
  
  
  
}


