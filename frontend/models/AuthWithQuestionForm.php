<?php
namespace frontend\models;
use common\models\masters\Alumnos;
use Yii;
use yii\base\Model;
use common\models\User;

use common\interfaces\postulantesInterface;
/**
 * Signup form
 */
class AuthWithQuestionForm extends Model
{
    public $codalu; // Codsigo del alumno 
    public $email;
    public $respuesta1;
    public $respuesta2;
     public $respuesta3;
    public $npreguntasMinimo=3;
    //public $claseFuente='common/models/masters/Alumnos';
    /**
     * {@inheritdoc}
     */
    
    
    
    public function rules()
    {
        return [
            ['codalu', 'trim'],
            ['codalu', 'required'],
            //['codalu', 'exists', 'targetClass' => '\common\models\masters\Alumnos', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['codalu', 'exist', 
                'targetClass' => Alumnos::class,
                'targetAttribute' => ['codalu' => 'codalu']],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['respuesta1', 'validateRespeusta1'],
            ['respuesta2', 'validateRespeusta2'],
            ['respuesta3', 'validateRespeusta3'],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            //['password', 'required'],
           // ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signupQuestion()
    {
        if (!$this->validate()) {
            return null;
        } 
        return true;

    }
    
    

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmailToken()
    {
         //\common\components\token\Token::deleteAll(['name'=>'token_'.$alumno->id]);
        $token=  \common\components\token\Token::create('auten', 'token_'.$id, null, time());
      // $replyTo=$examen->cita->taller->correo;
        $link= Url::to(['/profile/verify-email-token-auth','id'=>$id,'token'=>$token->token],true);
        $mailer = new \common\components\Mailer();
        $message =new \common\components\MessageMail();
            $message->setSubject('Notificacion de Examen')
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
           $message->ResolveMessage();
    try {
        
           $result = $mailer->send($message);
           $mensajes['success']='Se envió el correo, invitando al examen, el Alumno tiene que responder ';
    } catch (\Swift_TransportException $Ste) {      
         $mensajes['error']=$Ste->getMessage();
    }
    return $mensajes;
    
    }
    
    public function validaPreguntas(){
        
    }
    
    
}
