<?php

namespace frontend\modules\tramdoc\models;

use Yii;

/**
 * This is the model class for table "{{%tramdoc_auditoria_reserv}}".
 *
 * @property int $id
 * @property int $matr_reserv_id
 * @property int|null $persona_id
 * @property string|null $campo_modificado
 * @property string|null $valor_modificado
 * @property string|null $fecha_modif
 *
 * @property TramdocMatriculaReserv $matrReserv
 */
class TramdocAuditoriaReserv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tramdoc_auditoria_reserv}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matr_reserv_id'], 'required'],
            [['matr_reserv_id', 'persona_id'], 'integer'],
            [['fecha_modif'], 'safe'],
            [['campo_modificado', 'valor_modificado'], 'string', 'max' => 255],
            [['matr_reserv_id'], 'exist', 'skipOnError' => true, 'targetClass' => TramdocMatriculaReserv::className(), 'targetAttribute' => ['matr_reserv_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'matr_reserv_id' => Yii::t('base_labels', 'Matr Reserv ID'),
            'persona_id' => Yii::t('base_labels', 'Persona ID'),
            'campo_modificado' => Yii::t('base_labels', 'Campo Modificado'),
            'valor_modificado' => Yii::t('base_labels', 'Valor Modificado'),
            'fecha_modif' => Yii::t('base_labels', 'Fecha Modif'),
        ];
    }

    /**
     * Gets query for [[MatrReserv]].
     *
     * @return \yii\db\ActiveQuery|TramdocMatriculaReservQuery
     */
    public function getMatrReserv()
    {
        return $this->hasOne(TramdocMatriculaReserv::className(), ['id' => 'matr_reserv_id']);
    }

    /**
     * {@inheritdoc}
     * @return TramdocAuditoriaReservQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TramdocAuditoriaReservQuery(get_called_class());
    }
}
