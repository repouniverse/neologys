<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%planes_estudio}}".
 *
 * @property int $id
 * @property int $curso_id
 * @property string $codcursocorto
 * @property string $codcurso
 * @property int $facultad_id
 * @property int $carrera_id
 * @property int $creditos
 * @property string $ciclo
 * @property int|null $hteoria
 * @property int|null $hpractica
 * @property string|null $obligatoriedad
 * @property string|null $tipoproceso
 * @property string|null $codareaesp
 *
 * @property Cursos $curso
 * @property Carreras $carrera
 * @property Facultades $facultad
 */
class PlanesEstudio extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%planes_estudio}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['curso_id', 'codcursocorto', 'codcurso', 'facultad_id', 'carrera_id', 'creditos', 'ciclo'], 'required'],
            [['curso_id', 'facultad_id', 'carrera_id', 'creditos', 'hteoria', 'hpractica'], 'integer'],
            [['codcursocorto'], 'string', 'max' => 10],
            [['codcurso'], 'string', 'max' => 18],
            [['ciclo', 'tipoproceso'], 'string', 'max' => 3],
            [['obligatoriedad'], 'string', 'max' => 1],
            [['codareaesp'], 'string', 'max' => 6],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::className(), 'targetAttribute' => ['curso_id' => 'id']],
            [['carrera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['carrera_id' => 'id']],
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
            'curso_id' => Yii::t('base_labels', 'Curso ID'),
            'codcursocorto' => Yii::t('base_labels', 'Codcursocorto'),
            'codcurso' => Yii::t('base_labels', 'Codcurso'),
            'facultad_id' => Yii::t('base_labels', 'Facultad ID'),
            'carrera_id' => Yii::t('base_labels', 'Carrera ID'),
            'creditos' => Yii::t('base_labels', 'Creditos'),
            'ciclo' => Yii::t('base_labels', 'Ciclo'),
            'hteoria' => Yii::t('base_labels', 'Hteoria'),
            'hpractica' => Yii::t('base_labels', 'Hpractica'),
            'obligatoriedad' => Yii::t('base_labels', 'Obligatoriedad'),
            'tipoproceso' => Yii::t('base_labels', 'Tipoproceso'),
            'codareaesp' => Yii::t('base_labels', 'Codareaesp'),
        ];
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery|CursosQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Cursos::className(), ['id' => 'curso_id']);
    }

    /**
     * Gets query for [[Carrera]].
     *
     * @return \yii\db\ActiveQuery|CarrerasQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(Carreras::className(), ['id' => 'carrera_id']);
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
    
    public function getPlan()
    {
        return $this->hasOne(Planes::className(), ['id' => 'planes_id']);
    }


    /**
     * {@inheritdoc}
     * @return PlanesEstudioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanesEstudioQuery(get_called_class());
    }
    
    public function hoursForWeek(){
       return  $this->hteoria+$this->hpractica;
    }
}
