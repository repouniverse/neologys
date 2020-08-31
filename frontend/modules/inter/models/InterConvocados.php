<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Documentos;
use common\models\masters\Periodos;
use common\models\masters\Carreras;
use common\models\masters\Personas;
use common\models\masters\Alumnos;
use frontend\modules\inter\Module as m;
use frontend\modules\inter\models\InterPlan;
use Yii;

class InterConvocados extends \common\models\base\modelBase
{
    const SCENARIO_CONVOCATORIAMINIMA='convocatoriamin';
    const SCENARIO_FICHA='ficha';
     const SCENARIO_STAGE='etapa';
    const STAGE_UPLOADS=2;
     const CODIGO_DOCUMENTO='115';
    /**
     * {@inheritdoc}
     */
    //public $booleanFields=['asistio','activo'];
    public static function tableName()
    {
        return '{{%inter_convocados}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id'], 'integer'],
            //[['codocu', 'clase', 'status'], 'required'],
            [['codperiodo'], 'string', 'max' => 10],
            [['codocu'], 'string', 'max' => 3],
            [['motivos','depa_id','current_etapa'], 'safe'],
             [['motivos'], 'validateOpUniv','on'=>self::SCENARIO_FICHA],
            [['programa_id','alumno_id'], 'unique', 'targetAttribute' => ['programa_id','alumno_id']],
            [['clase', 'status'], 'string', 'max' => 1],
            [['codalu', 'codigo1', 'codigo2'], 'string', 'max' => 16],
            [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
            [['modo_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterModos::className(), 'targetAttribute' => ['modo_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'universidad_id' => m::t('labels', 'University'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'depa_id' => m::t('labels', 'Departament'),
            'modo_id' => m::t('labels', 'Mode'),
            'codperiodo' => m::t('labels', 'Period Code'),
            'codocu' => m::t('labels', 'Document Code'),
            'programa_id' => m::t('labels', 'Program'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'secuencia' => m::t('labels', 'Sequence'),
            'alumno_id' => m::t('labels', 'Student'),
            'docente_id' => m::t('labels', 'Teacher'),
            'persona_id' => m::t('labels', 'Person'),
            'identidad_id' => m::t('labels', 'Identity'),
            'codalu' => m::t('labels', 'Code Student'),
            'codigo1' => m::t('labels', 'Code 1'),
            'codigo2' => m::t('labels', 'Code 2'),
        ];
    }

    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CONVOCATORIAMINIMA] = [
                        'universidad_id',
                       'facultad_id',
                       'depa_id',
                       'persona_id',
                       'modo_id',
                       'alumno_id',
                       'programa_id',
                       'codperiodo',
                       'codocu',
            ];
        $scenarios[self::SCENARIO_FICHA] = [
                        'universidad_id',
                       'facultad_id',
                       'depa_id',
                       'persona_id',
                       'modo_id',
                       'alumno_id',
                       'programa_id',
                       'codperiodo',
                       'codocu',
                       'motivos',
                       
            ];
        $scenarios[self::SCENARIO_STAGE] = [
                        'current_etapa',
                       
            ];
        return $scenarios;
    }
    /**
     * Gets query for [[Codperiodo0]].
     *
     * @return \yii\db\ActiveQuery|PeriodosQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(Periodos::className(), ['codperiodo' => 'codperiodo']);
    }

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * Gets query for [[Depa]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepa()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'depa_id']);
    }

    /**
     * Gets query for [[Modo]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getModo()
    {
        return $this->hasOne(InterModos::className(), ['id' => 'modo_id']);
    }

    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
    }
    
    public function getPrograma()
    {
        return $this->hasOne(InterPrograma::className(), ['id' => 'programa_id']);
    }

    /**
     * Gets query for [[Codocu0]].
     *
     * @return \yii\db\ActiveQuery|DocumentosQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_id']);
    }
    /**
     * Gets query for [[InterExpedientes]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getExpedientes()
    {
        return $this->hasMany(InterExpedientes::className(), ['convocado_id' => 'id']);
    }
    
   
    /**
     * Gets query for [[Codocu0]].
     *
     * @return \yii\db\ActiveQuery|DocumentosQuery
     */
    public function getAlumno()
    {
        return $this->hasOne(Alumnos::className(), ['id' => 'alumno_id']);
    }
    
    public function getInterOpuniv()
    {
        return $this->hasMany(InterOpuniv::className(), ['convocatoria_id' => 'id']);
    }
    
    public function getInterIdiomasalu()
    {
        return $this->hasMany(InterIdiomasalu::className(), ['convocatoria_id' => 'id']);
    }
    /**
     * {@inheritdoc}
     * @return InterConvocadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterConvocadosQuery(get_called_class());
    }
    
    /*
     * Verifica que este convocado a llenado la ficha
     */
    public function hasFillFicha(){
        $persona=$this->alumno->persona;
         $this->setScenario($persona::SCE_INTERMEDIO);         
        $oldScenario=$this->getScenario();
        $this->setScenario(self::SCENARIO_CONVOCATORIAMINIMA);
        $funciono=$this->validate();
        $this->setScenario($oldScenario); //Volvemos a colocar como estaba antes
        return (
                $funciono &&  //que tenga todos los datos de convocado
                $persona->validate() && //que tenga todos los datos personales completos
                $this->getInterOpuniv()->count()>0 //Que por lo menos haya llenado una univesidad de psotulacion 
                );
        
    }
   /*
    * crea el expediente segun la etapa de
    * del proceso
    */ 
   public function createExpedientes($stage=null){
       if(is_null($stage))
       $query= Interplan::find()->andWhere(['modo_id'=>$this->modo_id]);
       $query= Interplan::find()->andWhere(['modo_id'=>$this->modo_id,'ordenetapa'=>$stage]);
      $modelsPlanes=$query->all();
      //yii::error(Interplan::find()->andWhere(['modo_id'=>$this->modo_id])->createCommand()->rawSql);
      yii::error('Ingnresando al for ',__FUNCTION__);
      foreach($modelsPlanes as $modelPlan){
          yii::error('seguimiento docuementos');
          yii::error($modelPlan->codocu,__FUNCTION__);
          $this->createExpediente($modelPlan);
      }
   } 
  
   public function afterSave($insert, $changedAttributes) {
      if($insert){
          $this->createFirstExpediente();
      }
       RETURN parent::afterSave($insert, $changedAttributes);
   }
   
  /*public function hasCompleteExpedientes(){
      $this->getExpedientes()->andWhere(['estado'=>'1']);
  }*/
   /*
    * Obtiene la etapa en la que se encuentra 
    * el postulante 
    */
  public function currentStage(){
    /*Obteniendo la etapa actual*/
    $etapa=$this->getExpedientes()->select(['max(orden)'])->andWhere(['estado'=>'1'])->scalar();
    IF($etapa){
        /*
         * Si en esta etapa todos los expedientes estan aprobados 
         * virtualmente ya pasó a la siguiente si no se queda aquí
         */
      if($this->hasCompletedStage($etapa)){
          //Debe de calcularse la siguitente etapa
          return InterEtapas::nextStage($etapa, $this->modo_id);
      }else{
          return $etapa;
      }
    }else{
       return InterEtapas::firstStage($this->modo->id);  
    }
    
    
      
     
  }
  /*
   * Devuelve la etapa actual 
   * pero no es inteligente como la 
   * funcion currentStage() que avanza 
   * a la siguietne cuando encuentra completa la etapa
   * , esta funcion no avanza 
   * te da la etpaa como tal
   */
public function rawCurrentStage(){
    $etapa=$this->getExpedientes()->
            select(['max(orden)'])->andWhere(['estado'=>'1'])->scalar();
    var_dump($this->getExpedientes()->
            select(['max(orden)'])->andWhere(['estado'=>'1'])->createCommand()->rawSql);
    die();
    IF($etapa){
          return $etapa;
     
    }else{
       return InterEtapas::firstStage($this->modo->id);  
    } 
}
   
  /*Como saber si ha completado la etapa*/
  public function hasCompletedStage($stage){
      $expAprobados=$this->getExpedientes()
              ->andWhere(['orden'=>$stage,'estado'=>'1'])->count();
      if($expAprobados > 0){
        $nExpedientesEnEtapa= $this->modo->getPlanes()->andWhere(['ordenetapa'=>$stage])->count();
           if($expAprobados >=$nExpedientesEnEtapa){
               /*Quieer decior que ya aprobo toda la etapa*/
              return true;
           }else{
              return false; 
           }
      }else{
          return false; //Si no ha aprobado nada , ues no ha compeltado
      }
     
  }
 
  
 public function porcAvance($stage=null){
      $expAprobados=$this->getExpedientes()
              ->andWhere(['orden'=>(is_null($stage))?$this->rawCurrentStage():$stage,'estado'=>'1'])->count();
       $nExpedientesEnEtapa= $this->modo->getPlanes()->andWhere(['ordenetapa'=>(is_null($stage))?$this->rawCurrentStage():$stage])->count();
       //var_dump($this->rawCurrentStage(),$expAprobados,$nExpedientesEnEtapa);die();
       if($nExpedientesEnEtapa >0)
       return round(100*$expAprobados/$nExpedientesEnEtapa,3);
       return 0;
 }
  
 
public function porcAvanceUploads($stage){
    $query=$this->getExpedientes()
              ->andWhere(['orden'=>$stage]);
     //$expedientes=$query->all();
     $nexpedientes=$query->count();
     $nsubidos=0;
     foreach($this->expedientes as $expediente){
        if($expediente->hasAttachments())$nsubidos++;
     }
    // var_dump($nexpedientes,$nsubidos);die();
     if($nexpedientes>0)return 100*round($nsubidos/$nexpedientes,3);
     return 0;
}
  
  
  /*
   * Devuelve los IDS de los planes expedientes 
   * si activo=true
   * Solo devuelve aquellos auq ya han sido completados
   */ 
  public function idPlanesInExpedientes($activo=false){
       if(!$activo)
       return $this->getExpedientes()->select(['plan_id'])->column();
       return $this->getExpedientes()->select(['plan_id'])->andWhere(['estado'=>'1'])->column();
    }
    
    /*
   * Devuelve los IDS de los expedientes 
   * si activo=true
   * Solo devuelve aquellos auq ya han sido completados
   */ 
  public function idExpedientes($activo=false){
        if(!$activo)
      return $this->getExpedientes()->select(['id'])->column();
       return $this->getExpedientes()->select(['id'])->andWhere(['estado'=>'1'])->column();
    
    }
  
 public function createFirstExpediente(){
    $modelPlan= Interplan::find()->
    andWhere(['modo_id'=>$this->modo_id,
      'ordenetapa'=> InterEtapas::firstStage($this->modo_id)
            ])->orderBy(['orden'=>SORT_ASC])->one(); 
   return $this->createExpediente($modelPlan);
    
 }
 
 public function firstExpediente($stage=null){
     if(is_null($stage))
     RETURN $this->getExpedientes()->andWhere(['orden'=>InterEtapas::firstStage($this->modo_id)])
            ->orderBy(['secuencia'=>SORT_ASC])->one();
      RETURN $this->getExpedientes()->andWhere([          
          'orden'=>$stage])
            ->orderBy(['secuencia'=>SORT_ASC])->one();
 }     
 
 private function createExpediente(InterPlan $modelPlan){
    return  InterExpedientes::firstOrCreateStatic([
                        'universidad_id'=>$this->universidad_id,
                       'facultad_id'=>$this->facultad_id,
                       'depa_id'=>$this->depa_id,
                        'plan_id'=>$modelPlan->id,
                       'orden'=>$modelPlan->ordenetapa, //oJO ESTA ES LA ETAPA NO EL ORDEN
                        'etapa_id'=>$modelPlan->etapa_id,
                        'programa_id'=>$this->programa_id,
                       'modo_id'=>$this->modo_id,            
                       'convocado_id'=>$this->id,
                       'codocu'=>$modelPlan->codocu,
                       'secuencia'=>$modelPlan->orden, //OJO NO CONFUNDIRSE  CON LA ETAPA, ESTE ES EL ORDEN
            ],InterExpedientes::SCE_BASICO,[ /*Campos para verifica rduplciados*/
                'convocado_id'=>$this->id,
                 'secuencia'=>$modelPlan->orden,
                 'plan_id'=>$modelPlan->id,
                'orden'=>$modelPlan->ordenetapa,
                ] );
 }
   
 public function validateOpUniv($attribute, $params)
    {
      if($this->getInterOpuniv()->count()==0){
          $this->addError('motivos',m::t('errors','You must fill Universities to apply'));
      }
    }
 
    
 public function sendEmailUploads(){
     $nombre=$this->persona->fullName();
        $mailer = new \common\components\Mailer();
        $message =new  \yii\swiftmailer\Message();
            $message->setSubject(m::t('labels','Notificación de Carga de documentos'))
            ->setFrom(['neotegnia@gmail.com'=>'Internacional'])
            ->setTo('jramirez@neotegnia.com')
            ->SetHtmlBody("Buenas Tardes <br>"
                    . "El postulante   ".$nombre."  "
                    . " Ha terminado de subir sus documentos "
                    . " ");
           
    try {
        
           $result = $mailer->send($message);
           //$mensajes['success']='Se envió un mensaje al correo que indicaste';
    } catch (\Swift_TransportException $Ste) {      
         $mensajes['error']=$Ste->getMessage();
    }
   return $result; 
 }   
  
 
public function updateStage(){
     $oldScenario=$this->getScenario();
        $this->setScenario(self::SCENARIO_STAGE);
        $this->current_etapa=$this->currentStage();
        $grabo=$this->save();
        $this->setScenario($oldScenario);//dejamos las cosas como estaban antes
        return $grabo;
} 
 
    
}
