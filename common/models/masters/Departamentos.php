<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%departamentos}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property string|null $coddepa
 * @property string $nombredepa
 * @property string|null $detalles
 * @property string|null $correodepa
 * @property string|null $webdepa
 * @property string|null $codigoper
 *
 * @property Universidades $universidad
 * @property Personas $codigoper0
 * @property Facultades $facultad
 * @property InterConvocados[] $interConvocados
 * @property InterEvaluadores[] $interEvaluadores
 * @property InterExpedientes[] $interExpedientes
 * @property InterModos[] $interModos
 * @property InterPlan[] $interPlans
 * @property InterPrograma[] $interProgramas
 */
class Departamentos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%departamentos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id'], 'integer'],
            [['coddepa','nombredepa','universidad_id', 'facultad_id'], 'required'],
            [['detalles'], 'string'],
            [['coddepa'], 'string', 'max' => 10],
            [['coddepa'], 'unique'],
            [['nombredepa'], 'string', 'max' => 40],
            [['correodepa'], 'string', 'max' => 80],
            [['webdepa'], 'string', 'max' => 100],
            [['codigoper'], 'string', 'max' => 8],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['codigoper'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Personas::className(), 'targetAttribute' => ['codigoper' => 'codigoper']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'universidad_id' => Yii::t('base_labels', 'University'),
            'facultad_id' => Yii::t('base_labels', 'Faculty'),
            'coddepa' => Yii::t('base_labels', 'Code Area'),
            'nombredepa' => Yii::t('base_labels', 'Name Area'),
            'detalles' => Yii::t('base_labels', 'Details'),
            'correodepa' => Yii::t('base_labels', 'Mail Area'),
            'webdepa' => Yii::t('base_labels', 'Web Area'),
            'codigoper' => Yii::t('base_labels', 'Person Code'),
        ];
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
     * Gets query for [[Codigoper0]].
     *
     * @return \yii\db\ActiveQuery|PersonasQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['codigoper' => 'codigoper']);
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
     * Gets query for [[InterConvocados]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosQuery
     */
    public function getInterConvocados()
    {
       // return $this->hasMany(InterConvocados::className(), ['depa_id' => 'id']);
    }

    /**
     * Gets query for [[InterEvaluadores]].
     *
     * @return \yii\db\ActiveQuery|InterEvaluadoresQuery
     */
    public function getInterEvaluadores()
    {
        //return $this->hasMany(InterEvaluadores::className(), ['depa_id' => 'id']);
    }

    /**
     * Gets query for [[InterExpedientes]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getInterExpedientes()
    {
        //return $this->hasMany(InterExpedientes::className(), ['depa_id' => 'id']);
    }

    /**
     * Gets query for [[InterModos]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getInterModos()
    {
        //return $this->hasMany(InterModos::className(), ['depa_id' => 'id']);
    }

    /**
     * Gets query for [[InterPlans]].
     *
     * @return \yii\db\ActiveQuery|InterPlanQuery
     */
    public function getInterPlans()
    {
        //return $this->hasMany(InterPlan::className(), ['depa_id' => 'id']);
    }

    /**
     * Gets query for [[InterProgramas]].
     *
     * @return \yii\db\ActiveQuery|InterProgramaQuery
     */
    public function getInterProgramas()
    {
       // return $this->hasMany(InterPrograma::className(), ['depa_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return DepartamentosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartamentosQuery(get_called_class());
    }
}
