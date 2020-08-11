<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%carreras}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property string|null $codesp
 * @property string $nombre
 * @property string $acronimo
 * @property int|null $ciclo
 * @property string|null $detalle
 *
 * @property Alumnos[] $alumnos
 * @property Facultades $facultad
 * @property Universidades $universidad
 * @property InterEvaluadores[] $interEvaluadores
 */
class Carreras extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%carreras}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'ciclo'], 'integer'],
            [['nombre', 'acronimo'], 'required'],
            [['detalle'], 'string'],
            [['codesp'], 'string', 'max' => 8],
            [['nombre'], 'string', 'max' => 60],
            [['acronimo'], 'string', 'max' => 12],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
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
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'nombre' => Yii::t('base_labels', 'Nombre'),
            'acronimo' => Yii::t('base_labels', 'Acronimo'),
            'ciclo' => Yii::t('base_labels', 'Ciclo'),
            'detalle' => Yii::t('base_labels', 'Detalle'),
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery|AlumnosQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::className(), ['carrera_id' => 'id']);
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
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * Gets query for [[InterEvaluadores]].
     *
     * @return \yii\db\ActiveQuery|InterEvaluadoresQuery
     */
    public function getInterEvaluadores()
    {
        return $this->hasMany(InterEvaluadores::className(), ['carrera_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CarrerasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarrerasQuery(get_called_class());
    }
}
