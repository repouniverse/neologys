<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Periodos;
use common\models\masters\Carreras;
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
            [['codperiodo', 'clase', 'status', 'codocu', 'codigoper', 'fopen', 'descripcion'], 'required'],
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
            'id' => Yii::t('base_labels', 'ID'),
            'universidad_id' => Yii::t('base_labels', 'Universidad ID'),
            'facultad_id' => Yii::t('base_labels', 'Facultad ID'),
            'codperiodo' => Yii::t('base_labels', 'Codperiodo'),
            'depa_id' => Yii::t('base_labels', 'Depa ID'),
            'clase' => Yii::t('base_labels', 'Clase'),
            'status' => Yii::t('base_labels', 'Status'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'codigoper' => Yii::t('base_labels', 'Codigoper'),
            'fopen' => Yii::t('base_labels', 'Fopen'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'detalles' => Yii::t('base_labels', 'Detalles'),
        ];
    }

    /**
     * Gets query for [[InterModos]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getInterModos()
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
    public function getCodperiodo0()
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
    public function getCodigoper0()
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
}
