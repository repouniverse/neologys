<?php

namespace frontend\modules\acad\models;
use common\models\masters\Docentes;
use common\models\masters\Personas;
use common\models\masters\CursoArea;
use common\models\masters\Planes;
use Yii;

/**
 * This is the model class for table "{{%acad_curso_area_revisor}}".
 *
 * @property int $id
 * @property int $curso_area_id
 * @property int $docente_revisor_id
 * @property int $docente_responsable_id
 * @property int $persona_asesor_ugai_id
 * @property int $persona_corrector_id
 * @property int $persona_director_escuela_id
 * @property int $plan_id
 *
 * @property Persona $personaAsesorUgai
 * @property Docente $docenteRevisor
 * @property Docente $docenteResponsable
 * @property CursoArea $cursoArea
 * @property Persona $personaDirectorEscuela
 * @property Persona $personaCorrector
 * @property Plane $plan
 */
class AcadCursoAreaRevisor extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_curso_area_revisor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['curso_area_id', 'docente_revisor_id', 'docente_responsable_id', 'persona_asesor_ugai_id', 'persona_corrector_id', 'persona_director_escuela_id', 'plan_id'], 'required'],
            [['curso_area_id', 'docente_revisor_id', 'docente_responsable_id', 'persona_asesor_ugai_id', 'persona_corrector_id', 'persona_director_escuela_id', 'plan_id'], 'integer'],
            [['persona_asesor_ugai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_asesor_ugai_id' => 'id']],
            [['docente_revisor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::className(), 'targetAttribute' => ['docente_revisor_id' => 'id']],
            [['docente_responsable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::className(), 'targetAttribute' => ['docente_responsable_id' => 'id']],
            [['curso_area_id'], 'exist', 'skipOnError' => true, 'targetClass' => CursoArea::className(), 'targetAttribute' => ['curso_area_id' => 'id']],
            [['persona_director_escuela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_director_escuela_id' => 'id']],
            [['persona_corrector_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_corrector_id' => 'id']],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planes::className(), 'targetAttribute' => ['plan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'curso_area_id' => 'Curso Area ID',
            'docente_revisor_id' => 'Docente Revisor ID',
            'docente_responsable_id' => 'Docente Responsable ID',
            'persona_asesor_ugai_id' => 'Persona Asesor Ugai ID',
            'persona_corrector_id' => 'Persona Corrector ID',
            'persona_director_escuela_id' => 'Persona Director Escuela ID',
            'plan_id' => 'Plan ID',
        ];
    }

    /**
     * Gets query for [[PersonaAsesorUgai]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaAsesorUgai()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_asesor_ugai_id']);
    }

    /**
     * Gets query for [[DocenteRevisor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocenteRevisor()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'docente_revisor_id']);
    }

    /**
     * Gets query for [[DocenteResponsable]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocenteResponsable()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'docente_responsable_id']);
    }

    /**
     * Gets query for [[CursoArea]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursoArea()
    {
        return $this->hasOne(CursoArea::className(), ['id' => 'curso_area_id']);
    }

    /**
     * Gets query for [[PersonaDirectorEscuela]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaDirectorEscuela()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_director_escuela_id']);
    }

    /**
     * Gets query for [[PersonaCorrector]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaCorrector()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_corrector_id']);
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlan() 
    {
        return $this->hasOne(Planes::className(), ['id' => 'plan_id']);
    }
}
