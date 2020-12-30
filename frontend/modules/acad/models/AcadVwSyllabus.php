<?php

namespace frontend\modules\acad\models;

use Yii;

/**
 * This is the model class for table "{{%acad_vw_syllabus}}".
 *
 * @property int $id
 * @property int $plan_id
 * @property string $codperiodo
 * @property int $curso_id
 * @property int|null $n_horasindep
 * @property int $docente_owner_id
 * @property string|null $datos_generales
 * @property string|null $sumilla
 * @property string|null $competencias
 * @property string|null $prog_contenidos
 * @property string|null $estrat_metod
 * @property string|null $recursos_didac
 * @property int $formula_id
 * @property string|null $fuentes_info
 * @property string|null $reserva1
 * @property string|null $reserva2
 * @property int|null $n_sesiones_semana
 * @property int|null $n_semanas
 * @property string|null $formula_txt
 * @property string|null $codocu
 * @property string|null $codestado
 * @property string|null $codcur
 * @property string|null $descripcion
 * @property string $codcursocorto
 * @property int $carrera_id
 * @property string|null $codesp
 * @property string $nombre
 * @property string|null $ap
 * @property string|null $am
 * @property string|null $nombres
 * @property string|null $tipodoc
 * @property string|null $numerodoc
 * @property string $codoce
 */
class AcadVwSyllabus extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_vw_syllabus}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'plan_id', 'curso_id', 'n_horasindep', 'docente_owner_id', 'formula_id', 'n_sesiones_semana', 'n_semanas', 'carrera_id'], 'integer'],
            [['plan_id', 'codperiodo', 'curso_id', 'docente_owner_id', 'formula_id', 'codcursocorto', 'carrera_id', 'nombre', 'codoce'], 'required'],
            [['datos_generales', 'sumilla', 'competencias', 'prog_contenidos', 'estrat_metod', 'recursos_didac', 'fuentes_info', 'reserva1', 'reserva2', 'formula_txt'], 'string'],
            [['codperiodo', 'codcursocorto'], 'string', 'max' => 10],
            [['codocu'], 'string', 'max' => 3],
            [['codestado', 'tipodoc'], 'string', 'max' => 2],
            [['codcur'], 'string', 'max' => 18],
            [['descripcion', 'ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['codesp'], 'string', 'max' => 8],
            [['nombre'], 'string', 'max' => 60],
            [['numerodoc'], 'string', 'max' => 20],
            [['codoce'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'plan_id' => Yii::t('app', 'Plan ID'),
            'codperiodo' => Yii::t('app', 'Codperiodo'),
            'curso_id' => Yii::t('app', 'Curso ID'),
            'n_horasindep' => Yii::t('app', 'N Horasindep'),
            'docente_owner_id' => Yii::t('app', 'Docente Owner ID'),
            'datos_generales' => Yii::t('app', 'Datos Generales'),
            'sumilla' => Yii::t('app', 'Sumilla'),
            'competencias' => Yii::t('app', 'Competencias'),
            'prog_contenidos' => Yii::t('app', 'Prog Contenidos'),
            'estrat_metod' => Yii::t('app', 'Estrat Metod'),
            'recursos_didac' => Yii::t('app', 'Recursos Didac'),
            'formula_id' => Yii::t('app', 'Formula ID'),
            'fuentes_info' => Yii::t('app', 'Fuentes Info'),
            'reserva1' => Yii::t('app', 'Reserva1'),
            'reserva2' => Yii::t('app', 'Reserva2'),
            'n_sesiones_semana' => Yii::t('app', 'N Sesiones Semana'),
            'n_semanas' => Yii::t('app', 'N Semanas'),
            'formula_txt' => Yii::t('app', 'Formula Txt'),
            'codocu' => Yii::t('app', 'Codocu'),
            'codestado' => Yii::t('app', 'Codestado'),
            'codcur' => Yii::t('app', 'Codcur'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'codcursocorto' => Yii::t('app', 'Codcursocorto'),
            'carrera_id' => Yii::t('app', 'Carrera ID'),
            'codesp' => Yii::t('app', 'Codesp'),
            'nombre' => Yii::t('app', 'Nombre'),
            'ap' => Yii::t('app', 'Ap'),
            'am' => Yii::t('app', 'Am'),
            'nombres' => Yii::t('app', 'Nombres'),
            'tipodoc' => Yii::t('app', 'Tipodoc'),
            'numerodoc' => Yii::t('app', 'Numerodoc'),
            'codoce' => Yii::t('app', 'Codoce'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AcadVwSyllabusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadVwSyllabusQuery(get_called_class());
    }
}
