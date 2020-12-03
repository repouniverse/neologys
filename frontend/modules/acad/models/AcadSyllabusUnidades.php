<?php

namespace frontend\modules\acad\models;

use Yii;

/**
 * This is the model class for table "{{%acad_syllabus_unidades}}".
 *
 * @property int $id
 * @property int $syllabus_id
 * @property string|null $descripcion
 * @property string|null $capacidad
 * @property string|null $comentarios
 *
 * @property AcadSyllabus $syllabus
 */
class AcadSyllabusUnidades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_syllabus_unidades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['syllabus_id'], 'required'],
            [['syllabus_id'], 'integer'],
            [['capacidad', 'comentarios'], 'string'],
            [['descripcion'], 'string', 'max' => 80],
            [['syllabus_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadSyllabus::className(), 'targetAttribute' => ['syllabus_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'syllabus_id' => Yii::t('base_labels', 'Syllabus ID'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'capacidad' => Yii::t('base_labels', 'Capacidad'),
            'comentarios' => Yii::t('base_labels', 'Comentarios'),
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
     * {@inheritdoc}
     * @return AcadSyllabusUnidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadSyllabusUnidadesQuery(get_called_class());
    }
}
