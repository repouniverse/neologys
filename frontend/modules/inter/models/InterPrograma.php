<?php

namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Periodos;
use common\models\masters\Personas;
use Yii;

/**
 * This is the model class for table "{{%inter_programa}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property string $codperiodo
 * @property int|null $depa_id
 * @property string $clase
 * @property string $status
 * @property string $codocu
 * @property string $codigoper
 * @property string $fopen
 * @property string $descripcion
 * @property string|null $detalles
 *
 * @property InterModos[] $interModos
 * @property Facultades $facultad
 * @property Periodos $codperiodo0
 * @property Departamentos $depa
 * @property Personas $codigoper0
 * @property Universidades $universidad
 */
class InterPrograma extends \common\models\base\modelBase
{
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_programa}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'depa_id'], 'integer'],
            [['codperiodo',  'codigoper', 'fopen', 'descripcion'], 'required'],
            [['detalles'], 'string'],
            [['codperiodo', 'fopen'], 'string', 'max' => 10],
            [['clase', 'status'], 'string', 'max' => 1],
            [['codocu'], 'string', 'max' => 3],
            [['codigoper'], 'string', 'max' => 8],
            [['descripcion'], 'string', 'max' => 40],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
            [['codigoper'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['codigoper' => 'codigoper']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
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
            'codperiodo' => m::t('labels', 'Period Code'),
            'depa_id' => m::t('labels', 'Departament'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'codocu' => m::t('labels', 'Document Code'),
            'codigoper' => m::t('labels', 'Person Code'),
            'fopen' => m::t('labels', 'Begin Date'),
            'descripcion' => m::t('labels', 'Description'),
            'detalles' => m::t('labels', 'Details'),
        ];
    }

     public function behaviors() {
        return [
           
             'auditoriaBehavior' => [ 
                'class' => '\common\behaviors\AuditBehavior',
            ],
            
        ];
    }
    
    
    /**
     * Gets query for [[InterModos]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getModo()
    {
        return $this->hasMany(InterModos::className(), ['programa_id' => 'id']);
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
     * Gets query for [[Depa]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepa()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'depa_id']);
    }

    /**
     * Gets query for [[Codigoper0]].
     *
     * @return \yii\db\ActiveQuery|PersonasQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['codigoper' => 'codigoper']);
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
     * {@inheritdoc}
     * @return InterProgramaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterProgramaQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        if($insert){
            $this->clase=m::CLASE_GENERAL;
            $this->status=m::STATUS_GENERAL;
            $this->codocu='112';
            }
        return parent::beforeSave($insert);
    }
    
    
    /*
     * Esta función crea un programa y toda su infraestructura
     * esto para una uniersidad de convenio. La infraestrucutra
     * básica mínima para que un alumno pueda postular a un proceso
     * 1) Crear el depara tamento si esxiote
     * 2) Crear el cargo si no existe
     * 3) Crear el trabajador yasignarle el cargo y el depa  si no existe
     * 4) Crear el programa del periodo actual
     * 5) Crear el modo
     * 6) Crear la etapa
     * 7) Crear el evaluador
     * 8) Crear el plan
     * 9) Crear el registro de convocado
     * 10)Crear el expediente
     */
    public static function createMagicPrograma($universidad_id,$facultad_id,$periodo,$codocuinicial){
       $iddepa=self::createMagicDepa($universidad_id, $facultad_id);
       yii::error('idepa  '.$iddepa);
       $idcargo=self::createMagicCargo($iddepa);
        yii::error('idcargo  '.$idcargo);
       $idtrab=self::createMagicTrabajador($universidad_id,$facultad_id,$iddepa,$idcargo);
       yii::error('idtrab  '.$idtrab);
       $iprog=self::createMagicProgramaAlone($universidad_id,$facultad_id,$periodo,$iddepa,$idtrab);
       yii::error('idprog  '.$iprog);
       $idmodo=self::createMagicModo($universidad_id,$facultad_id,$iddepa,$iprog,$periodo);
       yii::error('idmodo  '.$idmodo);
       $idetapa=self::createMagicEtapa($iprog,$idmodo);
       yii::error('idetapa  '.$idetapa);
       $idcarrera=self::createMagicCarrera($universidad_id,$facultad_id);
         yii::error('idcarrera '.$idcarrera);
       $ideval=self::createMagicEval($universidad_id,$facultad_id,$iddepa,$idcarrera,$iprog,$idtrab);
       yii::error('ideval  '.$ideval);
       
       $idplan=self::createMagicPlan($universidad_id,
               $facultad_id,$iddepa,
            $ideval,$idmodo,$iprog,$idetapa,$codocuinicial);
       yii::error('idplan  '.$idplan);
       return true;
      /* $idplan=self::createMagicConvocado($universidad_id,
               $facultad_id,$iddepa,$idmodo,$periodo,$codocuinicial,$iprog,$idetapa,$codocuinicial);   */ 
    }
    /*
     * Paso 1 del proc createMagicPrograma()
     */
    private static function createMagicDepa($universidad_id,$facultad_id){
       $depa=Departamentos::find()->andWhere(['universidad_id'=>$universidad_id,'facultad_id'=>$facultad_id])->one();
       if(is_null($depa)){
           Departamentos::firstOrCreateStatic(
                   [   'universidad_id'=>$universidad_id,
                       'facultad_id'=>$facultad_id,
                       'coddepa'=>'DEP1',
                       'nombredepa'=>'DEPARTAMENT 1',
                   ],
                   NULL,
                   ['universidad_id'=>$universidad_id,
                    'facultad_id'=>$facultad_id]);
          $depa=Departamentos::find()->andWhere(['universidad_id'=>$universidad_id,'facultad_id'=>$facultad_id])->one();
       }
       return $depa->id;
    }
    /*
     * Paso 2 del proc createMagicPrograma()
     */
    private static function createMagicCargo($iddepa){
       $cargo= \common\models\masters\Cargos::find()->andWhere(['depa_id'=>$iddepa])->one();
       if(is_null($cargo)){
           \common\models\masters\Cargos::firstOrCreateStatic(
                   [   'depa_id'=>$iddepa,                       
                       'descargo'=>'OCCUPATION 1',
                   ],
                   NULL,
                   [ 'depa_id'=>$iddepa]);
          $cargo=\common\models\masters\Cargos::find()->andWhere(['depa_id'=>$iddepa])->one();
       }
       return $cargo->id;
    }
    
     /*
     * Paso 3 del proc createMagicTrabajador()
     */
    private static function createMagicTrabajador(
            $universidad_id,
            $facultad_id,
            $depa_id,
            $cargo_id
            ){
        $criterio=[ 
                        'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        'depa_id'=>$depa_id,
                        'cargo_id'=> $cargo_id
                   ];
       $trabajador= \common\models\masters\Trabajadores::find()->andWhere($criterio)->one();
       if(is_null($trabajador)){
           \common\models\masters\Trabajadores::firstOrCreateStatic(
                   [  'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        'depa_id'=>$depa_id,
                        'cargo_id'=> $cargo_id,
                       'ap'=> 'LAST NAME',
                        'am'=>'LAST NAME 2',
                       'nombres'=>'FIRST NAME',
                        'numerodoc'=>'AUT'.strtoupper(uniqid()),
                        'tipodoc'=>'10',
                   ],
                   NULL,
                   $criterio);
          $trabajador= \common\models\masters\Trabajadores::find()->andWhere($criterio)->one();
       }
       return $trabajador->id;
    }
    
     /*
     * Paso 4 del proc createMagicpeogramna()
     */
    private static function createMagicProgramaAlone($universidad_id,$facultad_id,$periodo,$depa_id,$trabajador_id){
        $criterio=[ 
                        'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        'codperiodo'=>$periodo,
                        //'depa_id'=> $depa_id
                   ];
       $programa= InterPrograma::find()->andWhere($criterio)->one();
      $persona= \common\models\masters\Trabajadores::findOne($trabajador_id)->persona;
       $persona_id=$persona->id;
       yii::error( $persona);
       yii::error('codperiodo '. $periodo);
        yii::error( $persona->codigoper);
       if(is_null($programa)){
          InterPrograma::firstOrCreateStatic(
                   [   'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        'codperiodo'=>$periodo,
                        'depa_id'=> $depa_id,
                        'clase'=>'A',
                        'status'=>'1',
                        'codocu'=> '112',
                       'persona_id'=>$persona_id,
                       'codigoper'=> $persona->codigoper,
                        'codocu'=> '112',
                       'fopen'=>self::SwichtFormatDate(date('Y-m-d'),'date',true),
                       'descripcion'=>'INTERCHANGE PROGRAM '.$periodo,],
                   NULL,
                   $criterio);
          $programa= InterPrograma::find()->andWhere($criterio)->one();
       }
       return $programa->id;
    }
    
    
      /*
     * Paso 5 del proc createMagicpeogramna()
     */
    private static function createMagicModo($universidad_id,$facultad_id,$iddepa,$iprog,$periodo){
        $criterio=[ 
                        'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        //'codperiodo'=>$periodo,
                        'depa_id'=> $iddepa,
                        'programa_id'=> $iprog,
                   ];
       $modo= InterModos::find()->andWhere($criterio)->one();
      //$persona= \common\models\masters\Trabajadores::findOne($trabajador_id)->persona;
      // $persona_id=$persona->id;
       if(is_null($modo)){
          InterModos::firstOrCreateStatic(
                   [   'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        //'codperiodo'=>$periodo,
                        'acronimo'=>'OUT',
                        'descripcion'=>'OUTGOING STUDENTS',
                        'depa_id'=> $iddepa,
                        'programa_id'=>$iprog],
                   NULL,
                   $criterio);
          $modo= InterModos::find()->andWhere($criterio)->one();
       }
       return $modo->id;
    }
    
      /*
     * Paso 5 del proc createMagicpeogramna()
     */
    private static function createMagicEtapa($iprog,$idmodo){
        $criterio=[ 
                        'programa_id'=> $iprog,
                        'modo_id'=>$idmodo,
                   ];
       $etapa= InterEtapas::find()->andWhere($criterio)->one();
      //$persona= \common\models\masters\Trabajadores::findOne($trabajador_id)->persona;
      // $persona_id=$persona->id;
       if(is_null($etapa)){
           InterEtapas::firstOrCreateStatic(
                   [   'programa_id'=> $iprog,
                        'modo_id'=>$idmodo,
                       'descripcion'=> 'FIRST STAGE',
                        'activo'=>'1',
                       'awe'=>'file',
                       'orden'=>1,
                       ],
                   NULL,
                   $criterio);
          $etapa= InterEtapas::find()->andWhere($criterio)->one();
       }
       return $etapa->id;
    }
    
     /*
     * Paso 6 del proc createMagicpeogramna()
     */
    private static function createMagicCarrera($universidad_id,$facultad_id){
        $criterio=[ 
                        'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                   ];
       $carrera= \common\models\masters\Carreras::find()->andWhere($criterio)->one();
      //$persona= \common\models\masters\Trabajadores::findOne($trabajador_id)->persona;
      // $persona_id=$persona->id;
       if(is_null($carrera)){
           \common\models\masters\Carreras::firstOrCreateStatic(
                   [   'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                       'nombre'=> 'PROFESSION 1',
                        'codesp'=>'PROF1',
                       'acronimo'=>'PROF1',
                       //'orden'=>1,
                       ],
                   NULL,
                   $criterio);
          $carrera= \common\models\masters\Carreras::find()->andWhere($criterio)->one();
       }
       return $carrera->id;
    }
    
    /*
     * Paso 7 del proc createMagicpeogramna()
     */
    private static function createMagicEval($universidad_id,$facultad_id,$depa_id,$carrera_id,$programa_id,$trabajador_id){
        $criterio=[ 
                        'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        'depa_id'=>$depa_id,
                        'carrera_id'=>$carrera_id,
                        'programa_id'=>$programa_id,
                        'trabajador_id'=>$trabajador_id
                   ];
       $eval= InterEvaluadores::find()->andWhere($criterio)->one();
      //$persona= \common\models\masters\Trabajadores::findOne($trabajador_id)->persona;
      // $persona_id=$persona->id;
       if(is_null($eval)){
           InterEvaluadores::firstOrCreateStatic(
                   [    'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        'depa_id'=>$depa_id,
                        'carrera_id'=>$carrera_id,
                        'programa_id'=>$programa_id,
                        'trabajador_id'=>$trabajador_id,
                       'acronimo'=>'EVAL1',
                        'descripcion'=>'EVALUATOR 1'
                       //'orden'=>1,
                       ],
                   NULL,
                   $criterio);
          $eval= InterEvaluadores::find()->andWhere($criterio)->one();
       }
       return $eval->id;
    }
    
     /*
     * Paso 8 del proc createMagicpeogramna()
     */
    private static function createMagicPlan($universidad_id,$facultad_id,$depa_id,
            $eval_id,$modo_id,$programa_id,$etapa_id,$codocuinicial){
        $criterio=[ 
                        'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        'depa_id'=>$depa_id,
                        'eval_id'=>$eval_id,
                        'modo_id'=>$modo_id,
                        'programa_id'=>$programa_id,
                        'etapa_id'=>$etapa_id,
                   ];
       $plan= InterPlan::find()->andWhere($criterio)->one();
      //$persona= \common\models\masters\Trabajadores::findOne($trabajador_id)->persona;
      // $persona_id=$persona->id;
       if(is_null($plan)){
           InterPlan::firstOrCreateStatic(
                   [    'universidad_id'=> $universidad_id,
                        'facultad_id'=>$facultad_id,
                        'depa_id'=>$depa_id,
                        'eval_id'=>$eval_id,
                        'modo_id'=>$modo_id,
                        'programa_id'=>$programa_id,
                        'etapa_id'=>$etapa_id,
                        'codocu'=>$codocuinicial,
                        'acronimo'=>'DOCREF',
                        'descripcion'=>'FIRST PROCEDURE',
                       'orden'=>1,
                       'ordenetapa'=>1,
                       ],
                   NULL,
                   $criterio);
          $plan= InterPlan::find()->andWhere($criterio)->one();
       }
       return $plan->id;
    }
    
    /*
     * Función que genera los usuarios 
     * de la 
     */
    
   public function generateUsers($idmodo){
       $modo= InterModos::findOne($idmodo);
       $modo->generateUsers();
   } 
    
}
