<?php

namespace frontend\modules\buzon\models;

use Yii;

/**
 * This is the model class for table "{{%buzon_mensaje_respuesta}}".
 *
 * @property int $id
 * @property int|null $bm_id
 * @property string|null $mensaje_respuesta
 * @property string|null $fecha_respuesta
 *
 * @property BuzonMensajes $bm
 */
class BuzonMensajeRespuesta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%buzon_mensaje_respuesta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bm_id'], 'integer'],
            [['mensaje_respuesta'], 'string'],
            [['fecha_respuesta'], 'safe'],
            [['bm_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuzonMensajes::className(), 'targetAttribute' => ['bm_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'bm_id' => Yii::t('base_labels', 'Bm ID'),
            'mensaje_respuesta' => Yii::t('base_labels', 'Mensaje Respuesta'),
            'fecha_respuesta' => Yii::t('base_labels', 'Fecha Respuesta'),
        ];
    }

    /**
     * Gets query for [[Bm]].
     *
     * @return \yii\db\ActiveQuery|BuzonMensajesQuery
     */
    public function getBm()
    {
        return $this->hasOne(BuzonMensajes::className(), ['id' => 'bm_id']);
    }

    /**
     * {@inheritdoc}
     * @return BuzonMensajeRespuestaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuzonMensajeRespuestaQuery(get_called_class());
    }
}
