<?php

namespace frontend\modules\acad\models;
use common\models\masters\Docentes;
use Yii;

/**
 * This is the model class for table "{{%acad_vw_syllabus_curso_doce}}".
 *
 * @property int $id
 * @property int $docente_id
 * @property int $plan_estudio_id
 * @property string|null $ap
 * @property string|null $am
 * @property string|null $nombres
 * @property string|null $tipodoc
 * @property string|null $numerodoc
 * @property string $codoce
 * @property string $codcursocorto
 * @property int $carrera_id
 * @property string|null $codcur
 * @property string|null $descripcion
 * @property string $codperiodo
 * @property string|null $codesp
 * @property string $nombre
 */
class AcadVwSyllabusCursoDoce extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_vw_syllabus_curso_doce}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'docente_id', 'plan_estudio_id', 'carrera_id'], 'integer'],
            [['docente_id', 'plan_estudio_id', 'codoce', 'codcursocorto', 'carrera_id', 'codperiodo', 'nombre'], 'required'],
            [['ap', 'am', 'nombres', 'descripcion'], 'string', 'max' => 40],
            [['tipodoc'], 'string', 'max' => 2],
            [['numerodoc'], 'string', 'max' => 20],
            [['codoce'], 'string', 'max' => 16],
            [['codcursocorto', 'codperiodo'], 'string', 'max' => 10],
            [['codcur'], 'string', 'max' => 18],
            [['codesp'], 'string', 'max' => 8],
            [['nombre'], 'string', 'max' => 60],
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
            'ap' => Yii::t('base_labels', 'Ap'),
            'am' => Yii::t('base_labels', 'Am'),
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'tipodoc' => Yii::t('base_labels', 'Tipodoc'),
            'numerodoc' => Yii::t('base_labels', 'Numerodoc'),
            'codoce' => Yii::t('base_labels', 'Codoce'),
            'codcursocorto' => Yii::t('base_labels', 'Codcursocorto'),
            'carrera_id' => Yii::t('base_labels', 'Carrera ID'),
            'codcur' => Yii::t('base_labels', 'Codcur'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'codperiodo' => Yii::t('base_labels', 'Codperiodo'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'nombre' => Yii::t('base_labels', 'Nombre'),
        ];
    }

     public function getDocente()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'docente_id']);
    }
    
    /**
     * {@inheritdoc}
     * @return AcadVwSyllabusCursoDoceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadVwSyllabusCursoDoceQuery(get_called_class());
    }
}
