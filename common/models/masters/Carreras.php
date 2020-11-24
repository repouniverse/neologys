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
    const ID_CARRERA_COMUNICACIONES=1;
    const ID_CARRERA_TURISMO=2;
      const ID_CARRERA_PSICOLOGIA=3;
    public static function tableName()
    {
        return '{{%carreras}}';
    }

    public $booleanFields=['esbase'];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'ciclo'], 'integer'],
            [['nombre', 'acronimo'], 'required'],
            [['detalle'], 'string'],
              [['esbase'], 'safe'],
            [['codesp'], 'string', 'max' => 8],
            [['nombre'], 'string', 'max' => 60],
            [['acronimo'], 'string', 'max' => 12],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
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
            'universidad_id' => Yii::t('base_labels', 'University'),
            'facultad_id' => Yii::t('base_labels', 'Faculty'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'nombre' => Yii::t('base_labels', 'Name'),
            'acronimo' => Yii::t('base_labels', 'Acronym'),
            'ciclo' => Yii::t('base_labels', 'Cycle'),
            'detalle' => Yii::t('base_labels', 'Detail'),
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
       // return $this->hasMany(InterEvaluadores::className(), ['carrera_id' => 'id']);
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
