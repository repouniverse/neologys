<?php

namespace frontend\modules\acad\models;
use common\models\masters\Cursos;
use common\models\masters\Docentes;
use common\models\masters\Personas;
use common\models\masters\PlanesEstudio;
use common\helpers\h;
use common\behaviors\FileBehavior;
use Yii;

/**
 * This is the model class for table "{{%acad_syllabus}}".
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
 *
 * @property AcadContenidoSyllabus[] $acadContenidoSyllabi
 * @property PlanesEstudio $plan
 * @property Cursos $curso
 * @property Docentes $curso0
 * @property AcadSyllabusDocentes[] $acadSyllabusDocentes
 * @property AcadSyllabusUnidades[] $acadSyllabusUnidades
 */
class AcadSyllabus extends \common\models\base\modelBase
{
    
    const SCE_CREACION_BASICA='basico';
    const BLOQUE_CAPACIDADES='Capacidades';
    const CODIGO_DOCUMENTO='500';
    const ESTADO_CREADO='10';
    const ESTADO_ANULADO='99';
    const  APROB_DOCENTE_AREA='Teacher review';
    const  APROB_ASESOR_UGAI='Advisor';
     const APROB_CORRECTOR='Style corrector';
     const APROB_DIRECTOR_ESCUELA='Director academic';
    const APROB_DOCENTE_OWNER='Owner';
    public $estados=[
        self::ESTADO_ANULADO,
        self::ESTADO_CREADO];
    
