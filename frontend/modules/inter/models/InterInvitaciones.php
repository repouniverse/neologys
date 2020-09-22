<?php

namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;
use common\helpers\h;
use Yii;

/**
 * This is the model class for table "{{%inter_invitaciones}}".
 *
 * @property int $id
 * @property int $facultad_id
 * @property int $universidad_id
 * @property string|null $numero
 * @property int $docenteinv_id
 * @property int $docenteanfi_id
 * @property int $evento_id
 * @property string $estado
 * @property string $activo
 * @property string|null $detalles
 * @property string|null $descripcion
 * @property int $universidad_dest
 * @property int $facultad_dest
 *
 * @property Facultades $facultadDest
 * @property Universidades $universidad
 * @property Facultades $facultad
 * @property Universidades $universidadDest
 * @property Docentes $docenteinv
 */
class InterInvitaciones extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_invitaciones}}';
    }
   public $booleanFields=['estado', 'activo'];
       public $prefijo='37';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['facultad_id', 'universidad_id', 'docenteinv_id', 'docenteanfi_id', 'evento_id'], 'required'],
            [['facultad_id', 'universidad_id', 'docenteinv_id', 'docenteanfi_id', 'evento_id', 'universidad_dest', 'facultad_dest'], 'integer'],
            [['detalles'], 'string'],
            [['carrera_dest'], 'safe'],
            [['numero'], 'string', 'max' => 10],
            [['docenteanfi_id'],'validateDocente'],
             [['evento_id'],'validateEvento'],
            [['descripcion'], 'string', 'max' => 40],
            [['facultad_dest'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Facultades::className(), 'targetAttribute' => ['facultad_dest' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_dest'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Universidades::className(), 'targetAttribute' => ['universidad_dest' => 'id']],
            [['docenteinv_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Docentes::className(), 'targetAttribute' => ['docenteinv_id' => 'id']],
        [['docenteanfi_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Docentes::className(), 'targetAttribute' => ['docenteanfi_id' => 'id']],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'facultad_id' => m::t('labels', 'Host Faculty'),
            'universidad_id' => m::t('labels', 'Host University'),
            'numero' => m::t('labels', 'Number'),
            'docenteinv_id' => m::t('labels', 'Invited Teacher'),
            'docenteanfi_id' => m::t('labels', 'Host Teacher'),
            'evento_id' => m::t('labels', 'Host Event'),
            'estado' => m::t('labels', 'Status'),
            'activo' => m::t('labels', 'Active'),
            'detalles' => m::t('labels', 'Details'),
            'descripcion' => m::t('labels', 'Description'),
            'universidad_dest' => m::t('labels', 'Target University'),
            'facultad_dest' => m::t('labels', 'Target Faculty'),
             'carrera_dest' => m::t('labels', 'Target Profession'),
        ];
    }

    /**
     * Gets query for [[FacultadDest]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultadDest()
    {
        return $this->hasOne(\common\models\masters\Facultades::className(), ['id' => 'facultad_dest']);
    }

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(\common\models\masters\Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(\common\models\masters\Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * Gets query for [[UniversidadDest]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidadDest()
    {
        return $this->hasOne(\common\models\masters\Universidades::className(), ['id' => 'universidad_dest']);
    }
    
     public function getCarreraDest()
    {
        return $this->hasOne(\common\models\masters\Carreras::className(), ['id' => 'universidad_dest']);
    }
public function getEvento()
    {
        return $this->hasOne(InterEventos::className(), ['id' => 'evento_id']);
    }
    /**
     * Gets query for [[Docenteinv]].
     *
     * @return \yii\db\ActiveQuery|DocentesQuery
     */
    public function getDocenteinv()
    {
        return $this->hasOne(\common\models\masters\Docentes::className(), ['id' => 'docenteinv_id']);
    }
    
     public function getDocenteanfi()
    {
        return $this->hasOne(\common\models\masters\Docentes::className(), ['id' => 'docenteanfi_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterInvitacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterInvitacionesQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        if($insert){
            $this->numero=$this->correlativo('numero');
            $evento=$this->evento;
                $this->universidad_dest=$evento->universidad_id;
                $this->facultad_dest=$evento->facultad_id;
                $this->carrera_dest=$evento->carrera_id;
        }
        return parent::beforeSave($insert);
    }
    
    public function validateDocente($attribute,$params){
        if($this->docenteanfi_id==$this->docenteinv_id)
        $this->addError ('docenteanfi_id',m::t('errors','Teachers should be differents'));
        /*
         * NO puede ser que el que invita no sea de la universidad base
         * 
         */
        if($this->docenteanfi->isExternal())
         $this->addError ('docenteanfi_id',m::t('errors','Teachers should be local'));
        
        
    }
    
    public function validateEvento($attribute,$params){
        if($this->evento->universidad->id <> h::currentUniversity())
         $this->addError ('evento_id',m::t('errors','Event should be local'));
        
        
    }
    
    
    
}
