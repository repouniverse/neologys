<?php

namespace common\models\masters;
use common\interfaces\identidadesInterface;
use frontend\modules\inter\models\InterModos;
USE common\traits\nameTrait;
use common\helpers\h;
USE common\traits\identidadTrait;

use Yii;

/**
 * This is the model class for table "{{%docentes}}".
 *
 * @property int $id
 * @property int|null $facultad_id
 * @property int|null $universidad_id
 * @property int|null $persona_id
 * @property string $codoce
 * @property string|null $codoce1
 * @property string|null $codoce2
 * @property string|null $codigoper
 * @property string|null $ap
 * @property string|null $am
 * @property string|null $nombres
 * @property string $codpering
 * @property string $codfac
 * @property string|null $numerodoc
 * @property string|null $tipodoc
 * @property string|null $categoria
 * @property string|null $dispo
 *
 * @property Facultades $facultad
 * @property Personas $codigoper0
 * @property Universidades $universidad
 */
class Docentes extends \common\models\base\modelBase 
implements \common\interfaces\postulantesInterface 
{
    use nameTrait;
    use identidadTrait;
    
    const SCE_CREACION_BASICA='base';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%docentes}}';
    }
public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => \nemmo\attachments\behaviors\FileBehavior::className()
		],
             'auditoriaBehavior' => [
			'class' => '\common\behaviors\AuditBehavior' ,
                               ],
		
	];
}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['facultad_id', 'universidad_id', 'persona_id'], 'integer'],
            [['codoce'], 'required'],
            
              [['correo'], 'safe'],
            
             [['mail'], 'unique'],
            [['codoce'], 'unique'],
            
             /* PARA ESCENARIOBASICO*/
            [[
            'codoce','ap','nombres',
            'universidad_id', 'facultad_id','tipodoc','numerodoc'
            ],'required','on'=>self::SCE_CREACION_BASICA
            ],
            
            
            [['correo'],'unique'],
            ["correo", "unique", "targetClass" => Alumnos::className(), "targetAttribute" => "mail"],
            ["correo", "unique", "targetClass" => \common\models\User::className(), "targetAttribute" => "email"],
            [['tipodoc','numerodoc'], 'unique','targetAttribute'=>['tipodoc','numerodoc']],
            [['tipodoc','numerodoc'], "validateDocumento"],
          
            [['codoce', 'codoce1', 'codoce2'], 'string', 'max' => 16],
            [['codigoper'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['codpering', 'codfac'], 'string', 'max' => 10],
            [['numerodoc'], 'string', 'max' => 20],
            [['tipodoc', 'categoria', 'dispo'], 'string', 'max' => 2],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['codigoper'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['codigoper' => 'codigoper']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'facultad_id' => Yii::t('base_labels', 'Faculty'),
            'universidad_id' => Yii::t('base_labels', 'University'),
            'persona_id' => Yii::t('base_labels', 'Person'),
            'codoce' => Yii::t('base_labels', 'Code Teacher'),
            'codoce1' => Yii::t('base_labels', 'Code Teacher 1'),
            'codoce2' => Yii::t('base_labels', 'Code Teacher 2'),
            'codigoper' => Yii::t('base_labels', 'Personal Code'),
            'ap' => Yii::t('base_labels', 'Last Name'),
            'am' => Yii::t('base_labels', 'Mother Last Name'),
            'nombres' => Yii::t('base_labels', 'Names'),
            'codpering' => Yii::t('base_labels', 'Entry Period Code'),
            'codfac' => Yii::t('base_labels', 'Code Faculty'),
            'numerodoc' => Yii::t('base_labels', 'Document Number'),
            'tipodoc' => Yii::t('base_labels', 'Document Type'),
            'categoria' => Yii::t('base_labels', 'Category'),
            'dispo' => Yii::t('base_labels', 'Available'),
        ];
    }

    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_CREACION_BASICA] = [
           'codoce', 'ap','am','nombres','tipodoc','numerodoc',
            'universidad_id', 'facultad_id','correo'
            ];
        /*$scenarios[self::SCENARIO_ASISTIO] = ['asistio'];
        $scenarios[self::SCENARIO_PSICO] = ['codtra'];
        $scenarios[self::SCENARIO_ACTIVO] = ['activo'];
        $scenarios[self::SCENARIO_REPROGRAMA] = ['fechaprog', 'duracion', 'finicio', 'ftermino', 'codtra'];
        */return $scenarios;
    }
    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * Gets query for [[Codigoper0]].
     *
     * @return \yii\db\ActiveQuery|PersonasQuery
     */
    

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    public function getTipodocumento(){
         return (Combovalores::getValue('personas.tipodoc', $this->tipodoc ));
      } 
      
    /**
     * {@inheritdoc}
     * @return DocentesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocentesQuery(get_called_class());
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        if($insert)
        {
            $this->refresh();
            $this->createPersonFromThis();
        }
        return parent::afterSave($insert, $changedAttributes);
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
       $attributesModo['docente_id']=$this->id;
       return $attributesModo;
   }
   
   /*
    * Devuelve un activeQuery con nc roteior especifico
    */
   public function providerPersonsToConvocar(InterModos $modo) {
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
             'codigo'=>$this->codoce,
             'questions'=>[
                 'pregunta1'=>[yii::t('base_labels','Document Identity')=>$this->numerodoc],
                 'pregunta2'=>[yii::t('base_labels','Last Name')=>$this->ap],
         
              ]
          ];
  }   
  
  
  public function modelByCode($code) {
      return static::find()->andWhere(['codoce'=>$code])->one();
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
     if(!$this->isExternal()) //Si es un docente de la misma universidad no tiene sentido crear usuari
      return false;
     $rol=null;
    if(yii::$app->hasModule('inter'))
        $rol=\frontend\modules\inter\Module::ROL_POSTULANTE;
      $user=$this->persona->createUser($this->codoce,$this->mail,$role);
      if(!is_null($user)){
        $this->hasuser=true; $this->save(); 
      }
    return $user;
     
  }
    
  public function isExternal(){
    return !(h::currentUniversity()==$this->universidad_id);
 } 
 
 public function validateDocumento($attribute,$params){
     if(Personas::find()->andWhere(
             ['tipodoc'=>$this->tipodoc,'numerodoc'=>$this->numerodoc])
             ->exists())$this->addError ('numerodoc',yii::t('base_labels','Document has been registered'));
 }
 public function code(){
     return $this->codigoper;
 }
}
