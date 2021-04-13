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
    
    private function  queryAsesorados($params){
        return RepoVwAsesoresAsignados::find()->andFilterWhere([
            'asesor_id'=>$this->id,
            'curso_id'=>$params[0],
             'seccion'=>$params[1],
            'carrera_id'=>$params[2],
            'periodo'=>$params[4],
           // 'matricula_id'=>$params[3],
        ]);
    }
    
    
    public  function nAsesoradosPorCursoSeccionCarreraMatricula($params){
        yii::error('SQL DE asesorados  ',__FUNCTION__);
       yii::error($this->queryAsesorados($params)->createCommand()->rawSql,__FUNCTION__);
        yii::error('CONTANDO HAY '.$this->queryAsesorados($params)->count(),__FUNCTION__);
        
       return  $this->queryAsesorados($params)->count();        
       //return Matricula::nMatriculados($codperiodo, $curso_id, $codseccion);
        
    }
    
    public  function isAsesorFromCursoSeccionCarreraMatricula($params){
       return $this->queryAsesorados($params)->exists();        
       //return Matricula::nMatriculados($codperiodo, $curso_id, $codseccion);
        
    }
    
     public static function nMaxAsesoradosPorCursoSeccionMatricula($params){
         
         $nmat= Matricula::nMatriculados(/*periodo*/ $params[4],/*curso_id*/$params[0],/*seccion*/ $params[1]);         
           if(/*carrera_id*/$params[2]==Carreras::ID_CARRERA_COMUNICACIONES
                or in_array($params[0],[65,126])){//Refactorizar 
                    $namx=$nmat;
                }else{
                   
                        $namx=floor($nmat/2)+1;
                }  
       return $namx;
       }
    
   
     public function porcentajeSaturacion($params){
         
             $nasesorados=$this->nAsesoradosPorCursoSeccionCarreraMatricula($params);
             $nmax=$this->nMaxAsesoradosPorCursoSeccionMatricula($params);             
         if($nmax>0)return round($nasesorados/$nmax,2)*100;
         return 0;
     }
     
     
     
   
}
