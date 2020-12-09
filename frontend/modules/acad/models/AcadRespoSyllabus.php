<?php

namespace frontend\modules\acad\models;
use common\models\masters\PlanesEstudio;
use common\models\masters\Docentes;
use Yii;

/**
 * This is the model class for table "{{%acad_responsables_syllabus}}".
 *
 * @property int $id
 * @property int $docente_id
 * @property int $plan_estudio_id
 *
 * @property Docentes $docente
 * @property PlanesEstudio $planEstudio
 */
class AcadRespoSyllabus extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_responsables_syllabus}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['docente_id', 'plan_estudio_id'], 'required'],
            [['docente_id', 'plan_estudio_id'], 'integer'],
             [['docente_id', 'plan_estudio_id'],'unique', 'targetAttribute' => ['docente_id', 'plan_estudio_id']],
            [['docente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::className(), 'targetAttribute' => ['docente_id' => 'id']],
            [['plan_estudio_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanesEstudio::className(), 'targetAttribute' => ['plan_estudio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'docente_id' => Yii::t('base_labels', 'Docente ID'),
            'plan_estudio_id' => Yii::t('base_labels', 'Plan Estudio ID'),
        ];
    }

    /**
     * Gets query for [[Docente]].
     *
     * @return \yii\db\ActiveQuery|DocentesQuery
     */
    public function getDocente()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'docente_id']);
    }

    /**
     * Gets query for [[PlanEstudio]].
     *
     * @return \yii\db\ActiveQuery|PlanesEstudioQuery
     */
    public function getPlanEstudio()
    {
        return $this->hasOne(PlanesEstudio::className(), ['id' => 'plan_estudio_id']);
    }

    /**
     * {@inheritdoc}
     * @return AcadRespoSyllabusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadRespoSyllabusQuery(get_called_class());
    }
    
    public function SyllabusExists(){
        return AcadSyllabus::find()->andWhere(['plan_id'=>$this->docente_id,'docente_owner_id'=>$this->plan_estudio_id])->exists();
    }
}
