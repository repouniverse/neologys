<?php

namespace common\models\masters;
use frontend\modules\repositorio\models\RepoVwAsesoresAsignados;
use common\helpers\h;
use frontend\modules\repositorio\models\RepositorioAsesoresCursoDocs;
use Yii;

/**
 * This is the model class for table "asesores".
 *
 * @property int $id
 * @property int $matricula_id
 * @property int $alumno_id
 * @property int|null $persona_id
 * @property string|null $activo
 */
class AsesoresCurso extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    
    
    
    public static function tableName()
    {
        return '{{%asesores_curso}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matricula_id', 'alumno_id'], 'required'],
            [['matricula_id', 'alumno_id', 'asesor_id'], 'integer'],
            /*
             * Agregar restriccion a un nuevo campo codperioso,
             * se hara mas adelante 25/11/2020
             */
             [ 'asesor_id', 'unique', 'targetAttribute' => 
                 ['matricula_id', 'alumno_id'],'message'=>yii::t('base_errors','You already have an assigned advisor in this course -section, you cannot enter a new one.'),
              ],
           [['asesor_id'], 'validateCantidadAsesorados'],
            [['activo'], 'string', 'max' => 1],
             [['alumno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::className(), 'targetAttribute' => ['alumno_id' => 'id']],
             [['asesor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asesores::className(), 'targetAttribute' => ['asesor_id' => 'id']],
            [['matricula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matricula::className(), 'targetAttribute' => ['matricula_id' => 'id']],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'matricula_id' => Yii::t('app', 'Matricula ID'),
            'alumno_id' => Yii::t('app', 'Alumno ID'),
            'asesor_id' => Yii::t('app', 'Persona ID'),
            'activo' => Yii::t('app', 'Activo'),
        ];
    }

    public function getAlumno()
    {
        return $this->hasOne(Alumnos::className(), ['id' => 'alumno_id']);
    }

    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'asesor_id']);
    }

    public function getMatricula()
    {
        return $this->hasOne(Matricula::className(), ['id' => 'matricula_id']);
    }
    
    public function getAsesor()
    {
        return $this->hasOne(Asesores::className(), ['id' => 'asesor_id']);
    }

    /**
     * {@inheritdoc}
     * @return AsesoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsesoresCursoQuery(get_called_class());
    }
    
    private function prepareParams(){
        return [
               
                'curso_id'=>$this->matricula->curso_id,
                'seccion'=>$this->matricula->seccion,
             'carrera_id'=>$this->matricula->alumno->carrera_id,
                'matricula_id'=>$this->matricula->id
               ];
    }
    
    
    public function isDispose(){
        return ($this->asesor->porcentajeSaturacion(
        array_values($this->prepareParams()))< h::gsetting('repositorio', 'porcMaxSatAsesor'))?true:false ;
    }
    
    
    public function validateCantidadAsesorados($attribute, $params) {       
        
        $nmax=$this->asesor->nMaxAsesoradosPorCursoSeccionMatricula(array_values($this->prepareParams()));
        $nstudents=$this->asesor->nAsesoradosPorCursoSeccionCarreraMatricula(array_values($this->prepareParams()));
           //  yii::error(' numero asesorados '.$nstudents,__FUNCTION__);
           // yii::error(' numero maximo '.$nmax,__FUNCTION__);
            
        
        if(!$this->isDispose()){
            
            $this->addError('asesor_id',yii::t('base_errors','This advisor has {nstudents} students,but exceeds the maximum number {nmax} of students',['nmax'=>$nmax,'nstudents'=>$nstudents]));
        }
        
        
      }
      
      
    
    
}
