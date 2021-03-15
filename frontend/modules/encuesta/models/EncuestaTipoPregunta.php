<?php

namespace frontend\modules\encuesta\models;

use Yii;

/**
 * This is the model class for table "{{%encuesta_tipo_pregunta}}".
 *
 * @property int $id
 * @property string $nombre_tipo
 *
 * @property EncuestaPreguntaEncuesta[] $encuestaPreguntaEncuestas
 */
class EncuestaTipoPregunta extends \common\models\base\modelBase 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%encuesta_tipo_pregunta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_tipo'], 'required'],
            [['nombre_tipo'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'nombre_tipo' => Yii::t('base_labels', 'Nombre Tipo'),
        ];
    }

    /**
     * Gets query for [[EncuestaPreguntaEncuestas]].
     *
     * @return \yii\db\ActiveQuery|EncuestaPreguntaEncuestaQuery
     */
    public function getEncuestaPreguntaEncuestas()
    {
        return $this->hasMany(EncuestaPreguntaEncuesta::className(), ['id_tipo_pregunta' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaTipoPreguntaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EncuestaTipoPreguntaQuery(get_called_class());
    }
}
