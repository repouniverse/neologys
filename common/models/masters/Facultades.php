<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%facultades}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property string|null $codfac
 * @property string $desfac
 * @property string|null $code1
 * @property string|null $code2
 * @property string|null $code3
 *
 * @property Alumnos[] $alumnos
 * @property Carreras[] $carreras
 * @property Departamentos[] $departamentos
 * @property Universidades $universidad
 * @property InterConvocados[] $interConvocados
 * @property InterEvaluadores[] $interEvaluadores
 * @property InterExpedientes[] $interExpedientes
 * @property InterModos[] $interModos
 * @property InterPlan[] $interPlans
 * @property InterPrograma[] $interProgramas
 */
class Facultades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%facultades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id'], 'integer'],
            [['desfac'], 'required'],
            [['codfac'], 'string', 'max' => 10],
            [['desfac'], 'string', 'max' => 60],
            [['code1', 'code2'], 'string', 'max' => 2],
            [['code3'], 'string', 'max' => 3],
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
            'universidad_id' => Yii::t('base_labels', 'University ID'),
            'codfac' => Yii::t('base_labels', 'Faculty Code'),
            'desfac' => Yii::t('base_labels', 'Faculty Description'),
            'code1' => Yii::t('base_labels', 'Code 1'),
            'code2' => Yii::t('base_labels', 'Code 2'),
            'code3' => Yii::t('base_labels', 'Code 3'),
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery|AlumnosQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::className(), ['facultad_id' => 'id']);
    }

    /**
     * Gets query for [[Carreras]].
     *
     * @return \yii\db\ActiveQuery|CarrerasQuery
     */
    public function getCarreras()
    {
        //return $this->hasMany(Carreras::className(), ['facultad_id' => 'id']);
    }

    /**
     * Gets query for [[Departamentos]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepartamentos()
    {
        //return $this->hasMany(Departamentos::className(), ['facultad_id' => 'id']);
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
     * Gets query for [[InterConvocados]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosQuery
     */
    public function getInterConvocados()
    {
        //return $this->hasMany(InterConvocados::className(), ['facultad_id' => 'id']);
    }

    /**
     * Gets query for [[InterEvaluadores]].
     *
     * @return \yii\db\ActiveQuery|InterEvaluadoresQuery
     */
    public function getInterEvaluadores()
    {
        //return $this->hasMany(InterEvaluadores::className(), ['facultad_id' => 'id']);
    }

    /**
     * Gets query for [[InterExpedientes]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getInterExpedientes()
    {
        //return $this->hasMany(InterExpedientes::className(), ['facultad_id' => 'id']);
    }

    /**
     * Gets query for [[InterModos]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getInterModos()
    {
        //return $this->hasMany(InterModos::className(), ['facultad_id' => 'id']);
    }

    /**
     * Gets query for [[InterPlans]].
     *
     * @return \yii\db\ActiveQuery|InterPlanQuery
     */
    public function getInterPlans()
    {
        //return $this->hasMany(InterPlan::className(), ['facultad_id' => 'id']);
    }

    /**
     * Gets query for [[InterProgramas]].
     *
     * @return \yii\db\ActiveQuery|InterProgramaQuery
     */
    public function getInterProgramas()
    {
        //return $this->hasMany(InterPrograma::className(), ['facultad_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FacultadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FacultadesQuery(get_called_class());
    }
}
