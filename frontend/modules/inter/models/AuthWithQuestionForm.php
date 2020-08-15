<?php
namespace frontend\modules\inter\models;
  use Yii;
use yii\base\Model;
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
             ['email', 'string', 'max' => 100],
            
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
            'modo_id' => Yii::t('base_labels', 'Mode'),
            'pregunta1' => Yii::t('base_labels', 'Codper'),
             'pregunta2' => Yii::t('base_labels', 'Codper'),
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
            $this->_modelPostulante=null;
        }else{
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
          if(!($preguntas['email']==$this->email)){
            $this->addError('email',yii::t('base_labels','Email doesn \'t  match'));
          
          }
      }else{
         $this->addError('codigo',yii::t('base_labels','Code doesn \'t  match'));
        }
  }
  
  
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

