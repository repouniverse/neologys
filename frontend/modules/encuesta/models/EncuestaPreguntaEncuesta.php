<?php

namespace frontend\modules\encuesta\models;

use Yii;

/**
 * This is the model class for table "{{%encuesta_pregunta_encuesta}}".
 *
 * @property int $id
 * @property int $id_encuesta
 * @property int $id_tipo_pregunta
 * @property string $pregunta
 *
 * @property EncuestaOpcionesPregunta[] $encuestaOpcionesPreguntas
 * @property EncuestaTipoPregunta $tipoPregunta
 * @property EncuestaEncuestaGeneral $encuesta
 * @property EncuestaRespuestaEncuesta[] $encuestaRespuestaEncuestas
 */
class EncuestaPreguntaEncuesta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%encuesta_pregunta_encuesta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_encuesta', 'id_tipo_pregunta', 'pregunta'], 'required'],
            [['id_encuesta', 'id_tipo_pregunta'], 'integer'],
            [['pregunta'], 'string', 'max' => 30],
            [['id_tipo_pregunta'], 'exist', 'skipOnError' => true, 'targetClass' => EncuestaTipoPregunta::className(), 'targetAttribute' => ['id_tipo_pregunta' => 'id']],
            [['id_encuesta'], 'exist', 'skipOnError' => true, 'targetClass' => EncuestaEncuestaGeneral::className(), 'targetAttribute' => ['id_encuesta' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'id_encuesta' => Yii::t('base_labels', 'Id Encuesta'),
            'id_tipo_pregunta' => Yii::t('base_labels', 'Id Tipo Pregunta'),
            'pregunta' => Yii::t('base_labels', 'Pregunta'),
        ];
    }

    /**
     * Gets query for [[EncuestaOpcionesPreguntas]].
     *
     * @return \yii\db\ActiveQuery|EncuestaOpcionesPreguntaQuery
     */
    public function getEncuestaOpcionesPreguntas()
    {
        return $this->hasMany(EncuestaOpcionesPregunta::className(), ['id_pregunta' => 'id']);
    }

    /**
     * Gets query for [[TipoPregunta]].
     *
     * @return \yii\db\ActiveQuery|EncuestaTipoPreguntaQuery
     */
    public function getTipoPregunta()
    {
        return $this->hasOne(EncuestaTipoPregunta::className(), ['id' => 'id_tipo_pregunta']);
    }

    /**
     * Gets query for [[Encuesta]].
     *
     * @return \yii\db\ActiveQuery|EncuestaEncuestaGeneralQuery
     */
    public function getEncuesta()
    {
        return $this->hasOne(EncuestaEncuestaGeneral::className(), ['id' => 'id_encuesta']);
    }

    /**
     * Gets query for [[EncuestaRespuestaEncuestas]].
     *
     * @return \yii\db\ActiveQuery|EncuestaRespuestaEncuestaQuery
     */
    public function getEncuestaRespuestaEncuestas()
    {
        return $this->hasMany(EncuestaRespuestaEncuesta::className(), ['id_pregunta' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaPreguntaEncuestaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EncuestaPreguntaEncuestaQuery(get_called_class());
    }
}
