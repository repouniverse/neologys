<?php

namespace common\models;
use common\helpers\h;
use common\models\masters\Trabajadores;
use common\helpers\FileHelper;
use common\behaviors\FileBehavior;
use frontend\modules\sta\helpers\comboHelper;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * Esta clase personaliza y extiende los datos
 * de usuario, como nombres apuellido, tiempo de xpiracion
 * de sesión, la fotografia 
 * 
 * Extiende la interface PersonInterface  
 **/
class Profile extends \common\models\base\modelBase implements \common\interfaces\PersonInterface
{
   const SCENARIO_INTERLOCUTOR='tipo';
    public $interlocutor='';
    /**
     * {@inheritdoc}
     */
            CONST PRF_TRABAJADOR='10';
            CONST PRF_ALUMNO='20';
            CONST PRF_COORDINADOR='30';
            CONST PRF_PSICOLOGO='40';
            CONST PRF_ASSOCIAL='50';
            CONST PRF_ALUMNORIESGO='60';
            CONST PRF_ALUMNOTUTOR='70';
            CONST PRF_DOCENTE='80';
            CONST PRF_DOCENTE_TUTOR='90';
            //CONST PRF_ASSOCIAL='50';
    
      public $perfiles=[
           self::PRF_TRABAJADOR=>'common\models\masters\Trabajadores',
          self::PRF_ALUMNO=>'frontend\modules\sta\models\Alumnos',
          self::PRF_COORDINADOR=>'frontend\modules\sta\models\Coordinador',
           self::PRF_PSICOLOGO=>'frontend\modules\sta\models\Psicologo',
          self::PRF_ASSOCIAL=>'frontend\modules\sta\models\Social',
          self::PRF_ALUMNORIESGO=>'frontend\modules\sta\models\AlumnoRiesgo',
           self::PRF_ALUMNOTUTOR=>'frontend\modules\sta\models\AlumnoTutor',
          self::PRF_DOCENTE=>'frontend\modules\sta\models\Docente',
          self::PRF_DOCENTE_TUTOR=>'frontend\modules\sta\models\DocenteTutor',
          
      ];      
            
  public $booleanFields=['recexternos'];          
            
