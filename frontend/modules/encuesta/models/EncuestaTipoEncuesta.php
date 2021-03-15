<?php

namespace frontend\modules\encuesta\models;

use Yii;

/**
 * This is the model class for table "{{%encuesta_tipo_encuesta}}".
 *
 * @property int $id
 * @property string $nombre_tipo
 *
 * @property EncuestaEncuestaGeneral[] $encuestaEncuestaGenerals
 */
class EncuestaTipoEncuesta extends \common\models\base\modelBase 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%encuesta_tipo_encuesta}}';
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
     * Gets query for [[EncuestaEncuestaGenerals]].
     *
     * @return \yii\db\ActiveQuery|EncuestaEncuestaGeneralQuery
     */
    public function getEncuestaEncuestaGenerals()
    {
        return $this->hasMany(EncuestaEncuestaGeneral::className(), ['id_tipo_encuesta' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaTipoEncuestaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EncuestaTipoEncuestaQuery(get_called_class());
    }
}
