<?php

namespace frontend\modules\tramdoc\models;
use common\models\masters\Documentos;
use Yii;

/**
 * This is the model class for table "{{%tramdoc_files_reserv}}".
 *
 * @property int $id
 * @property int $matr_reserv_id
 * @property string|null $docu_id
 * @property string|null $is_subido
 *
 * @property TramdocMatriculaReserv $matrReserv
 * @property Documentos $docu
 */
class TramdocFilesReserv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tramdoc_files_reserv}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matr_reserv_id'], 'required'],
            [['matr_reserv_id'], 'integer'],
            [['docu_id'], 'string', 'max' => 3],
            [['is_subido'], 'string', 'max' => 1],
            [['matr_reserv_id'], 'exist', 'skipOnError' => true, 'targetClass' => TramdocMatriculaReserv::className(), 'targetAttribute' => ['matr_reserv_id' => 'id']],
            [['docu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['docu_id' => 'codocu']],
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
            'docu_id' => Yii::t('base_labels', 'Docu ID'),
            'is_subido' => Yii::t('base_labels', 'Is Subido'),
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
     * Gets query for [[Docu]].
     *
     * @return \yii\db\ActiveQuery|DocumentosQuery
     */
    public function getDocu()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'docu_id']);
    }

    /**
     * {@inheritdoc}
     * @return TramdocFilesReservQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TramdocFilesReservQuery(get_called_class());
    }
}
