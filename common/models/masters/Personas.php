<?php

namespace common\models\masters;
use common\models\base\modelBase;

use common\models\Profile;
use common\helpers\h;
use common\helpers\BaseHelper;
//use frontend\modules\inter\Module as m;
use Yii;
use Carbon\Carbon;

/**
 * This is the model class for table "{{%trabajadores}}".
 *
 * @property string $codigotra
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string $dni
 * @property string $ppt
 * @property string $pasaporte
 * @property string $codpuesto
 * @property string $cumple
 * @property string $fecingreso
 * @property string $domicilio
 * @property string $telfijo
 * @property string $telmoviles
 * @property string $referencia
 */
class Personas extends modelBase implements \common\interfaces\PersonInterface
{
   
   public $nombrecompleto;
   public $persona;
    
   CONST SCE_CREACION_BASICA='basico';
   CONST SCE_INTERMEDIO='intermedio';
   CONST SCE_DOCENTES='docentes';
   CONST SCE_ALUMNOS='alumnos';
   CONST SCE_CREACION_MINIMA='minima';
   CONST SCE_CREACION_EXTRANJERO='extranjero';
   CONST SCE_UPDATE_MATRICULA='UPDATE_MATRICULA';
   public $cumple1;
    public $dateorTimeFields = [
        'cumple' => self::_FDATE,
        'cumple1' => self::_FDATE,
        'fecingreso' => self::_FDATE,
        //'ftermino' => self::_FDATETIME
    ];
     
    
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
 
    
     public function init(){
         $this->prefijo='76';
         $this->dateorTimeFields=['fecingreso'=>self::_FDATE,'cumple1'=>self::_FDATE,'cumple'=>self::_FDATE];
            return parent::init();
     }
     
     
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%personas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ap',  'nombres','tipodoc','numerodoc','codgrupo'], 'required'],
            [['identidad_id','codgrupo','provnac','distnac'], 'safe'],
            [['cumple'], 'validateFechas'],
            
            [['id','sexo', 'cumple','estcivil', 'pais', 'domicilio','telmoviles','telfijo'],'safe','on'=>self::SCE_UPDATE_MATRICULA],
            
