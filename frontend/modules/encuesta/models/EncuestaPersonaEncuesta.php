<?php

namespace frontend\modules\encuesta\models;
use common\models\masters\Personas;
use Yii;

/**
 * This is the model class for table "{{%encuesta_persona_encuesta}}".
 *
 * @property int $id
 * @property int $id_encuesta
 * @property int $id_persona
 * @property string $fecha
 *
 * @property EncuestaEncuestaGeneral $encuesta
 * @property Personas $persona
 * @property EncuestaRespuestaEncuesta[] $encuestaRespuestaEncuestas
 */
class EncuestaPersonaEncuesta extends \common\models\base\modelBase 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%encuesta_persona_encuesta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_encuesta', 'id_persona', 'fecha'], 'required'],
            [['id_encuesta', 'id_persona'], 'integer'],
            [['fecha'], 'string', 'max' => 30],
            [['id_encuesta'], 'exist', 'skipOnError' => true, 'targetClass' => EncuestaEncuestaGeneral::className(), 'targetAttribute' => ['id_encuesta' => 'id']],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_persona' => 'id']],
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
            'id_persona' => Yii::t('base_labels', 'Id Persona'),
            'fecha' => Yii::t('base_labels', 'Fecha'),
        ];
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
     * Gets query for [[Persona]].
     *
     * @return \yii\db\ActiveQuery|PersonasQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'id_persona']);
    }

    /**
     * Gets query for [[EncuestaRespuestaEncuestas]].
     *
     * @return \yii\db\ActiveQuery|EncuestaRespuestaEncuestaQuery
     */
    public function getEncuestaRespuestaEncuestas()
    {
        return $this->hasMany(EncuestaRespuestaEncuesta::className(), ['id_persona_encuesta' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaPersonaEncuestaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EncuestaPersonaEncuestaQuery(get_called_class());
    }
}
