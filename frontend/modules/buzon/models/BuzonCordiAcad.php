<?php

namespace frontend\modules\buzon\models;

use Yii;

/**
 * This is the model class for table "{{%buzon_cordi_acad}}".
 *
 * @property int $id
 * @property int $bm_id
 * @property string $docente
 * @property string $curso
 * @property string $seccion
 *
 * @property BuzonMensajes $bm
 */
class BuzonCordiAcad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%buzon_cordi_acad}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bm_id', 'docente', 'curso', 'seccion'], 'required'],
            [['bm_id'], 'integer'],
            [['docente', 'curso', 'seccion'], 'string', 'max' => 30],
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
     * @return BuzonCordiAcadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuzonCordiAcadQuery(get_called_class());
    }
}
