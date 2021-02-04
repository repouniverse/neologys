<?php

namespace frontend\modules\tramdoc\models;
use \common\models\base\modelBase;
use Yii;

/**
 * This is the model class for table "{{%tramdoc_auditoria}}".
 *
 * @property int $id
 * @property int $matr_id
 * @property int|null $persona_id
 * @property string|null $campo_modificado
 * @property string|null $valor_modificado
 * @property string|null $fecha_modif
 *
 * @property TramdocMatriculaReacts $matr
 */
class TramdocAuditoria extends modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tramdoc_auditoria}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matr_id'], 'required'],
            [['matr_id', 'persona_id'], 'integer'],
            [['fecha_modif'], 'safe'],
            [['campo_modificado', 'valor_modificado'], 'string', 'max' => 255],
            [['matr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matriculareact::className(), 'targetAttribute' => ['matr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'matr_id' => Yii::t('base_labels', 'Matr ID'),
            'persona_id' => Yii::t('base_labels', 'Persona ID'),
            'campo_modificado' => Yii::t('base_labels', 'Campo Modificado'),
            'valor_modificado' => Yii::t('base_labels', 'Valor Modificado'),
            'fecha_modif' => Yii::t('base_labels', 'Fecha Modif'),
        ];
    }

    /**
     * Gets query for [[Matr]].
     *
     * @return \yii\db\ActiveQuery|TramdocMatriculaReactsQuery
     */
    public function getMatr()
    {
        return $this->hasOne(Matriculareact::className(), ['id' => 'matr_id']);
    }

    /**
     * {@inheritdoc}
     * @return TramdocAuditoriaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TramdocAuditoriaQuery(get_called_class());
    }
}
