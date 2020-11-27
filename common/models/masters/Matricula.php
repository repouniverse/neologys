<?php

namespace common\models\masters;
use common\helpers\h;
use Yii;

/**
 * This is the model class for table "matricula".
 *
 * @property int $id
 * @property int $curso_id
 * @property int $alumno_id
 * @property string|null $seccion
 * @property string $periodo
 * @property string|null $activo
 */

class Matricula extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */

        const SCE_IMPORTACION='importacion_basica';

    public static function tableName()
    {
        return 'matricula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['curso_id', 'alumno_id', 'seccion','periodo'], 'required'],
            [['curso_id', 'alumno_id'], 'integer'],
            [['seccion'], 'string', 'max' => 12],
             [['seccion'], 'safe'],
            [['periodo'], 'string', 'max' => 10],
            [['activo'], 'string', 'max' => 1],
        [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::className(), 'targetAttribute' => ['curso_id' => 'id']],
        [['alumno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::className(), 'targetAttribute' => ['alumno_id' => 'id']],
        [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
        ];


    }

    public function scenarios() {

        $scenarios = parent::scenarios();
        $scenarios[self::SCE_IMPORTACION] = [
           'curso_id', 'alumno_id','seccion','periodo', 'activo'
            ];
        
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'curso_id' => Yii::t('app', 'Curso ID'),
            'alumno_id' => Yii::t('app', 'Alumno ID'),
            'seccion' => Yii::t('app', 'Seccion'),
            'periodo' => Yii::t('app', 'Periodo'),
            'activo' => Yii::t('app', 'Activo'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MatriculaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MatriculaQuery(get_called_class());
    }

    public function getCurso()
    {
        return $this->hasOne(Cursos::className(), ['id' => 'curso_id']);
    }

    public function getAlumno()
    {
        return $this->hasOne(Alumnos::className(), ['id' => 'alumno_id']);
    }

    public function getPeriodo()
    {
        return $this->hasOne(Periodos::className(), ['codperiodo' => 'codperiodo']);
    }

    public function getAsesorCurso()
    {
        return $this->hasOne(AsesoresCurso::className(), ['matricula_id' => 'id']);
    }
    
    public static function nMatriculados($codperiodo=null,$curso_id=null,$codseccion=null){
       if(is_null($codperiodo))
       $codperiodo=h::periodos()->getCurrentPeriod();
       $query= static::find()->andWhere(['periodo'=>$codperiodo]);
       $query->andFilterWhere(['curso_id'=>$curso_id,'seccion'=>$codseccion]);
       /*if(!is_null($curso_id))
         $query=$query->andWhere(['curso_id'=>$curso_id]);
       if(!is_null($codseccion))
         $query=$query->andWhere(['seccion'=>$codseccion]);*/  
       ECHO $query->createCommand()->rawSql;die();
       return $query->count();
    }
    
    public function hasAssesor(){
       return  AsesoresCurso::find()->andWhere(['matricula_id'=>$this->id])->exists();
    }

}