   public $flujo=[
        0=>self::APROB_DOCENTE_OWNER,
        1=>self::APROB_DOCENTE_AREA,
       2=>self::APROB_ASESOR_UGAI, 
        3=>self::APROB_CORRECTOR,
        4=>self::APROB_DIRECTOR_ESCUELA,
   ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_syllabus}}';
    }
    
    
     public function behaviors() {
        return [            
            'fileBehavior' => [
                'class' => FileBehavior::className()
            ],
               ];
      }
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_id', 'codperiodo', 'curso_id', 'docente_owner_id', 'formula_id','n_semanas'], 'required'],
            [['plan_id', 'curso_id', 'n_horasindep', 'docente_owner_id', 'formula_id','n_sesiones_semana'], 'integer'],
            [['datos_generales', 'sumilla', 'competencias', 'prog_contenidos', 'estrat_metod', 'recursos_didac', 'fuentes_info', 'reserva1', 'reserva2'], 'string'],
           [['docente_owner_id','plan_id'], 'unique','targetAttribute'=>['docente_owner_id','plan_id']],
            [['codperiodo'], 'string', 'max' => 10],   
            [  ['n_sesiones_semana','formula_txt',
                'n_semanas','codocu','codestado','descripcion','codocu'
                ], 'safe'],   
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanesEstudio::className(), 'targetAttribute' => ['plan_id' => 'id']],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::className(), 'targetAttribute' => ['curso_id' => 'id']],
            [['docente_owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::className(), 'targetAttribute' => ['docente_owner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'plan_id' => Yii::t('base_labels', 'Plan ID'),
            'codperiodo' => Yii::t('base_labels', 'Codperiodo'),
            'curso_id' => Yii::t('base_labels', 'Curso ID'),
            'n_horasindep' => Yii::t('base_labels', 'N Horasindep'),
            'docente_owner_id' => Yii::t('base_labels', 'Docente Owner ID'),
            'datos_generales' => Yii::t('base_labels', 'Datos Generales'),
            'sumilla' => Yii::t('base_labels', 'Sumilla'),
            'competencias' => Yii::t('base_labels', 'Competencias'),
            'prog_contenidos' => Yii::t('base_labels', 'Prog Contenidos'),
            'estrat_metod' => Yii::t('base_labels', 'Estrat Metod'),
            'recursos_didac' => Yii::t('base_labels', 'Recursos Didac'),
            'formula_id' => Yii::t('base_labels', 'Formula ID'),
            'fuentes_info' => Yii::t('base_labels', 'Fuentes Info'),
            'reserva1' => Yii::t('base_labels', 'Evaluation'),
            'reserva2' => Yii::t('base_labels', 'Reserva2'),
        ];
    }

    
     public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios[self::SCE_CREACION_BASICA] = ['plan_id', 'codperiodo', 'curso_id', 'docente_owner_id', 'formula_id'];
       return $scenarios;
    }
    
    /**
     * Gets query for [[AcadContenidoSyllabi]].
     *
     * @return \yii\db\ActiveQuery|AcadContenidoSyllabusQuery
     */
    public function getAcadContenidoSyllabus()
    {
        return $this->hasMany(AcadContenidoSyllabus::className(), ['syllabus_id' => 'id']);
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery|PlanesEstudioQuery
     */
    public function getPlan()
    {
        return $this->hasOne(PlanesEstudio::className(), ['id' => 'plan_id']);
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery|CursosQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Cursos::className(), ['id' => 'curso_id']);
    }

    /**
     * Gets query for [[Curso0]].
     *
     * @return \yii\db\ActiveQuery|DocentesQuery
     */
    public function getDocenteOwner()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'docente_owner_id']);
    }

    /**
     * Gets query for [[AcadSyllabusDocentes]].
     *
     * @return \yii\db\ActiveQuery|AcadSyllabusDocentesQuery
     */
    public function getSyllabusDocentes()
    {
        return $this->hasMany(AcadSyllabusDocentes::className(), ['syllabus_id' => 'id']);
    }
   
    
    /**
     * Gets query for [[AcadSyllabusUnidades]].
     *
     * @return \yii\db\ActiveQuery|AcadSyllabusUnidadesQuery
     */
    public function getSyllabusUnidades()
    {
        return $this->hasMany(AcadSyllabusUnidades::className(), ['syllabus_id' => 'id']);
    }
    
     public function getSyllabusCompetencias()
    {
        return $this->hasMany(AcadSyllabusCompetencias::className(), ['syllabus_id' => 'id']);
    }
    
    
     public function getObservaciones()
    {
        return $this->hasMany(AcadObservacionesSyllabus::className(), ['syllabus_id' => 'id']);
    }
    
    public function getFlujos()
    {
        return $this->hasMany(AcadTramiteSyllabus::className(), ['docu_id' => 'id']);
    }
    
  
    
    /**
     * {@inheritdoc}
     * @return AcadSyllabusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadSyllabusQuery(get_called_class());
    }
    
    public function beforeSave($insert){
        $this->codocu=self::CODIGO_DOCUMENTO;
        $this->codestado=self::ESTADO_CREADO;
      return parent::beforeSave($insert);  
    }
    
    public function afterSave($insert, $changedAttributes) {
        // yii::error(' disparador lanza ',__FUNCTION__);
       if($insert){          
           $this->fillCompetencias();
           $this->generateFlowAprove();
       }else{
           if(in_array('n_sesiones_semana',array_keys($changedAttributes))){
               
           }
       }
        return parent::afterSave($insert, $changedAttributes);
    }
    
    private function fillCompetencias(){
        $arrayDatos=[
            ['syllabus_id'=>$this->id,'bloque_padre'=>'Competencias','item_bloque'=>'3.1.1','bloque'=>'Genéricas','activo'=>true],
             ['syllabus_id'=>$this->id,'bloque_padre'=>'Competencias','item_bloque'=>'3.1.2','bloque'=>'Específicas','activo'=>true], 
           ['syllabus_id'=>$this->id,'bloque_padre'=>'Componentes','item_bloque'=>'3.2.1','bloque'=>self::BLOQUE_CAPACIDADES,'activo'=>true], 
            ['syllabus_id'=>$this->id,'bloque_padre'=>'Componentes','item_bloque'=>'3.2.2','bloque'=>'Actitudes y valores','activo'=>true], 
        ];
        foreach($arrayDatos as $fila){
            yii::error($fila);
            AcadSyllabusCompetencias::firstOrCreateStatic($fila);
        }
        
    }
    
   public function refreshCapacidades(){
      $filaACambiar=$this->getSyllabusCompetencias()->andWhere(['bloque'=>self::BLOQUE_CAPACIDADES])->one();
     
       if(!is_null($filaACambiar)){
          //if(empty($filaACambiar->contenido_bloque)){
           $arrayCapacidades=$this->getSyllabusUnidades()->select(['capacidad'])->column();
            $filaACambiar->contenido_bloque='';
            foreach($arrayCapacidades as $valorTexto){
            $filaACambiar->contenido_bloque.=$valorTexto."\n";
            } 
         //} 
          return   $filaACambiar->save();
       }
       return false;
   }
   
   /*
    * Genera el contenido de la sección PROGRAMACION DE CONTENIDOS de
    * la estructura general del Syllabus, está en función del numero de
    * de sesiones por semana
    */
   public function generateContenidoSyllabus(){
      foreach($this->acadContenidoSyllabus as $unidad){
        $unidad->generateContenidoSyllabusByUnidad();          
      }
   }
   
   
  public function concatNames(){
      $fullNames='';
      foreach($this->syllabusDocentes as $docente){
          $fullNames.=','.$docente->docente->fullName(true);
      }
      return substr($fullNames,1);
  }
  
  
  public function concatPreRequisites(){
      $fullNames='';
      //yii::error();
      $plan=$this->plan;
      foreach($plan->planesPrereq as $prereq){
         /* yii::error('la tabla prerequisito es ');
          yii::error($prereq->tableName());
          yii::error('El pla_id de prerequisito es  '.$prereq->plan_id);
           yii::error('Esta jalando el codigo del curso   '.$prereq->plan->codcursocorto);
          */ //yii::error('El id de prerequisito es  '.$prereq->id);
          $fullNames.=','.$prereq->codcursocorto;
      }
      return substr($fullNames,1);
  }
  
  /*
   * Genera un flujo de aprobación*/
   
  public function generateFlowAprove(){
    foreach($this->flujo as $orden=>$valor){
        $fecha=($orden==0)?self::SwichtFormatDate(
                self::CarbonNow()->format(\common\helpers\timeHelper::formatMysqlDateTime()),
                'datetime',true):'';
        yii::error('adadda');
        yii::error($fecha);
        yii::error($orden);
        AcadTramiteSyllabus::firstOrCreateStatic(
              [
                  'codocu'=>self::CODIGO_DOCUMENTO,
                    'docu_id'=>$this->id, 
                    'orden'=>$orden,
                  'focus'=>($orden==0)?true:false,
                   'aprobado'=>'0',
                   'fecha_recibido'=>$fecha,
                    'user_id'=>$this->resolveUserFlujo($orden),
                     'descripcion'=>yii::t('base_labels',$valor),
                  ],
              null,
             [
               'codocu'=>self::CODIGO_DOCUMENTO,
               'docu_id'=>$this->id, 
                'orden'=>$orden,
                 ]
             );
    }
      
  }
   
  private function resolveUserFlujo(int $orden){
      yii::error("plan id");
      yii::error($this->plan_id);

      $model_revision= AcadCursoAreaRevisor::findByPlanId($this->plan_id);
      
      if(is_null($model_revision)){
          $user_id=Docentes::findOne ($this->docente_owner_id)->persona->profile->user_id; 
          yii::error("si entra al null");
          yii::error($user_id);
          return $user_id;
      } 
      if($orden==0){
          //var_dump($this->docente_owner_id);die();
          //echo $this->docente_owner_id;
          
        $user_id=Docentes::findOne ($this->docente_owner_id)->persona->profile->user_id;  
      }elseif($orden==1){
          //$model_revision->docente_responsable_id;
          
          //echo $model_revision->docente_responsable_id;
          $user_id= Docentes::findOne($model_revision->docente_responsable_id)->persona->profile->user->id;
          
      }
      elseif($orden==2){
          
          $user_id= Personas::findOne($model_revision->persona_asesor_ugai_id)->profile->user->id;
          
         //echo $model_revision->persona_asesor_ugai_id;
      }elseif($orden==3){
          
          $user_id= Personas::findOne($model_revision->persona_corrector_id)->profile->user->id;
         
          //echo $model_revision->persona_corrector_id;
      }elseif($orden==4){
          
          $user_id= Personas::findOne($model_revision->persona_director_escuela_id)->profile->user->id;
          //yii::error("orden 4");
        
          //echo $model_revision->persona_director_escuela_id;
      }else{
          return false;
      }
      return    $user_id; 
     
  }
  
  
  
  public function hasObservaciones(){
      
  return $this->getFlujos()->where(['activo'=>'1'])->exists();
  }
  
  
  public function isAprobed(){
     return  ($this->getFlujos()->count() >0 && !$this->getFlujos()->andWhere(['aprobado'=>'0'])->exists());
  }
  
  public function resolveNameFile(){
      $nameFile=static::CarbonNow()->format(\common\helpers\timeHelper::formatMysqlDateTime());
      $nameFile='SYLLABUS_'.$this->curso->descripcion.'_'.$nameFile.uniqid();
         $nameFile=str_replace( [':',' ','-'],['_','','_'], $nameFile);
       $nameFile= \common\helpers\StringHelper::clearTildes($nameFile);   
      return $nameFile;
  }
  
}
