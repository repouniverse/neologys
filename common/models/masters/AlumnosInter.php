<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%alumnos}}".
 *
 * @property int $id
 * @property int|null $facultad_id
 * @property int|null $universidad_id
 * @property int|null $persona_id
 * @property int|null $carrera_id
 * @property string $codalu
 * @property string|null $codalu1
 * @property string|null $codalu2
 * @property string|null $codigoper
 * @property string|null $ap
 * @property string|null $am
 * @property string|null $nombres
 * @property string $codpering
 * @property string $codfac
 * @property string|null $codesp
 * @property string|null $numerodoc
 * @property string|null $tipodoc
 * @property string|null $mail
 * @property string|null $motivo
 *
 * @property Personas $codigoper0
 * @property Carreras $carrera
 * @property Universidades $universidad
 * @property Facultades $facultad
 */
class AlumnosInter extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%alumnos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['facultad_id', 'universidad_id', 'persona_id', 'carrera_id'], 'integer'],
            [['codalu', 'codpering', 'codfac'], 'required'],
            [['codalu', 'codalu1', 'codalu2'], 'string', 'max' => 16],
            [['codigoper', 'codesp'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['codpering', 'codfac'], 'string', 'max' => 10],
            [['numerodoc'], 'string', 'max' => 20],
            [['tipodoc'], 'string', 'max' => 2],
            [['mail', 'motivo'], 'string', 'max' => 100],
            [['codigoper'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['codigoper' => 'codigoper']],
            [['carrera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['carrera_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
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
            'facultad_id' => Yii::t('base_labels', 'Faculty'),
            'universidad_id' => Yii::t('base_labels', 'University'),
            'persona_id' => Yii::t('base_labels', 'Person'),
            'carrera_id' => Yii::t('base_labels', 'Race'),
            'codalu' => Yii::t('base_labels', 'Code Student'),
            'codalu1' => Yii::t('base_labels', 'Code Student 1'),
            'codalu2' => Yii::t('base_labels', 'Code Student 2'),
            'codigoper' => Yii::t('base_labels', 'Person Code'),
            'ap' => Yii::t('base_labels', 'Last Name'),
            'am' => Yii::t('base_labels', 'Mother Last Name'),
            'nombres' => Yii::t('base_labels', 'Names'),
            'codpering' => Yii::t('base_labels', 'Entry Period Code'),
            'codfac' => Yii::t('base_labels', 'Code Faculty'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'numerodoc' => Yii::t('base_labels', 'Document Number'),
            'tipodoc' => Yii::t('base_labels', 'Document Type'),
            'mail' => Yii::t('base_labels', 'Mail'),
            'motivo' => Yii::t('base_labels', 'Reason'),
        ];
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
     * Gets query for [[Carrera]].
     *
     * @return \yii\db\ActiveQuery|CarrerasQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(Carreras::className(), ['id' => 'carrera_id']);
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
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * {@inheritdoc}
     * @return AlumnosInterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AlumnosInterQuery(get_called_class());
    }
}
