<?php

namespace common\models\masters;
use frontend\modules\repositorio\models\RepoVwAsesoresAsignados;
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
    
    
    
    
    public function validateCantidadAsesorados($attribute, $params) {
        $carrera_id=$this->matricula->alumno->carrera_id;
        $curso_id=$this->matricula->curso_id;
        $seccion=$this->matricula->seccion;
        
        //$docente=$this->asesor->persona->identidad;
        if(DocenteCursoSeccion::find()->andWhere([
            'seccion'=>$seccion,
            'docente_id'=>$this->asesor->persona->identidad,
             'curso_id'=>$curso_id,
        ])->exists()){
            $this->addError('asesor_id',yii::t('base_errors','This advisor is not register in course {curso} and seccion {seccion}',['seccion'=>$seccion,'curso'=>$this->matricula->curso->descripcion]));
             return ;
        }
        
        
        $nasesorados=$this->asesor->nAsesoradosPorCursoSeccion(
                $curso_id,
                $seccion,
                $carrera_id);
         $nmat= Matricula::nMatriculados(null,$curso_id, $seccion);
       
        if($carrera_id==Carreras::ID_CARRERA_COMUNICACIONES){
            $namx=$nmat;
          }else{
            $namx=floor($nmat/2)+1;
        }
        
        
        if($nasesorados > $namx){
            $this->addError('asesor_id',yii::t('base_errors','This advisor exceeds the maximum number of students {nmaximo} in {escuela}',['nmaximo'=>$namx,$this->matricula->alumno->carrera->nombre]));
        }
        
        
      }
    
    
}
