<?php
namespace common\models;
use common\models\masters\Transacciones;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class TransaccionForm extends Model
{
    public $transaccion;
    //public $password;
   // public $rememberMe = true;
    //private $_user;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['transaccion'], 'required'],
            // rememberMe must be a boolean value
           // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['transaccion', 'validateTransaccion'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateTransaccion($attribute, $params)
    {
        if (!$this->hasErrors()) {            
            if(!Transacciones::find()->andWhere(['transaccion'=>$this->transaccion])->exists())
                $this->addError($attribute, 'Incorrect username or password.');
            
        }
    }

   
}
