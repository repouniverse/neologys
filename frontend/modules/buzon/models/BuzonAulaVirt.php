<?php

namespace frontend\modules\buzon\models;

use Yii;

/**
 * This is the model class for table "{{%buzon_aula_virt}}".
 *
 * @property int $id
 * @property int $bm_id
 * @property string $docente
 * @property string $curso
 * @property string $seccion
 * @property string $ciclo
 *
 * @property BuzonMensajes $bm
 */
class BuzonAulaVirt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%buzon_aula_virt}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bm_id', 'docente', 'curso', 'seccion', 'ciclo'], 'required'],
            [['bm_id'], 'integer'],
            [['docente', 'curso', 'seccion', 'ciclo'], 'string', 'max' => 30],
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
            'docente' => Yii::t('base_labels', 'Docente'),
            'curso' => Yii::t('base_labels', 'Curso'),
            'seccion' => Yii::t('base_labels', 'Seccion'),
            'ciclo' => Yii::t('base_labels', 'Ciclo'),
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
     * @return BuzonAulaVirtQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuzonAulaVirtQuery(get_called_class());
    }
}
