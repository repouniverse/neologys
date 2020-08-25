<?php

namespace common\models\masters;
use common\interfaces\identidadesInterface;

USE common\traits\nameTrait;
USE common\traits\identidadTrait;
use common\models\masters\Combovalores;
use Yii;

/**
 * POR FAOVR REVISE LAS FUNCIONES DE LOS TRAITS
 *
 * 
 * @property string|null $codesp
 */
class Alumnos extends \common\models\base\modelBase 
implements \common\interfaces\postulantesInterface 
{
    use nameTrait;
    use identidadTrait;
    
    /*
     * porpeidades privadas
     * 
     */
    
    
    /*
     * CAMpO PARA IDENTIFICAR
     * EL TIPO DE IDENTIFICACION
     */

    const SCE_CREACION_BASICA='base';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%alumnos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codalu', 'ap','am','nombres','tipodoc','numerodoc'], 'required'],
             [['mail','universidad_id', 'facultad_id','carrera_id' ], 'safe'],
            /* PARA ESCENARIOBASICO*/
            [[
            'codalu','mail', 'ap','am','nombres','tipodoc','numerodoc',
            'universidad_id', 'facultad_id','carrera_id',
            ],'required','on'=>self::SCE_CREACION_BASICA
            ],
            
            /*****/
            [['codalu', 'codalu1', 'codalu2'], 'string', 'max' => 16],
            [[ 'codesp'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['codpering', 'codfac'], 'string', 'max' => 10],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_CREACION_BASICA] = [
           'codalu', 'ap','am','nombres','tipodoc','numerodoc',
            'universidad_id', 'facultad_id','carrera_id','mail'
            ];
        /*$scenarios[self::SCENARIO_ASISTIO] = ['asistio'];
        $scenarios[self::SCENARIO_PSICO] = ['codtra'];
        $scenarios[self::SCENARIO_ACTIVO] = ['activo'];
        $scenarios[self::SCENARIO_REPROGRAMA] = ['fechaprog', 'duracion', 'finicio', 'ftermino', 'codtra'];
        */return $scenarios;
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'Id'),
            'codalu' => Yii::t('base_labels', 'Code Student'),
            'codalu1' => Yii::t('base_labels', 'Code Student 1'),
            'codalu2' => Yii::t('base_labels', 'Code Student 2'),
            //'codper' => Yii::t('base_labels', 'Codper'),
            'ap' => Yii::t('base_labels', 'Last Name'),
            'am' => Yii::t('base_labels', 'Mother Last Name'),
            'nombres' => Yii::t('base_labels', 'Names'),
            'codpering' => Yii::t('base_labels', 'Entry Period Code'),
            'codfac' => Yii::t('base_labels', 'Code Faculty'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'tipodoc' => Yii::t('base_labels', 'Document Type'),
            'numerodoc' => Yii::t('base_labels', 'Document Number'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AlumnosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AlumnosQuery(get_called_class());
    }
    
    
   public function afterSave($insert, $changedAttributes) {
        if($insert){
            $this->refresh();
            $this->createPersonFromThis();
        }
        return parent::afterSave($insert, $changedAttributes);
    } 
    
    public function getUniversidad(){
         return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
      }
    public function getFacultad(){
         return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
      }
    public function getCarrera(){
         return $this->hasOne(Carreras::className(), ['id' => 'carrera_id']);
      }
  
     public function getTipodocumento(){
         return (Combovalores::getValue('personas.tipodoc', $this->tipodoc ));
      } 
      
    /*
     * funcion q ue me permite 
     * saber si ese alumno cumple con los requisitos 
     * para postular al aproerma de internacionala
     */
   public function esConvocable(){
      
       return true;
       
   }
   
  
   public function pushAttributeInterModo($attributesModo) {
       $attributesModo['alumno_id']=$this->id;
       return $attributesModo;
   }
   
   /*
    * Devuelve un activeQuery con nc roteior especifico
    */
   public function providerPersonsToConvocar() {
       /*Aqui debe de aparecerun filtro de validacion
        * estos filtro debe de sacare de una tabla
        * que mas adelante denemos de crear sefun lso datos que entregue Crispin de SAP*/
        //por ahora sacar todos los registros 
       return static::find()->limit(30);
       return static::find()/*->andWhere([])*/;
   }
   
      
      /*
       
       * Reporta un array de elementos ActiveQuery 
       * auteunticar 
       * [preguna (string) => respuesta(ActiveQuery||mixed)]
       */
  public function questionsForAutenticate() {
      return [
             'codigo'=>$this->codalu,
             'email'=>$this->mail,
             'questions'=>[
                 'pregunta1'=>[yii::t('base_labels','Document Identity')=>$this->numerodoc],
                 'pregunta2'=>[yii::t('base_labels','Last Name')=>$this->ap],
         
              ]
          ];
  }   
  
  
  public function modelByCode($code) {
      return static::find()->andWhere(['codalu'=>$code])->one();
  }   
  
  
  public function sinceraCorreo($mail){
      
      if($this->isAttributeSafe('mail')){
          $this->mail=$mail;
      if( $this->save()){
         // ECHO "GRABO"; die();
      }else{
          //print_r($this->getErrors()); die();
      }
      }ELSE{
         // ECHO "MAIL NO STRA "; DIE();
      }
          
      return false;
  }
  
  
  public function createUser(){
      /* $user = new \mdm\admin\models\User();
            $user->username= strtoupper($this->codigo);
             $user->mail=$this->email;   
             $user->password= uniqid(); 
             //$model->retypePassword='123456'; 
               $user->status=\mdm\admin\models\User::STATUS_ACTIVE;
            if (!$user->save()) {
                                return false;
             }*/
  }
  
}