            [['codigoper'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['pais','depnac', 'provnac', 'distnac','depdir', 'provdir', 'distdir', 'domicilio','codgrupo', 'sexo','estcivil'], 'safe'],
            //[['codpuesto'], 'string', 'max' => 3],
            [['domicilio'], 'string', 'max' => 73],
             [['tipodoc','numerodoc'], 'unique','targetAttribute'=>['tipodoc','numerodoc']],
            [['telfijo'], 'string', 'max' => 13],
            [['telmoviles', 'referencia'], 'string', 'max' => 30],
            
            
            
            /*[[
            'ap', 'am',
            'nombres', 'tipodoc', 
            'numerodoc','facultad_id',
            'universidad_id','carrera_id',
            
            'codgrupo','cumple','domicilio','telfijo','telmoviles','pais',
            'depdir','provdir','distdir','alergias','gruposangu','usoregulmedic',
            'depnac','provnac','distnac','pasaporte','referencia',
            'sexo','estcivil','alergias',
            
            ],'required','on'=>self::SCE_EXTRANJERO],*/
            
            //[['numerodoc','tipodoc'], 'unique'],
             //[['dni'], 'unique'],
            /*['dni','match',
                 'pattern'=>h::settings()->get('general','formatoDNI'),
                 'message'=>yii::t('base.errors','El {field} no coincide con el formato ',['field'=>$this->getAttributeLabel('dni')])
                
                 ],*/
        ];
    }

    
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigoper' => yii::t('base_labels', 'Person Code'),
            'ap' => yii::t('base_labels', 'Last Name'),
            'am' => yii::t('base_labels', "Mother Last Name"),
            'nombres' => yii::t('base_labels', 'Names'),
            'tipodoc' => yii::t('base_labels', 'Document Type'),
           
            'numerodoc' => yii::t('base_labels', 'Document Number'),
            'cumple' => yii::t('base_labels', 'Birth Date'),
            'cumple1' => yii::t('base_labels', 'Birth Date'),
            'fecingreso' => yii::t('base_labels', 'Begin Date'),
            'domicilio' => yii::t('base_labels', 'Address'),
            'telfijo' => yii::t('base_labels', 'Phone'),
            'telmoviles' => yii::t('base_labels', 'Movil Phone'),
            'referencia' => yii::t('base_labels', 'References'),
            'pais' => yii::t('base_labels', 'Nacionality'),
            'estcivil' => yii::t('base_labels', 'Civil Status'),
            'depnac' => yii::t('base_labels', 'Departament Nac.'),
            'provnac' => yii::t('base_labels', 'Province Nac.'),
            'distnac' => yii::t('base_labels', 'District Nac.'),
            'depdir' => yii::t('base_labels', 'Departament Add.'),
            'provdir' => yii::t('base_labels', 'Province Add.'),
            'distdir' => yii::t('base_labels', 'District Add.'),
            'paisresidencia' => yii::t('base_labels', 'Country Residence'),
            'lugarnacimiento' => yii::t('base_labels', 'Birth Place'),
            'lugarresidencia' => yii::t('base_labels', 'Place Residence'),
            'domiciliopaisorigen' => yii::t('base_labels', 'Address'),
            'domicilio' => yii::t('base_labels', 'Address Residence'),
            'codcontpaisresid' => yii::t('base_labels', 'Contact Country Residence'),
            'parentcontpaisresid' => yii::t('base_labels', 'Relationship Contact'),
            'gruposangu' => yii::t('base_labels', 'Blood Type'),            
            'usoregulmedic' => yii::t('base_labels', 'Regular Use Medications'),
            'polizaseguroint' => yii::t('base_labels', 'Insurance Policy'),
            'telefasistencia' => yii::t('base_labels', 'Assistance Phone'),
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        
         $scenarios[self::SCE_UPDATE_MATRICULA] = [
            'id',
            'sexo', 'cumple',
            'estcivil', 'pais', 'domicilio','telmoviles','telfijo'
            ];
         
        $scenarios[self::SCE_CREACION_BASICA] = [
            'ap', 'am',
            'nombres', 'tipodoc', 'numerodoc','identidad_id','codgrupo'
            ];
        $scenarios[self::SCE_CREACION_MINIMA] = [
            'ap', 
            'nombres', 'tipodoc', 'numerodoc','codgrupo'
            ];
        
          $scenarios[self::SCE_CREACION_EXTRANJERO] = [
            'ap', 
            'nombres', 'tipodoc', 'numerodoc','codgrupo',
             'lugarnacimiento', 'telpaisorigen', 'codcontpaisorigen',
            'parentcontpaisorigen', 'polizaseguroint', 'telefasistencia',
            'paisresidencia', 'lugarresidencia', 'codcontpaisresid',
            'parentcontpaisresid', 'tipogrado', 'idiomanativo', 'codresponsable',
            'alergias', 'gruposangu', 'usoregulmedic' 
              
            ];
        $scenarios[self::SCE_INTERMEDIO] = [
            'ap', 'am',
            'nombres', 'tipodoc', 
            'numerodoc','identidad_id',
            'codgrupo','cumple','domicilio','telfijo','telmoviles','pais',
            'depdir','provdir','distdir','alergias','gruposangu','usoregulmedic',
            'depnac','provnac','distnac','pasaporte','referencia','provnac','distnac',
            'sexo','estcivil','alergias',
            
            ];
        
        $scenarios[self::SCE_DOCENTES] = [
            'ap', 'am',
            'nombres', 'tipodoc', 
            'numerodoc','identidad_id',
            'codgrupo','cumple','fecingreso',
            'domicilio','telfijo','telmoviles',
            'referencia','sexo','estcivil',
            'depdir','provdir','distdir',
            'depnac','provnac','distnac','alergias',
            'telpaisorigen', 'codcontpaisorigen','pasaporte','gruposangu',
            'parentcontpaisorigen', 'polizaseguroint', 'telefasistencia',
            'paisresidencia', 'lugarresidencia', 'codcontpaisresid','lugarnacimiento',
            'parentcontpaisresid', 'tipogrado', 'idiomanativo', 'codresponsable'
            ];
        
        $scenarios[self::SCE_ALUMNOS] = [
            'ap', 'am',
            'nombres', 'tipodoc', 
            'numerodoc','identidad_id',
            'codgrupo','cumple','fecingreso',
            'domicilio','telfijo','telmoviles',
            'referencia','sexo','estcivil',
            'depdir','provdir','distdir',
            'depnac','provnac','distnac',
            'lugarnacimiento', 'telpaisorigen', 'codcontpaisorigen',
            'parentcontpaisorigen', 'polizaseguroint', 'telefasistencia',
            'paisresidencia', 'lugarresidencia', 'codcontpaisresid',
            'parentcontpaisresid', 'tipogrado', 'idiomanativo', 'codresponsable',
            'alergias', 'gruposangu', 'usoregulmedic'
            ];
        /*$scenarios[self::SCENARIO_ASISTIO] = ['asistio'];
        $scenarios[self::SCENARIO_PSICO] = ['codtra'];
        $scenarios[self::SCENARIO_ACTIVO] = ['activo'];
        $scenarios[self::SCENARIO_REPROGRAMA] = ['fechaprog', 'duracion', 'finicio', 'ftermino', 'codtra'];
        */return $scenarios;
    }
    
    public function getGrupo() {
        /* echo  $this->hasOne(Talleresdet::className(), ['id' => 'talleresdet_id'])->createCommand()
          ->getRawSql();die(); */
        return $this->hasOne(GrupoPersonas::className(), ['codgrupo' => 'codgrupo']);
    }
    
     public function getResponsable() {
        /* echo  $this->hasOne(Talleresdet::className(), ['id' => 'talleresdet_id'])->createCommand()
          ->getRawSql();die(); */
        return $this->hasOne(Personas::className(), ['codigoper' => 'codresponsable']);
    }
    
    public function getContacto() {
        /* echo  $this->hasOne(Talleresdet::className(), ['id' => 'talleresdet_id'])->createCommand()
          ->getRawSql();die(); */
        return $this->hasOne(Personas::className(), ['codigoper' => 'codcontpaisresid']);
    }
    
    public function getIdentidad() {
        if($this->isNewRecord)return null;
         return $this->hasOne($this->grupo->modelo::className(), ['persona_id' => 'id']);
    }
    
    
    public function validateFechas($attribute, $params)
    {
      // $this->toCarbon('fecingreso');
       //$this->toCarbon('cumple');
       //self::CarbonNow();
       //var_dump(self::CarbonNow());
        
       /*if($this->toCarbon('fecingreso')->greaterThan(self::CarbonNow())){
            $this->addError('fecingreso', yii::t('base.errors','La fecha  {campo} es una fecha futura',
                    ['campo'=>$this->getAttributeLabel('fecingreso')]));
       }*/
      // if(self::CarbonNow()->diffInYears( $this->toCarbon('cumple')) < 18){
       if($this->age() < 16){
            $this->addError('cumple', yii::t('base_labels','Too young'));
       }
        /*if (!in_array($this->$attribute, ['USA', 'Indonesia'])) {*/
           
        /*}*/
    }
 
    
    public function beforeSave($insert) {
        if($insert)
        $this->codigoper=$this->correlativo('codigoper');
        
       return parent::beforeSave($insert);
    }
    
    public function afterFind(){
        $this->nombrecompleto=$this->fullName();
        parent::afterFind();
    }

      public function name(){
          return $this->nombres;
        }  
  public function lastName(){
          return $this->ap;
        }  
        
        
 
        
  public function docsIdentity(){
         return [
             
             ];
        }  
        
        
  public function address(){
          return $this->domicilio;
        } 
        
        
  public function fenac(){
 return $this->toCarbon('cumple'); 
        }  
        
        
     public function IsBirthDay(){
         $hoy=Carbon::now();
 return $hoy->isBirthday($this->toCarbon('cumple')); 
        }  
        
        
        
     public function fullName($asc=TRUE,$ucase=true,$delimiter=' '){       
         $strname=($asc)?$this->nombres.' '.$this->ap.' '.$this->am:$strname= $this->ap.' '.$this->am.' '.$this->nombres;
         $strname= ($ucase)?\yii\helpers\StringHelper::mb_ucwords($strname):$strname;
       return str_replace(' ',$delimiter, $strname);
     }
    
     
    /**
     * {@inheritdoc}
     * @return CliproQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonasQuery(get_called_class());
    } 
    
    public function afterSave($insert, $changedAttributes) {
        if($insert){
            $this->refresh();
            //VAR_DUMP($this->id);DIE();
            $this->grupo->
            modelo::UpdateAll(['persona_id'=>$this->id],
                    ['id'=>$this->identidad_id]);
        }
        return parent::afterSave($insert, $changedAttributes);
    }
    
    /*
     * Crea un usuario con un ROl determinado
     *
     */
    public function createUser($username,$email,$role=null){ 
        //$user = new \mdm\admin\models\User();
        $user=new \common\models\User();
            $user->username= strtoupper($username);
             $user->email=$email;   
             $user->password= uniqid(); 
             //$model->retypePassword='123456'; 
               $user->status=\mdm\admin\models\User::STATUS_ACTIVE;
            if (!$user->save()) {
                                return NULL;
             }else{
                 $user->refresh();
                 $id=$user->id;
                 yii::error('El id de usuario '.$id ,__FUNCTION__);
                $user->profile->linkPerson($this->id);
                /****LE ASIGNA EL ROL */
                if(!is_null($role)){
                  $vari= Yii::$app->authManager->assign(
                 $role,
                 $user->id); 
                  //var_dump($vari);die();
                }
                    
                
                return $user;
                /************************/
             }
             
    }
    
    public function getProfile(){
        return $this->hasOne(Profile::className(), ['persona_id' => 'id']);
    }

   
    public function age(){
          return $this->toCarbon('cumple')->age; //no hay fecha de nacimiento
        }  
     
    
     
}