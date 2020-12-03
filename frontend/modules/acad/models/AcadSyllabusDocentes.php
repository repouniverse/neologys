<?php

namespace frontend\modules\acad\models;
use common\models\masters\Docentes;
use Yii;

/**
 * This is the model class for table "{{%acad_syllabus_docentes}}".
 *
 * @property int $id
 * @property int $syllabus_id
 * @property int $docente_id
 * @property string|null $activo
 *
 * @property AcadSyllabus $syllabus
 */
class AcadSyllabusDocentes extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_syllabus_docentes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['syllabus_id', 'docente_id'], 'required'],
            [['syllabus_id', 'docente_id'], 'integer'],
            [['activo'], 'string', 'max' => 1],
            [['docente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::className(), 'targetAttribute' => ['docente_id' => 'id']],
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
            'docente_id' => Yii::t('base_labels', 'Docente ID'),
            'activo' => Yii::t('base_labels', 'Activo'),
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
    
    
    public function getDocente()
    {
        return $this->hasOne(Docente::className(), ['id' => 'docente_id']);
    }

    /**
     * {@inheritdoc}
     * @return AcadSyllabusDocentesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadSyllabusDocentesQuery(get_called_class());
    }
}
