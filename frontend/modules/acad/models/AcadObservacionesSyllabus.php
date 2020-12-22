<?php

namespace frontend\modules\acad\models;

use Yii;

/**
 * This is the model class for table "{{%acad_observaciones_syllabus}}".
 *
 * @property int $id
 * @property int $flujo_syllabus_id
 * @property int $syllabus_id
 * @property string|null $seccion
 * @property string|null $observacion
 * @property string|null $fecha
 *
 * @property AcadSyllabus $syllabus
 * @property AcadTramiteSyllabus $flujoSyllabus
 */
class AcadObservacionesSyllabus extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_observaciones_syllabus}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flujo_syllabus_id', 'syllabus_id'], 'required'],
            [['flujo_syllabus_id', 'syllabus_id'], 'integer'],
            [['observacion'], 'string'],
            [['seccion'], 'string', 'max' => 40],
            [['fecha'], 'string', 'max' => 19],
            [['syllabus_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadSyllabus::className(), 'targetAttribute' => ['syllabus_id' => 'id']],
            [['flujo_syllabus_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadTramiteSyllabus::className(), 'targetAttribute' => ['flujo_syllabus_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'flujo_syllabus_id' => Yii::t('app', 'Flujo Syllabus ID'),
            'syllabus_id' => Yii::t('app', 'Syllabus ID'),
            'seccion' => Yii::t('app', 'Seccion'),
            'observacion' => Yii::t('app', 'Observacion'),
            'fecha' => Yii::t('app', 'Fecha'),
        ];
    }

    /**
     * Gets query for [[Syllabus]].
     *
     * @return \yii\db\ActiveQuery|AcadSyllabusQuery
     */
    public function getSyllabus()
    {
        return $this->hasOne(AcadSyllabus::className(), ['id' => 'syllabus_id']);
    }

    /**
     * Gets query for [[FlujoSyllabus]].
     *
     * @return \yii\db\ActiveQuery|AcadTramiteSyllabusQuery
     */
    public function getFlujoSyllabus()
    {
        return $this->hasOne(AcadTramiteSyllabus::className(), ['id' => 'flujo_syllabus_id']);
    }

    /**
     * {@inheritdoc}
     * @return AcadObservacionesSyllabusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadObservacionesSyllabusQuery(get_called_class());
    }
}
