<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%planes}}".
 *
 * @property int $id
 * @property string $codperiodo
 * @property string $descripcion
 * @property int $carrera_id
 * @property string|null $activo
 *
 * @property Periodos $codperiodo0
 * @property Carreras $carrera
 */
class Planes extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%planes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codperiodo', 'descripcion', 'carrera_id'], 'required'],
            [['carrera_id'], 'integer'],
            [['codperiodo'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 60],
            [['activo'], 'string', 'max' => 1],
            [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
            [['carrera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['carrera_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'codperiodo' => Yii::t('base_labels', 'Codperiodo'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'carrera_id' => Yii::t('base_labels', 'Carrera ID'),
            'activo' => Yii::t('base_labels', 'Activo'),
        ];
    }

    /**
     * Gets query for [[Codperiodo0]].
     *
     * @return \yii\db\ActiveQuery|PeriodosQuery
     */
    public function getCodperiodo0()
    {
        return $this->hasOne(Periodos::className(), ['codperiodo' => 'codperiodo']);
    }

    /**
     * Gets query for [[Carrera]].
     *
     * @return \yii\db\ActiveQuery|CarrerasQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(Carreras::className(), ['id' => 'carrera_id']);
    }

    /**
     * {@inheritdoc}
     * @return PlanesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanesQuery(get_called_class());
    }
}
