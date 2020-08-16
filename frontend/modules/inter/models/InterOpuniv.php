<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use Yii;

/**
 * This is the model class for table "{{%inter_opuniv}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $convocatoria_id
 * @property int|null $univop_id
 * @property int|null $prioridad
 * @property string|null $comentarios
 *
 * @property Universidades $universidad
 * @property Facultades $facultad
 */
class InterOpuniv extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_opuniv}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'convocatoria_id', 'univop_id', 'prioridad'], 'integer'],
            [['comentarios'], 'string'],
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
            'id' => Yii::t('labels', 'ID'),
            'universidad_id' => Yii::t('labels', 'Universidad ID'),
            'facultad_id' => Yii::t('labels', 'Facultad ID'),
            'convocatoria_id' => Yii::t('labels', 'Convocatoria ID'),
            'univop_id' => Yii::t('labels', 'Univop ID'),
            'prioridad' => Yii::t('labels', 'Prioridad'),
            'comentarios' => Yii::t('labels', 'Comentarios'),
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
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getConvocatoria()
    {
        return $this->hasOne(InterConvocados::className(), ['id' => 'convocatoria_id']);
    }
    
    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getUnivop()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'univop_id']);
    }
    
    /**
     * {@inheritdoc}
     * @return InterOpunivQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterOpunivQuery(get_called_class());
    }
}
