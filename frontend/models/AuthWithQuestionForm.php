<?php
namespace frontend\models;
use common\models\masters\Alumnos;
use Yii;
use yii\base\Model;
use common\models\User;

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
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
    
   public function validateRespuesta1($attribute, $params)
    {
       
    }  
   
    public function validateRespuesta2($attribute, $params)
    {
       
    }  
    
    public function validateRespuesta3($attribute, $params)
    {
       
    }  
    
    
    
    
    
    
}
