<?php

namespace common\models\masters;
use common\models\base\modelBase;
use common\helpers\h;
use common\helpers\BaseHelper;
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
            [['identidad_id'], 'safe'],
            [['cumple', 'fecingreso'], 'validateFechas'],
            [['codigoper'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
           // [['dni', 'ppt', 'pasaporte', 'cumple', 'fecingreso'], 'string', 'max' => 10],
            //[['codpuesto'], 'string', 'max' => 3],
            [['domicilio'], 'string', 'max' => 73],
            [['telfijo'], 'string', 'max' => 13],
            [['telmoviles', 'referencia'], 'string', 'max' => 30],
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
            'codigoper' => Yii::t('base.labels', 'Código'),
            'ap' => Yii::t('base.labels', 'A Pat'),
            'am' => Yii::t('base.labels', "A Mat"),
            'nombres' => Yii::t('base.labels', 'Nombres'),
            'tipodoc' => Yii::t('base.labels', 'Tipo doc'),
           
            'numerodoc' => Yii::t('base.labels', 'Num. Doc'),
            'cumple' => Yii::t('base.labels', 'F Nac.'),
            'fecingreso' => Yii::t('base.labels', 'F. ingreso'),
            'domicilio' => Yii::t('base.labels', 'Dirección'),
            'telfijo' => Yii::t('base.labels', 'Tel Fijo'),
            'telmoviles' => Yii::t('base.labels', 'Movil'),
            'referencia' => Yii::t('base.labels', 'Referencias'),
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_CREACION_BASICA] = [
            'ap', 'am',
            'nombres', 'tipodoc', 'numerodoc','identidad_id','codgrupo'
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
        
       if($this->toCarbon('fecingreso')->greaterThan(self::CarbonNow())){
            $this->addError('fecingreso', yii::t('base.errors','La fecha  {campo} es una fecha futura',
                    ['campo'=>$this->getAttributeLabel('fecingreso')]));
       }
      // if(self::CarbonNow()->diffInYears( $this->toCarbon('cumple')) < 18){
       if($this->age() < 16){
            $this->addError('cumple', yii::t('base.errors','Es muy joven para ser trabajador',
                    ['campo'=>$this->getAttributeLabel('cumple')]));
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
        
        
  public function age(){
          return $this->toCarbon('cumple')->age; //no hay fecha de nacimiento
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
    public function createUser($role){
        
    }
     
}