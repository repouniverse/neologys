<?php

namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Periodos;
use common\models\masters\Personas;
use Yii;

/**
 * This is the model class for table "{{%inter_programa}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property string $codperiodo
 * @property int|null $depa_id
 * @property string $clase
 * @property string $status
 * @property string $codocu
 * @property string $codigoper
 * @property string $fopen
 * @property string $descripcion
 * @property string|null $detalles
 *
 * @property InterModos[] $interModos
 * @property Facultades $facultad
 * @property Periodos $codperiodo0
 * @property Departamentos $depa
 * @property Personas $codigoper0
 * @property Universidades $universidad
 */
class InterPrograma extends \common\models\base\modelBase
{
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_programa}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'depa_id'], 'integer'],
            [['codperiodo',  'codigoper', 'fopen', 'descripcion'], 'required'],
            [['detalles'], 'string'],
            [['codperiodo', 'fopen'], 'string', 'max' => 10],
            [['clase', 'status'], 'string', 'max' => 1],
            [['codocu'], 'string', 'max' => 3],
            [['codigoper'], 'string', 'max' => 8],
            [['descripcion'], 'string', 'max' => 40],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
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
            'id' => m::t('labels', 'ID'),
            'universidad_id' => m::t('labels', 'University'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'codperiodo' => m::t('labels', 'Period Code'),
            'depa_id' => m::t('labels', 'Departament'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'codocu' => m::t('labels', 'Document Code'),
            'codigoper' => m::t('labels', 'Person Code'),
            'fopen' => m::t('labels', 'Begin Date'),
            'descripcion' => m::t('labels', 'Description'),
            'detalles' => m::t('labels', 'Details'),
        ];
    }

    /**
     * Gets query for [[InterModos]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getModo()
    {
        return $this->hasMany(InterModos::className(), ['programa_id' => 'id']);
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
     * Gets query for [[Codperiodo0]].
     *
     * @return \yii\db\ActiveQuery|PeriodosQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(Periodos::className(), ['codperiodo' => 'codperiodo']);
    }

    /**
     * Gets query for [[Depa]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepa()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'depa_id']);
    }

    /**
     * Gets query for [[Codigoper0]].
     *
     * @return \yii\db\ActiveQuery|PersonasQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['codigoper' => 'codigoper']);
    }

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterProgramaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterProgramaQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        if($insert){
            $this->clase=m::CLASE_GENERAL;
            $this->status=m::STATUS_GENERAL;
            $this->codocu='112';
            }
        return parent::beforeSave($insert);
    }
}
