<?php

namespace common\models\masters;
use common\interfaces\identidadesInterface;
use frontend\modules\inter\models\InterConvocados;
USE common\traits\nameTrait;
use common\helpers\h;
USE common\traits\identidadTrait;
use common\models\masters\Combovalores;
use frontend\modules\inter\models\InterModos;
use common\models\masters\Universidades;
use yii\web\BadRequestHttpException;
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
    const SCE_EXTRANJERO='extranjero';
    const SCE_LOCAL='local';
    /**
     * {@inheritdoc}
     */
    public $hardFields=['ap','am','nombres','tipodoc','numerodoc'];
    public $codpais=null;
    public $booleanFields=['hasuser'];
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
            [['codalu', 'ap','nombres','tipodoc','numerodoc','mail','universidad_id', 'facultad_id','carrera_id'], 'required'],
             [['mail','universidad_id', 'facultad_id','carrera_id','hasuser' ], 'safe'],
           [['codalu'], 'validateAccess'],//Verifica si un usuario puede editar o no el registro segun la universidad  
             [['codalu'], 'unique'],
              [['numerodoc'], 'validateDuplicado'],
            /* PARA ESCENARIOBASICO*/
            [[
            'codalu','mail', 'ap','am','nombres','tipodoc','numerodoc',
            'universidad_id', 'facultad_id','carrera_id',
            ],'required','on'=>self::SCE_CREACION_BASICA
            ],
            [['mail'],'unique'],
            ["mail", "unique", "targetClass" => Alumnos::className(), "targetAttribute" => "mail"],
            ["mail", "unique", "targetClass" => \common\models\User::className(), "targetAttribute" => "email"],
             [['tipodoc','numerodoc'], 'unique','targetAttribute'=>['tipodoc','numerodoc']],
          // [['tipodoc','numerodoc'], "targetClass" => \common\models\masters\Personas::className(),"targetAttribute" => ['tipodoc','numerodoc']],
            //[['tipodoc','numerodoc'], "validateDocumento"],
            
            
            
            [[
           'codalu', 'ap','nombres','tipodoc','numerodoc',
            'universidad_id', 'facultad_id','carrera_id','mail',
            /*'telpaisorigen',
            'codcontpaisorigen','polizaseguroint','telefasistencia',
            'paisresidencia','lugarresidencia',
            'codresponsable',
                'domiciliopaisorigen',*/'unidest_id','facudest_id','carreradest_id',
            ],'required','on'=>self::SCE_EXTRANJERO],
            
             [['unidest_id','facudest_id','carreradest_id'],'safe'],
            
            
            
            /*****/
            [['codalu', 'codalu1', 'codalu2'], 'string', 'max' => 16],
            [[ 'codesp'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['codpering', 'codfac'], 'string', 'max' => 20],
             [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
             [['carrera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['carrera_id' => 'id']],
            
            /*
             * escenario extranjero 
             */
             [['unidest_id','facudestd_id','carreradest_id'], 'required','on'=>self::SCE_EXTRANJERO],
            [['universidad_id','facultad_id','carrera_id'], 'validateExt','on'=>self::SCE_EXTRANJERO],
            [['unidest_id','facudest_id','carreradest_id'], 'validateExt','on'=>self::SCE_EXTRANJERO],
            [['unidest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['unidest_id' => 'id'] ,'on'=>self::SCE_EXTRANJERO],
             [['facudest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facudest_id' => 'id'],'on'=>self::SCE_EXTRANJERO],
             [['carreradest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['carreradest_id' => 'id'],'on'=>self::SCE_EXTRANJERO],
        ];
    }
  public function behaviors() {
        return [
            
            'auditoriaBehavior' => [
                'class' => '\common\behaviors\AuditBehavior',
            ],
        ];
  }    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_CREACION_BASICA] = [
           'codalu', 'ap','am','nombres','tipodoc','numerodoc',
            'universidad_id', 'facultad_id','carrera_id','mail'
            ];
        
        $scenarios[self::SCE_EXTRANJERO] = [
           'codalu', 'ap','am','nombres','tipodoc','numerodoc',
            'universidad_id', 'facultad_id','carrera_id','mail',
            'unidest_id','facudest_id','carreradest_id'
            /*'lugarnacimiento','telpaisorigen',
            'codcontpaisorigen','polizaseguroint','telefasistencia',
            'paisresidencia','lugarresidencia','codcontpaisresidencia',
            'parentcontpaisresid','codresponsable',
                'domiciliopaisorigen',*/
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
            'universidad_id' => Yii::t('base_labels', 'University'),
            'mail' => Yii::t('base_labels', 'Mail'),
            'facultad_id' => Yii::t('base_labels', 'Faculty'),
            'carrera_id' => Yii::t('base_labels', 'Race'),
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
        }else{
           $this->sincronizeFields(); //Con la tabla Personas 
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
   public function providerPersonsToConvocar(InterModos $modelModo) {
       /*Aqui debe de aparecerun filtro de validacion
        * estos filtro debe de sacare de una tabla
        * que mas adelante denemos de crear sefun lso datos que entregue Crispin de SAP*/
        //por ahora sacar todos los registros 
       //$universidad_programa=
       
       return static::find()->andWhere(
                [
                   '<>','universidad_id',1
                ]);  
      /* $id_universidad_modo=$modelModo->programa->universidad_id;
       if(h::currentUniversity()==$id_universidad_modo){
           var_dump(static::find()->andWhere(
                [
                    'universidad_id'=>
                    $id_universidad_modo
                ])->createCommand()->rawSql);die();
          return static::find()->andWhere(
                [
                    'universidad_id'=>
                    $id_universidad_modo
                ]);   
       }else{
           var_dump(static::find()->andWhere(
                [
                   '<>','universidad_id',$id_universidad_modo
                ])->createCommand()->rawSql);die();
           return static::find()->andWhere(
                [
                   '<>','universidad_id',$id_universidad_modo
                ]);  
       }*/
            
       
       
       
       /*if($modelModo->programa->universidad_id==$this->universidad_id){
          return static::find()->limit(30);
         return static::find()/*->andWhere([])*//*; 
       }else{//en caso de ser modo incomingo pasarlo de frente porque ay están selecionados 
           return static::find()->andWhere(['<>','universidad_id',$modelModo->programa->universidad_id]);
       }*/
       
   }
   
   public function getConvocatorias()
    {
        return $this->hasMany(InterConvocados::className(), ['alumno_id' => 'id']);
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
  
  /*
   * ESTA FUNCIO NSOLO SE USA PARA 
   * SINCERAR EL CORREO DEL ALUMNO 
   * DESACTIOVAR EL BEHAVIOR AUDITORIA 
   */
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
  
  /*
   * crea un usuario desde un Alumno
   */
  public function createUser(){
     if(!$this->isExternal()) //Si es un alumno de la misma universidad no tiene sentido crear usuari
      return false;
     $rol=null;
    if(yii::$app->hasModule('inter'))
        $rol=\frontend\modules\inter\Module::ROL_POSTULANTE;
      $user=$this->persona->createUser($this->codalu,$this->mail,$role);
      if(!is_null($user)){
        $this->hasuser=true; $this->save(); 
      }
    return $user;
     
  }
  
  public function currentConvocatoria(){
      //echo $this->getConvocatorias()->andWhere(['codperiodo'=>h::periodos()->currentPeriod])->createCommand()->rawSql;die();
     return  $this->getConvocatorias()->andWhere(['codperiodo'=>h::periodos()->currentPeriod])->one();
  }
  
  
  /*
   * Verifica que el alumno es de otra universisas
   * diferente a la universidad actual
   */
 public function isExternal(){
    // var_dump(h::currentUniversity(),$this->universidad_id);die();
    //return in_array($this->universidad_id, \common\helpers\ComboHelper::getcboIdsUniversidadesInThisCountry());     
    return !(h::currentUniversity()==$this->universidad_id);
 } 
  
 public static function currentPais()
 {
    return 'PE';
//$codpais=h::currentUniversity(true)->codpais;
    //return $codpais;
 } 
 
 public static function studentPais($univer_id)
 {
    $codpais=Universidades::findOne($univer_id)->codpais;
    return $codpais;
 } 
 
  public function validateDocumento($attribute, $params) {
     if(Personas::find()->andWhere(
             ['tipodoc'=>$this->tipodoc,'numerodoc'=>$this->numerodoc])
             ->exists())$this->addError ('numerodoc',yii::t('base_success','Document has been registered'));
 }
 
 public function code(){
     return $this->codalu;
 }
 public function nameFieldCode(){
     return 'codalu';
 }
 /*
  * Se regidtra como convadao directamente
  */
 public function registerConvocado($idModo=null) {
    
    /*Buscamos el programa actual*/
    if(is_null($idModo)){
     $modelModo=$this->resolveModo(true); 
     if(is_null($modelModo))return null;
    }else{
      $modelModo=InterModos::findOne($idModo);   
    }
     
     
  
    $external=$this->isExternal();
  
   if(!is_null($modelModo) && $this instanceof $modelModo->modelofuente && 
           $this->esConvocable()){
       $model=new \frontend\modules\inter\models\InterConvocados();
          $model->setScenario($model::SCENARIO_CONVOCATORIAMINIMA);
           $model->setAttributes(
                   [
                       'universidad_id'=>($external)?$this->unidest_id:$this->universidad_id,
                       'facultad_id'=>($external)?$this->facudest_id:$this->facultad_id,
                       'depa_id'=>$modelModo->depa_id,
                       'modo_id'=>$modelModo->id,
                       'persona_id'=>$this->persona->id,
                       //'docente_id'=>$postulante->id,
                       'programa_id'=>$modelModo->programa_id,
                       'codperiodo'=>$modelModo->programa->codperiodo,
                       'codocu'=>$model::CODIGO_DOCUMENTO,
                       
                       
                    ]);
           $attr=$this->pushAttributeInterModo(
                   $model->attributes);
           //var_dump($model->attributes['docente_id']);die();
          // var_dump($attr);die();
           
          return  $model->firstOrCreate($attr,
                   $model::SCENARIO_CONVOCATORIAMINIMA);
   }
   
   
 }
 
 /*Funcion para validar el alumno extranejero*/
 
 public function validateExt($attribute, $params) {
   $current_universidad=h::currentUniversity().'';
  //VAR_DUMP($current_universidad,$this->unidest_id,$this->universidad_id);
   /*Si la universidad destino no  es la misma que el usuario que 
    * la crea error no permitir     */
   /*if($current_universidad<>$this->unidest_id){
     $this->addError ('unidest_id',yii::t('base_errors','This university doesn\'t match'));
     
   }*/
    /*Si la universidad origen es la misma que el usuario que 
    * la crea el alumno no es extrno
    */
   /*if($current_universidad==$this->universidad_id){
     $this->addError ('universidad_id',yii::t('base_errors','This university doesn\'t match'));
     
   }*/
   
   if($this->universidad_id==$this->unidest_id){
     $this->addError ('universidad_id',yii::t('base_errors','Universities must be different'));
     
   }
   
   
   
   
 }
 
 /*
  * Devuelve el modo , busca a que modo pertenece
  */
 public function resolveModo($isModel=false){
    $programa= \frontend\modules\inter\Module::currentPrograma(true);
    
    if(is_null($programa))
    throw new BadRequestHttpException(yii::t('base_errors','Program not found , SQL Sentence was {sql}',['sql'=>$query->createCommand()->rawSql]));  
    $query=$programa->getModo()->andWhere([
        'modelofuente'=>'\\'.self::className(),
        'externalpeople'=>($this->isExternal())?'1':'0'
    ]);
    
    //echo $query->createCommand()->rawSql;die();
    $modo=$query->one();
    if(is_null($modo))
      return null;
    //throw new BadRequestHttpException(yii::t('base_errors','Mode not found , SQL Sentence was {sql}',['sql'=>$query->createCommand()->rawSql]));  
    if($isModel){
        return $modo;
    }else{
        return $modo->id;
    }
    
 }
 
 public function isConvocado() {
   return  \frontend\modules\inter\models\InterConvocados::find()
     ->andWhere(['alumno_id'=>$this->id])->exists();
}
 
public function campoCarrera() {
   RETURN ($this->isExternal())?'carreradest_id':'carrera_id';
}

public function mailAddress() {
    RETURN $this->mail;
}

public function campoLink(){
    return 'alumno_id';}

public function canCreateOrEdit() {
    IF(!empty($this->universidad_id))
    return h::user()->hasAccessInThisUniversity($this->universidad_id);
    return true;
}
  
  
 public function validateAccess($attribute, $params) {
   return true;
 }   
    
}