    public static function tableName()
    {
        return '{{%profile}}';
    }

    
    public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		]
		
	];
}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['url','persona_id'], 'safe'],

            // ['codtra', 'unique', 'targetAttribute' => ['user_id','codtra']],
            [['user_id','codtra'], 'unique', 'targetAttribute' =>'codtra' ],

            [['photo', 'detalle'], 'string'],
            [['names'], 'string', 'max' => 60],
             
             [['names','duration','durationabsolute','url','codtra','recexternos'], 'safe'],
            [['tipo'],'required','on'=>self::SCENARIO_INTERLOCUTOR],
            [['tipo'],'safe','on'=>self::SCENARIO_INTERLOCUTOR],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INTERLOCUTOR] = ['tipo','codtra','user_id'];
        //$scenarios[self::SCENARIO_UPDATE_TABULAR] = ['codigo','coditem'];
       // $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'user_id' => Yii::t('base.names', 'Id usuario'),
            'names' => Yii::t('base.names', 'Nombres'),
            'photo' => Yii::t('base.names', 'Foto'),
            'detalle' => Yii::t('base.names', 'Detalle'),
            'interlocutor' => Yii::t('base.names', 'Type'),
             'recexternos' => Yii::t('base.names', 'Usa Rec Externos'),
            'duration' => Yii::t('base.names', 'Duracion'),
            'durationabsolute' => Yii::t('base.names', 'Duracion absoluta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }
    
   /*
    * Se elimina esta funcion por ser muy especiica,
    * se imleentara un nuevo metodo
    * para obetnere un cargo sin especificar 
    * 
    *  public function getAlu()
    {
        if(h::app()->hasModule('sta')){
             if($this->tipo== \frontend\modules\sta\staModule::USER_ALUMNO){
           \frontend\modules\sta\models\Alumnos::firstOrCreateStatic(['profile_id'=>$this->id],\frontend\modules\sta\models\Alumnos::SCENARIO_SOLO);
               return $this->hasOne(\frontend\modules\sta\models\Alumnos::className(), ['profile_id' => 'id']);
      
             }
                  }else{
            return $this;
        }
       
        
    }
    */
   public function afterFind() {
       if(!empty($this->tipo))
       //$this->interlocutor= comboHelper::getCboValores('sta.tipoprofile')[$this->tipo];
     // echo "murio"; die();
       parent::afterFind();
      /* if(h::app()->hasModule('sta')){
             if($this->tipo== \frontend\modules\sta\staModule::USER_ALUMNO){
           \frontend\modules\sta\models\Alumnos::firstOrCreateStatic(['profile_id'=>$this->id],\frontend\modules\sta\models\Alumnos::SCENARIO_SOLO);
               //return $this->hasOne(\frontend\modules\sta\models\Alumnos::className(), ['profile_id' => 'id']);
      
            
                  }
    
          }
*/
   
   }
   
   public function hasAtachment(){
       return (count($this->files)>0);
   }
    
   
   public function getUrlImage(){
       if($this->hasAtachment()){
        
           return $this->files[0]->getUrl();
       }else{
         
        return $this->sourceExternalImage();
       }
   }
   
   /*Busnca una fuente extena en el modulo sta
    * Esi no encuentra deveulve el defaulr 
    */
   private function sourceExternalImage(){
       $link=\frontend\modules\sta\staModule::getPathImage($this->user->username);
       if(h::app()->hasModule('sta') && 
               $this->tipo== \frontend\modules\sta\staModule::USER_ALUMNO && 
               $link ){
           return $link; 
       }else{
          return  FileHelper::getUrlImageUserGuest();  
       }
   }
   
   public function name(){
       return $this->names;
   }
  
    public function apellido(){
        return $this->names;
    }
    
    
    /*Devuelve un data provider del log de logueoos user por usuario 
    *
    */
   public static function providerLogAudit(){
            return new ActiveDataProvider([
                'query' => Useraudit::find()->where(['user_id'=>h::userId()]),
                'pagination' => [
                    'pageSize' => 20,
                            ],
                                    ]);
        } 
        
   
     
       
  public function lastName(){
          return $this->ap;
        }  
  public function age(){
          return 0; //no hay fecha de nacimiento
        }  
  public function docsIdentity(){
         return [
             h::AdocId()[BaseHelper::DOC_DNI]=>$this->dni,
              h::AdocId()[BaseHelper::DOC_PASAPORTE]=>$this->pasaporte,
              h::AdocId()[BaseHelper::DOC_PPT]=>$this->ppt,
             // h::AdocId()[BaseHelper::DOC_BREVETE]=>$this->ppt,
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
     public function fullName($asc=TRUE,$ucase=true,$delimiter=''){       
         $strname=($asc)?$this->nombres.' '.$this->ap.' '.$this->am:$strname= $this->ap.' '.$this->am.' '.$this->nombres;
         $strname= ($ucase)?\yii\helpers\StringHelper::mb_ucwords($strname):$strname;
       return str_replace(' ',$delimiter, $strname);
     }
     
     
  public function putUrl($url){
      $this->url=$url;
      $this->save();
  }   

  
   public function getPersona()
    {
        return $this->hasOne(masters\Personas::className(), ['id' => 'persona_id']);
    }

  
    public static function UserIdByTrabajador($codtra){
       return static::find()->andWhere(['codtra'=>$codtra])->one();
    }
    
    
  public function linkPerson($idPerson){
      $personas=masters\Personas::findOne($idPerson);
      if(is_null($personas))
       return false;
      $this->persona_id=$idPerson;
      return $this->save();
     }
    
    
    
  }
