<?php

namespace common\models\masters;
use common\models\base\modelBase;
use common\models\Profile;
use common\helpers\h;
use common\helpers\BaseHelper;
use frontend\modules\inter\Module as m;
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
   
    public $dateorTimeFields = [
        'cumple' => self::_FDATE,
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
         $this->dateorTimeFields=['fecingreso'=>self::_FDATE,'cumple'=>self::_FDATE];
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
            [['ap', 'am', 'nombres','tipodoc','numerodoc'], 'required'],
            [['identidad_id','codgrupo'], 'safe'],
            [['cumple'], 'validateFechas'],
            [['codigoper'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['pais','depnac', 'provnac', 'distnac','depdir', 'provdir', 'distdir', 'domicilio','codgrupo', 'pasaporte','sexo','estcivil'], 'safe'],
            //[['codpuesto'], 'string', 'max' => 3],
            [['domicilio'], 'string', 'max' => 73],
            [['telfijo'], 'string', 'max' => 13],
            [['telmoviles', 'referencia'], 'string', 'max' => 30],
            
            
            
            [[
            'ap', 'am',
            'nombres', 'tipodoc', 
            'numerodoc','identidad_id',
            'codgrupo','cumple','domicilio','telfijo',
            'depdir','provdir','distdir',
            'depnac','provnac','distnac',
            'sexo','estcivil','pasaporte',
            
            ],'required','on'=>self::SCE_INTERMEDIO],
            
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
            'codigoper' => yii::t('labels', 'Code'),
            'ap' => yii::t('labels', 'Last Name'),
            'am' => yii::t('labels', "Last Name"),
            'nombres' => yii::t('labels', 'Names'),
            'tipodoc' => yii::t('labels', 'Type Doc'),
           
            'numerodoc' => yii::t('labels', 'Num. Doc'),
            'cumple' => yii::t('labels', 'Birth Date'),
            'fecingreso' => yii::t('labels', 'Begin Date'),
            'domicilio' => yii::t('labels', 'Address'),
            'telfijo' => yii::t('labels', 'Phone'),
            'telmoviles' => yii::t('labels', 'Movil Phone'),
            'referencia' => yii::t('labels', 'References'),
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_CREACION_BASICA] = [
            'ap', 'am',
            'nombres', 'tipodoc', 'numerodoc','identidad_id','codgrupo'
            ];
        $scenarios[self::SCE_INTERMEDIO] = [
            'ap', 'am',
            'nombres', 'tipodoc', 
            'numerodoc','identidad_id',
            'codgrupo','cumple','domicilio','telfijo',
            'depdir','provdir','distdir',
            'depnac','provnac','distnac',
            'sexo','estcivil','pasaporte',
            
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
            $this->addError('cumple', yii::t('errors','Too young'));
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
                return $user;
             }
             
    }
    
    public function getProfile(){
        return $this->hasOne(Profile::className(), ['persona_id' => 'id']);
    }

   
    public function age(){
          return $this->toCarbon('cumple')->age; //no hay fecha de nacimiento
        }  
        
     
}