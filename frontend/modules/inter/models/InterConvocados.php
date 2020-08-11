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
 * This is the model class for table "{{%inter_convocados}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $modo_id
 * @property string|null $codperiodo
 * @property string $codocu
 * @property int|null $programa_id
 * @property string $clase
 * @property string $status
 * @property int|null $secuencia
 * @property int|null $alumno_id
 * @property int|null $docente_id
 * @property int|null $persona_id
 * @property int|null $identidad_id
 * @property string|null $codalu
 * @property string|null $codigo1
 * @property string|null $codigo2
 *
 * @property Periodos $codperiodo0
 * @property Universidades $universidad
 * @property Departamentos $depa
 * @property InterModos $modo
 * @property Facultades $facultad
 * @property Documentos $codocu0
 * @property InterExpedientes[] $interExpedientes
 */
class InterConvocados extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_convocados}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id'], 'integer'],
            [['codocu', 'clase', 'status'], 'required'],
            [['codperiodo'], 'string', 'max' => 10],
            [['codocu'], 'string', 'max' => 3],
            [['clase', 'status'], 'string', 'max' => 1],
            [['codalu', 'codigo1', 'codigo2'], 'string', 'max' => 16],
            [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
            [['modo_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterModos::className(), 'targetAttribute' => ['modo_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
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
            'depa_id' => Yii::t('base_labels', 'Depa ID'),
            'modo_id' => Yii::t('base_labels', 'Modo ID'),
            'codperiodo' => Yii::t('base_labels', 'Codperiodo'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'programa_id' => Yii::t('base_labels', 'Programa ID'),
            'clase' => Yii::t('base_labels', 'Clase'),
            'status' => Yii::t('base_labels', 'Status'),
            'secuencia' => Yii::t('base_labels', 'Secuencia'),
            'alumno_id' => Yii::t('base_labels', 'Alumno ID'),
            'docente_id' => Yii::t('base_labels', 'Docente ID'),
            'persona_id' => Yii::t('base_labels', 'Persona ID'),
            'identidad_id' => Yii::t('base_labels', 'Identidad ID'),
            'codalu' => Yii::t('base_labels', 'Codalu'),
            'codigo1' => Yii::t('base_labels', 'Codigo1'),
            'codigo2' => Yii::t('base_labels', 'Codigo2'),
        ];
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
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
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
     * Gets query for [[Modo]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getModo()
    {
        return $this->hasOne(InterModos::className(), ['id' => 'modo_id']);
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
     * Gets query for [[Codocu0]].
     *
     * @return \yii\db\ActiveQuery|DocumentosQuery
     */
    public function getCodocu0()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    /**
     * Gets query for [[InterExpedientes]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getInterExpedientes()
    {
        return $this->hasMany(InterExpedientes::className(), ['convocado_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return InterConvocadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterConvocadosQuery(get_called_class());
    }
}
