<?php

namespace common\models\masters;
use frontend\modules\repositorio\models\RepoVwAsesoresAsignados;
use Yii;

/**
 * This is the model class for table "{{%asesores}}".
 *
 * @property int $id
 * @property int $asesor_id
 * @property int|null $persona_id
 * @property string|null $orcid
 * @property string|null $activo
 */
class Asesores extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */

    const SCE_IMPORTACION='importacion_asesores';

public $booleanFields=['activo'];

    public static function tableName()
    {
        return '{{%asesores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['persona_id'], 'integer'],
            [['orcid'], 'string', 'max' => 250],
            [['activo','docente_id'],'safe'],  
            [['docente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::className(), 'targetAttribute' => ['docente_id' => 'id']],
       
        ];
    }

    public function scenarios() {

        $scenarios = parent::scenarios();
        $scenarios[self::SCE_IMPORTACION] = [
           'asesor_id','persona_id', 'orcid','activo'
            ];
        
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'persona_id' => Yii::t('base_labels', 'Assesor'),
            'orcid' => Yii::t('base_labels', 'ORCID'),
            'activo' => Yii::t('base_labels', 'Active'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AsesoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsesoresQuery(get_called_class());
    }

    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_id']);
    }
    
    
     public function getDocente()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'docente_id']);
    }
    
    
    public function  getAsesorados(){
         return $this->hasMany(AsesoresCurso::className(), ['asesor_id' => 'id']);
    }
    
    public function nAlumnosAsesorados(){
        return $this->getAsesorados()->count();
    }
    
    public static function nAsesoradosPorCursoSeccion($curso_id,$codseccion,$carrera_id){
       return  RepoVwAsesoresAsignados::find()->andFilterWhere([
            'asesor_id'=>$this->id,
            'curso_id'=>$curso_id,
             'seccion'=>$codseccion,
            'carrera_id'=>$carrera_id,
        ])->count();        
       //return Matricula::nMatriculados($codperiodo, $curso_id, $codseccion);
        
    }
    
     public static function nMaxAsesoradosPorCursoSeccion($curso_id,$seccion,$carrera_id){
         $nmat= Matricula::nMatriculados(null,$curso_id, $seccion);         
           if($carrera_id==Carreras::ID_CARRERA_COMUNICACIONES){
                    $namx=$nmat;
                }else{
                        $namx=floor($nmat/2)+1;
                }  
       return $namx;
       }
    
   
     public function porcentajeSaturacion($curso_id,$seccion,$carrera_id){
         $nmax=static::nMaxAsesoradosPorCursoSeccion($curso_id, $seccion, $carrera_id);
         $nasesorados=static::nAsesoradosPorCursoSeccion($curso_id, $codseccion, $carrera_id);
         if($nmax>0)return round($nasesorados/$nmax,2);
         return 0;
     }
   
}
