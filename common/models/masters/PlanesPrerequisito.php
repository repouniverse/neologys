<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%planes_prerequisito}}".
 *
 * @property int $id
 * @property int $plan_id
 * @property string $codcursocorto
 * @property string|null $activo
 *
 * @property PlanesEstudio $plan
 */
class PlanesPrerequisito extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%planes_prerequisito}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_id', 'codcursocorto'], 'required'],
            [['plan_id'], 'integer'],
            [['codcursocorto'], 'string', 'max' => 25],
            [['plan_id','codcursocorto','activo'], 'unique'],
            [['activo'], 'string', 'max' => 1],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanesEstudio::className(), 'targetAttribute' => ['plan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'plan_id' => Yii::t('base_labels', 'Plan ID'),
            'codcursocorto' => Yii::t('base_labels', 'Codcursocorto'),
            'activo' => Yii::t('base_labels', 'Activo'),
        ];
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery|PlanesEstudioQuery
     */
    public function getPlan()
    {
        return $this->hasOne(PlanesEstudio::className(), ['id' => 'plan_id']);
    }

    /**
     * {@inheritdoc}
     * @return PlanesPrerequisitoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanesPrerequisitoQuery(get_called_class());
    }
}
