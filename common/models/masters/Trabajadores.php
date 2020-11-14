<?php

namespace common\models\masters;
use common\interfaces\identidadesInterface;
use common\interfaces\PersonInterface;
use Yii;
use common\traits\identidadTrait;
use common\traits\nameTrait;
/**
 * This is the model class for table "{{%trabajadores}}".
 *
 * @property int $id
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string|null $numerodoc
 * @property string|null $tipodoc
 * @property string|null $fingreso
 * @property string|null $detalles
 * @property string|null $correo
 * @property string|null $codtra
 * @property int|null $persona_id
 * @property string|null $codigoper
 * @property string|null $codcargo
 */
class Trabajadores extends \common\models\base\modelBase

{
    use nameTrait;
    use identidadTrait;
  // public $persona=null;
    public $prefijo='87';
    public $hardFields=['ap','am','nombres','tipodoc','numerodoc'];
    const SCE_CREACION_BASICA='basico';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%trabajadores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ap', 'am', 'nombres','facultad_id',
                'universidad_id',
                'cargo_id','tipodoc','numerodoc'], 'required'],
            [['detalles'], 'string'],
            [['persona_id'], 'integer'],
             [['persona_id','facultad_id','universidad_id','depa_id','cargo_id'], 'safe'],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['numerodoc'], 'string', 'max' => 20],
             [['numerodoc'], 'validateDuplicado'],
            [['tipodoc'], 'string', 'max' => 2],
            [['fingreso', 'codtra'], 'string', 'max' => 10],
            [['correo'], 'string', 'max' => 80],
            [['codigoper', 'codcargo'], 'string', 'max' => 8],
             [['tipodoc','numerodoc'], 'unique','targetAttribute'=>['tipodoc','numerodoc']],
              [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::className(), 'targetAttribute' => ['cargo_id' => 'id']],
        ];
    }

     public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_CREACION_BASICA] = [
           'ap','am','nombres','tipodoc','numerodoc',
            'universidad_id', 'facultad_id','cargo_id',
            ];
        
       
        
       return $scenarios;
    }
    
    
    public function behaviors() {
        return [
            
            'auditoriaBehavior' => [
                'class' => '\common\behaviors\AuditBehavior',
            ],
        ];
           }    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'ap' => Yii::t('base_labels', 'Last Name'),
            'am' => Yii::t('base_labels', 'Mother Last Name'),
            'nombres' => Yii::t('base_labels', 'Names'),
            'numerodoc' => Yii::t('base_labels', 'Document Number'),
            'tipodoc' => Yii::t('base_labels', 'Document Type'),
            'fingreso' => Yii::t('base_labels', 'Begin Date'),
            'detalles' => Yii::t('base_labels', 'Details'),
            'correo' => Yii::t('base_labels', 'Mail'),
            'codtra' => Yii::t('base_labels', 'Worker Code'),
            'persona_id' => Yii::t('base_labels', 'Person ID'),
            'codigoper' => Yii::t('base_labels', 'Person Code'),
            'codcargo' => Yii::t('base_labels', 'Cargo Code'),
        ];
    }

    
    public function getPersona() {
         return $this->hasOne(Personas::className(), [ 'id'=> 'persona_id']);
   
    }
    /**
     * {@inheritdoc}
     * @return TrabajadoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrabajadoresQuery(get_called_class());
    }
    
    
     public function fullName($asc=TRUE,$ucase=true,$delimiter=' '){       
         $strname=($asc)?$this->nombres.' '.$this->ap.' '.$this->am:$strname= $this->ap.' '.$this->am.' '.$this->nombres;
         $strname= ($ucase)?\yii\helpers\StringHelper::mb_ucwords($strname):$strname;
       return str_replace(' ',$delimiter, $strname);
     }
   
     public function beforeSave($insert) {
        if($insert){            
           $this->codtra=$this->correlativo('codtra',8);           
        }
        
        
       return parent::beforeSave($insert);
    }
 
    public function afterSave($insert, $changedAttributes) {
        if($insert){
            $this->refresh();
            $this->createPersonFromThis();
        }
        return parent::afterSave($insert, $changedAttributes);
    }
    
    
}
