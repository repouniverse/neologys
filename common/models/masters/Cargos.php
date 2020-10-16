<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%cargos}}".
 *
 * @property int $id
 * @property int $depa_id
 * @property string $descargo
 * @property string|null $detalle
 *
 * @property Departamentos $depa
 */
class Cargos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cargos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['depa_id', 'descargo'], 'required'],
            [['depa_id'], 'integer'],
            [['detalle'], 'string'],
            [['descargo'], 'string', 'max' => 40],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'depa_id' => Yii::t('base_labels', 'Id Area'),
            'descargo' => Yii::t('base_labels', 'Discharge'),
            'detalle' => Yii::t('base_labels', 'Detail'),
        ];
    }

    /**
     * Gets query for [[Depa]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepa()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'depa_id']);
    }

    /**
     * {@inheritdoc}
     * @return CargosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CargosQuery(get_called_class());
    }
}
