<?php

namespace frontend\modules\inter\models;
use common\behaviors\FileBehavior;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Documentos;
use common\models\masters\Periodos;
use common\models\masters\Carreras;
use common\models\masters\Personas;
use common\models\masters\Alumnos;
use common\models\masters\Docentes;
use frontend\modules\inter\Module as m;
use frontend\modules\inter\models\InterPlan;
use common\helpers\h;
use Yii;
use yii\web\BadRequestHttpException;
class InterConvocados extends \common\models\base\modelBase
{
    const SCENARIO_CONVOCATORIAMINIMA = 'convocatoriamin';
    const SCENARIO_FICHA = 'ficha';
    const SCENARIO_STAGE = 'etapa';
    const STAGE_UPLOADS = 2;
    const CODIGO_DOCUMENTO = '115';
    const FLAG_ELIMINADO = 'X';
    const FLAG_ACTIVO = 'A';
    const FLAG_ADMITIDO = 'B';
    /**
     * {@inheritdoc}
     */
    public $booleanFields = ['pendiente'];
    /*
     * Pendiente es un campo booelano para 
     * calificar un proceso abierto sobre ese alumno
     */
    public static function tableName()
    {
        return '{{%inter_convocados}}';
    }

    public function behaviors()
    {
        return [
            /*'auditoriaBehavior' => [
                'class' => '\common\behaviors\AuditBehavior' ,
                                   ],*/
            'fileBehavior' => [
                'class' => FileBehavior::className()
            ],

            /*'AccessDownloadBehavior' => [
			'class' => AccessDownloadBehavior::className()
		]*/
        ];
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
            [['motivos', 'depa_id', 'current_etapa', 'pendiente'], 'safe'],
            [['motivos'], 'validateOpUniv', 'on' => self::SCENARIO_FICHA],
            [['programa_id', 'alumno_id'], 'unique', 'filter' => ['>', 'alumno_id', 0], 'targetAttribute' => ['programa_id', 'alumno_id']],
            [['programa_id', 'docente_id'], 'unique', 'filter' => ['>', 'docente_id', 0], 'targetAttribute' => ['programa_id', 'docente_id']],
            [['docente_id'], 'safe'],
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
                       'docente_id',
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
    public function hasFillFicha()
    {
        $persona = $this->postulante->persona;
        $this->setScenario($persona::SCE_INTERMEDIO);
        $oldScenario = $this->getScenario();
        $this->setScenario(self::SCENARIO_CONVOCATORIAMINIMA);
        $funciono = $this->validate();
        $this->setScenario($oldScenario); //Volvemos a colocar como estaba antes
        return (
            $funciono &&  //que tenga todos los datos de convocado
            $persona->validate() && //que tenga todos los datos personales completos
            $this->getInterOpuniv()->count() > 0 //Que por lo menos haya llenado una univesidad de postulación
        );
    }

    /*
     * crea el expediente segun la etapa del proceso
     */
    public function createExpedientes($stage = null)
    {
        if (is_null($stage))
            $query = Interplan::find()->andWhere(['modo_id' => $this->modo_id]);
        $query = Interplan::find()->andWhere(['modo_id' => $this->modo_id, 'ordenetapa' => $stage]);
        //var_dump($query->createCommand()->rawSql);die();
        $modelsPlanes = $query->all();
        //yii::error(Interplan::find()->andWhere(['modo_id'=>$this->modo_id])->createCommand()->rawSql);
        yii::error('Ingnresando al for ', __FUNCTION__);
        foreach ($modelsPlanes as $modelPlan) {
            yii::error('seguimiento docuementos');
            yii::error($modelPlan->codocu, __FUNCTION__);
            $this->createExpediente($modelPlan);
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            // vAR_DUMP('grabo after save'); DIE();
            $this->createFirstExpediente();
        }
        return parent::afterSave($insert, $changedAttributes);
    }
   
   /*public function afterFind() {
        YII::ERROR('AFETR FIND ',__FUNCTION__);
       if(!$this->hasExpedientes()){
          YII::ERROR('NO TIENE EXPEDIENTES ',__FUNCTION__);
           $this->createFirstExpediente();
       }else{
           YII::ERROR('YA TIENE EXPEDIENTES ',__FUNCTION__);
       }
       
       return parent::afterFind();
   }*/
   
  /*public function hasCompleteExpedientes(){
      $this->getExpedientes()->andWhere(['estado'=>'1']);
  }*/
   /*
    * Obtiene la etapa en la que se encuentra 
    * el postulante 
    */
    public function currentStage()
    {
        /*Obteniendo la etapa actual*/
        $etapa = $this->getExpedientes()->select(['max(orden)'])->andWhere(['estado' => '1'])->scalar();
        //var_dump($etapa);die();
        if ($etapa) {
            /*
             * Si en esta etapa todos los expedientes estan aprobados
             * virtualmente ya pasó a la siguiente si no se queda aquí
             */
            if ($this->hasCompletedStage($etapa)) {
                //Debe de calcularse la siguitente etapa
                return InterEtapas::nextStage($etapa, $this->modo_id);
            } else {
                return $etapa;
            }
        } else {
            //var_dump(InterEtapas::firstStage($this->modo->id));
            return InterEtapas::firstStage($this->modo->id);
        }
    }

  /*
   * Devuelve la etapa actual pero no es inteligente como la funcion currentStage() que avanza
   * a la siguietne cuando encuentra completa la etapa,
   * esta funcion no avanza te da la etapaacomo tal
   */
    public function rawCurrentStage()
    {
        $etapa = $this->getExpedientes()->select(['max(orden)'])->andWhere(['estado' => '1'])->scalar();
        /*  var_dump($this->getExpedientes()->
                  select(['max(orden)'])->andWhere(['estado'=>'1'])->createCommand()->rawSql);
       */
        if ($etapa) {
            return $etapa;
        } else {
            return InterEtapas::firstStage($this->modo->id);
        }
    }

    /*Como saber si ha completado la etapa*/
    public function hasCompletedStage($stage)
    {
        $expAprobados = $this->getExpedientes()
            ->andWhere(['orden' => $stage, 'estado' => '1'])->count();
        // if($modelPlan->eval->carrera->id==$this->alumno->carrera_id)
        if ($expAprobados > 0) {
            $nExpedientesEnEtapa = $this->getExpedientes()
                ->andWhere(['orden' => $stage])->count();

            /*$nExpedientesEnEtapa= $this->modo->getPlanes()->
                    andWhere(['ordenetapa'=>$stage,'plan_id'])->count();*/
            //VAR_DUMP($expAprobados,$nExpedientesEnEtapa);DIE();
            if ($expAprobados >= $nExpedientesEnEtapa) {
                /*Quieer decior que ya aprobo toda la etapa*/
                return true;
            } else {
                return false;
            }
        } else {
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

    public function createFirstExpediente()
    {
        // YII::ERROR('CREANDO EXPEDIENTE PRIMERO ',__FUNCTION__);

        $postulante = $this->postulante;
        // var_dump($postulante->attributes,$postulante->campoCarrera());die();
        $externo = $postulante->isExternal();
        $campoCarrera = $postulante->campoCarrera();
        $query = Interplan::find()->alias('t')->
        andWhere(['modo_id' => $this->modo_id,
            'ordenetapa' => InterEtapas::firstStage($this->modo_id)
        ])->orderBy(['orden' => SORT_ASC])->join('INNER JOIN', '{{%inter_evaluadores}} x', 't.eval_id =x.id')
            ->andWhere(['x.carrera_id' => $this->postulante->{$campoCarrera}])->limit(1);
        $modelPlan = $query->one();
        /* echo Interplan::find()->alias('t')->
         andWhere(['modo_id'=>$this->modo_id,
           'ordenetapa'=> InterEtapas::firstStage($this->modo_id)
                 ])->orderBy(['orden'=>SORT_ASC])->join('INNER JOIN','{{%inter_evaluadores}} x', 't.eval_id =x.id')
         ->where(['x.carrera_id' => $this->alumno->carrera_id])->limit(1)->limit(1)->createCommand()->rawSql;DIE();*/
        /*YII::ERROR(Interplan::find()->alias('t')->
         andWhere(['modo_id'=>$this->modo_id,
           'ordenetapa'=> InterEtapas::firstStage($this->modo_id)
                 ])->orderBy(['orden'=>SORT_ASC])->join('INNER JOIN','{{%inter_evaluadores}} x', 't.eval_id =x.id')
         ->andWhere(['x.carrera_id' => $this->alumno->carrera_id])->limit(1)->createCommand()->rawSql);*/
        if (is_null($modelPlan)) {
            throw new BadRequestHttpException(m::t('validaciones', 'Plan not found , SQL Sentence was {sql}', ['sql' => $query->createCommand()->rawSql]));

        }

        return $this->createExpediente($modelPlan);

    }
 
 public function firstExpediente($stage=null){
     if(is_null($stage)){
         /*VAR_DUMP($this->getExpedientes()->andWhere(['orden'=>InterEtapas::firstStage($this->modo_id)])
            ->orderBy(['secuencia'=>SORT_ASC])->createCommand()->rawSql);DIE();*/
         RETURN $this->getExpedientes()->andWhere(['orden'=>InterEtapas::firstStage($this->modo_id)])
            ->orderBy(['secuencia'=>SORT_ASC])->one(); 
     }
    
     
      RETURN $this->getExpedientes()->andWhere([          
          'orden'=>$stage])
            ->orderBy(['secuencia'=>SORT_ASC])->one();
      
 }

    private function createExpediente(InterPlan $modelPlan)
    {
        /*Solo los planes de la especialidad del alumno*/
        yii::error('itentando crear expediente ');
        $postulante = $this->postulante;
        $campoCarrera = $postulante->campoCarrera();
        //var_dump($postulante->campoCarrera(),$postulante->isExternal());die();
        yii::error('es externo ' . ($postulante->isExternal()) ? 'si' : 'no');
        yii::error('Campo carrera ' . $campoCarrera);
        yii::error('carrera carera evaluador ' . $modelPlan->eval->carrera->id);
        yii::error('POSTULANTE CAMPOS carrera ' . $postulante->{$campoCarrera});
        if ($modelPlan->eval->carrera->id == $postulante->{$campoCarrera}) {
            yii::error('si es de la carreaera  ');
            return InterExpedientes::firstOrCreateStatic([
                'universidad_id' => $this->universidad_id,
                'facultad_id' => $this->facultad_id,
                'depa_id' => $this->depa_id,
                'plan_id' => $modelPlan->id,
                'orden' => $modelPlan->ordenetapa, //oJO ESTA ES LA ETAPA NO EL ORDEN
                'etapa_id' => $modelPlan->etapa_id,
                'programa_id' => $this->programa_id,
                'modo_id' => $this->modo_id,
                'convocado_id' => $this->id,
                'codocu' => $modelPlan->codocu,
                'secuencia' => $modelPlan->orden, //OJO NO CONFUNDIRSE  CON LA ETAPA, ESTE ES EL ORDEN
            ], InterExpedientes::SCE_BASICO, [ /*Campos para verifica rduplciados*/
                'convocado_id' => $this->id,
                'secuencia' => $modelPlan->orden,
                'plan_id' => $modelPlan->id,
                'orden' => $modelPlan->ordenetapa,
            ]);
        } else {
            yii::error('No es de la carrera');
            return false;
        }
    }

    public function validateOpUniv($attribute, $params)
    {
        if ($this->getInterOpuniv()->count() == 0) {
            $this->addError('motivos', m::t('validaciones', 'You must fill Universities to apply'));
        }
    }

    public function sendEmailUploads()
    {
        $alumno_nombre = $this->persona->fullName();
        $alumno_mail = $this->getAlumno()->select(['mail'])->andWhere(['id'=>$this->alumno_id])->scalar();

        $mailer = new \common\components\Mailer();
        $message = new \common\components\MessageMail();
        /*Inicio notificación eval*/
        $message_eval = new \common\components\MessageMail();

        //$eval_mail = 'joseluis@accesolink.com';
        $eval_mail = $this->mainEvaluator()->trabajador->persona->profile->user->email;
        //var_dump($eval_mail);
        //die();
        $message_eval->setSubject(m::t('validaciones', 'Notification of loading of documents'))
            ->setFrom(['otifcctp@comunicacionesusmp.edu.pe' => 'Internacional-fcctp'])
            ->setTo($eval_mail) //antes ->setTo('jramirez@neotegnia.com')
            ->SetHtmlBody("Hola <br>"
                        . "El postulante   " . $alumno_nombre . "  "
                        . " ha terminado de subir sus documentos "
                        . " ");
        /*Fin notificación*/


        $message->setTo($alumno_mail); //antes ->setTo('jramirez@neotegnia.com')
        $message->ResolveMessage();
        try {
            $result = $mailer->send($message);
            if($result) {
                $mailer->send($message_eval);
            }
            //$mensajes['success']='Se envió un mensaje al correo que indicaste';
        } catch (\Swift_TransportException $Ste) {
            $mensajes['error'] = $Ste->getMessage();
        }
        return $result;
    }

    public function mainEvaluator(){
        $nombreCampo = $this->postulante->campoCarrera();
        $carrera_id= $this->postulante->{$nombreCampo};
        $programa_id=$this->programa->id;
        $departamento_id=h::gsetting('inter','dep_internacional_id');

//        echo InterEvaluadores::find()->andWhere([
//            'carrera_id'=>$carrera_id,
//            'programa_id'=>$programa_id,
//            'depa_id'=>$departamento_id,
//        ])->createCommand()->rawSql;
//        die();

        return InterEvaluadores::find()->andWhere([
            'carrera_id'=>$carrera_id,
            'programa_id'=>$programa_id,
            'depa_id'=>$departamento_id,
        ])->one();

    }

    public function updateStage()
    {
        $oldScenario = $this->getScenario();
        $this->setScenario(self::SCENARIO_STAGE);
        $this->current_etapa = $this->currentStage();
        $grabo = $this->save();
        $this->setScenario($oldScenario);//dejamos las cosas como estaban antes
        return $grabo;
    }

    public function beforeSave($insert)
    {
        if ($insert)
            $this->estado = self::FLAG_ACTIVO;
        return parent::beforeSave($insert);
    }

/*
 * Devuel un active record del
 * expediente que le toca procesar,
 * si no encuentra decuve null
 */
    public function currentExpediente(){
        $expediente= $this->getExpedientes()
           ->andWhere(['estado'=>'0'])->orderBy(['secuencia'=>SORT_ASC])->one();
        
        /*Si nesta al final cuidado */
        if(is_null($expediente)){
           $expediente= $this->getExpedientes()
           ->andWhere(['estado'=>'1'])->orderBy(['orden'=>SORT_DESC,'secuencia'=>SORT_DESC])->
                 limit(1)->one();
          /* echo "El expedente es nulo  ". $this->getExpedientes()
           ->andWhere(['estado'=>'1'])->orderBy(['orden'=>SORT_DESC,'secuencia'=>SORT_DESC])->
                 limit(1)->createCommand()->rawSql; die();*/
        }else{
            /*echo "Al inicio  ". $this->getExpedientes()
           ->andWhere(['estado'=>'0'])->orderBy(['secuencia'=>SORT_ASC])-> 
           createCommand()->rawSql;die();*/
        }
            
      return $expediente; 
        }
        
  public function hasExpedientes(){
      return ($this->getExpedientes()->count()==0)?FALSE:true;
  }      
 
 public function hasChangedStage() {
     return (!($this->currentStage() == $this->rawCurrentStage()));
 }
  
 public function getPostulante(){
     if(!empty($this->alumno_id))
   return Alumnos::findOne($this->alumno_id);
     
      if(!empty($this->docente_id))
   return Docentes::findOne($this->docente_id);
         
    
 }
 
 
 public function generateCertificadoAdmision(){
      //$model=$this->findModel($id);
       $rutaTemporal=\yii::getAlias('@frontend/modules/inter/temporales/');
      $rutaTemporal.= uniqid().'.pdf'; 
      yii::error($rutaTemporal,__FUNCTION__);
        $postulante=$this->postulante;
        $controlador=h::currentControllerObject();
        $controlador->layout='install';
      $pagina=$controlador->render('reportes/reporte_certificado_admision',['postulante'=>$postulante]);
      //return $pagina;
      $this->preparePdf($pagina)->Output($rutaTemporal,
            \Mpdf\Output\Destination::FILE);
     $this->deleteAllAttachments();
       $this->attachFromPath($rutaTemporal); 
              unlink($rutaTemporal);
 }

    private function enviaMailConfirmando()
    {
        $mailer = new \common\components\Mailer();
        $message = new \common\components\MessageMail();
        $message->setSubject('Confirmación de Ingreso')
            ->setFrom(['hipogea@hotmail.com' => 'Internacional'])
            ->setTo('hipogea@hotmail.com'/*$this->postulante->mailAddress()*/)
            ->SetHtmlBody("Buenas Tardes <br>"
                . "La presente es Confirmar que has sido admitido  "
                . " Al programa internacional "
                . " Adjuntamos un certificado de admisión.  Muchas gracias  ");
        if (!empty($replyTo)) {
            $message->setReplyTo($replyTo);
        }
        foreach ($this->files as $file) {
            $message->attach($file->path);
        }
        $message->ResolveMessage();
        try {
            $result = $mailer->send($message);
            $mensajes['success'] = 'Se envió un mensaje al correo que indicaste';
        } catch (\Swift_TransportException $Ste) {
            $mensajes['error'] = $Ste->getMessage();
        }
        return $mensajes;
    }

    private function preparePdf($contenidoHtml)
    {
        //  $contenidoHtml = \Pelago\Emogrifier\CssInlinerCssInliner::fromHtml($contenidoHtml)->inlineCss()->render();
        //->renderBodyContent();
        $mpdf = \frontend\modules\report\Module::getPdf();
        // $mpdf->SetHeader(['{PAGENO}']);
        $mpdf->margin_header = 1;
        $mpdf->margin_footer = 1;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';

        //$stylesheet = file_get_contents(\yii::getAlias("@frontend/web/css/bootstrap.min.css")); // external css
        $stylesheet2 = file_get_contents(\yii::getAlias("@frontend/web/css/reporte.css")); // external css
        //$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($stylesheet2, 1);

        /*$mpdf->DefHTMLHeaderByName(
       'Chapter2Header',$this->render("/citas/reportes/cabecera")
     );*/
        //$mpdf->DefHTMLFooterByName('pie',$this->render("/citas/reportes/footer"));
        // $mpdf->SetHTMLHeaderByName('Chapter2Header');
        // $contenidoHtml = \Pelago\Emogrifier\CssInliner::fromHtml($contenidoHtml)->inlineCss($stylesheet)->render();
        $mpdf->WriteHTML($contenidoHtml);
        return $mpdf;
    }

    public function hasExpedientesPendientes()
    {
        return $this->getExpedientes()->andWhere(['estado' => '0'])->exists();
    }

    public function isEliminado()
    {
        return (self::FLAG_ELIMINADO == $this->estado);
    }

    public function isAdmitido()
    {
        return (self::FLAG_ADMITIDO == $this->estado);
    }

    public function isInFinalStage()
    {
        return InterEtapas::findOne($this->rawCurrentStage())->esfinal;
    }

    public function isHabilToIngresar()
    {
        return (!$this->hasExpedientesPendientes() && !$this->isEliminado() &&
            $this->isInFinalStage() && !$this->isAdmitido());
    }

    public function admitirPostulante()
    {
        /*Verificar que haya pasado todos los controles
         * de todos los planes.
         */
        if ($this->isHabilToIngresar()) {
            $this->estado = self::FLAG_ADMITIDO;
            $this->generateCertificadoAdmision();
            $grabo = $this->save();
            if ($grabo) $this->enviaMailConfirmando();
            return $grabo;
        } else {
            $this->addError('estado', m::t('validaciones', 'This person does not have the complete requirements'));
            return false;
        }
    }

    public function cancelarPostulante()
    {

        if (!$this->isAdmitido() && !$this->isEliminado()) {
            $this->estado = self::FLAG_ELIMINADO;
            return $this->save();

        } else {
            $this->addError('estado', m::t('validaciones', 'This process cannot be canceled'));
            return false;
        }
    }


    /*Como obenter la universidad a la que esta postulando */
    public function targetUniversity()
    {
        /*IOmposibe que salga null por ue
         * en la fincha de datos el tiene
         * que llenar la universida con sus opciones
         */
        return $this->getInterOpuniv()->orderBy(['prioridad' => SORT_ASC])->limit(1)->one();
    }

    /*
     * Verifica que el postulante es el mismo usuario
     * en cuestion
     */
    public function IsOwner()
    {
        try {
            $idpersona = h::user()->profile->persona->id;
            return ($this->persona_id == $idpersona) ? true : false;
        } catch (Exception $ex) {
            return false;
        }
    }
}
