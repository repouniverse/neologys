<?php

namespace frontend\modules\encuesta\models;

use Yii;

/**
 * This is the model class for table "{{%encuesta_opciones_pregunta}}".
 *
 * @property int $id
 * @property int $id_pregunta
 * @property string $valor
 * @property string $descripcion
 *
 * @property EncuestaPreguntaEncuesta $pregunta
 */
class EncuestaOpcionesPregunta extends \common\models\base\modelBase 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%encuesta_opciones_pregunta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pregunta', 'valor', 'descripcion'], 'required'],
            [['id_pregunta'], 'integer'],
            [['valor', 'descripcion'], 'string', 'max' => 30],
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
            'valor' => Yii::t('base_labels', 'Valor'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
        ];
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
     * @return EncuestaOpcionesPreguntaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EncuestaOpcionesPreguntaQuery(get_called_class());
    }
}
