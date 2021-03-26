<?php

namespace frontend\modules\encuesta\models;

use Yii;

/**
 * This is the model class for table "{{%encuesta_respuesta_encuesta}}".
 *
 * @property int $id
 * @property int $id_pregunta
 * @property int $id_persona_encuesta
 * @property string $respuesta
 *
 * @property EncuestaPersonaEncuesta $personaEncuesta
 * @property EncuestaPreguntaEncuesta $pregunta
 */
class EncuestaRespuestaEncuesta extends \common\models\base\modelBase 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%encuesta_respuesta_encuesta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pregunta', 'id_persona_encuesta', 'respuesta'], 'required'],
            [['id_pregunta', 'id_persona_encuesta'], 'integer'],
            [['respuesta'], 'string', 'max' => 250],
            [['id_persona_encuesta'], 'exist', 'skipOnError' => true, 'targetClass' => EncuestaPersonaEncuesta::className(), 'targetAttribute' => ['id_persona_encuesta' => 'id']],
            [['id_pregunta'], 'exist', 'skipOnError' => true, 'targetClass' => EncuestaPreguntaEncuesta::className(), 'targetAttribute' => ['id_pregunta' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'id_pregunta' => Yii::t('base_labels', 'Id Pregunta'),
            'id_persona_encuesta' => Yii::t('base_labels', 'Id Persona Encuesta'),
            'respuesta' => Yii::t('base_labels', 'Respuesta'),
        ];
    }

    /**
     * Gets query for [[PersonaEncuesta]].
     *
     * @return \yii\db\ActiveQuery|EncuestaPersonaEncuestaQuery
     */
    public function getPersonaEncuesta()
    {
        return $this->hasOne(EncuestaPersonaEncuesta::className(), ['id' => 'id_persona_encuesta']);
    }

    /**
     * Gets query for [[Pregunta]].
     *
     * @return \yii\db\ActiveQuery|EncuestaPreguntaEncuestaQuery
     */
    public function getPregunta() 
    {
        return $this->hasOne(EncuestaPreguntaEncuesta::className(), ['id' => 'id_pregunta']);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaRespuestaEncuestaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EncuestaRespuestaEncuestaQuery(get_called_class());
    }
}
