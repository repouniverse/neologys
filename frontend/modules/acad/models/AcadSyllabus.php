<?php

namespace frontend\modules\acad\models;
use common\models\masters\Cursos;
use common\models\masters\Docentes;
use common\models\masters\PlanesEstudio;
use common\helpers\h;
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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_syllabus}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_id', 'codperiodo', 'curso_id', 'docente_owner_id', 'formula_id','n_sesiones_semana'], 'required'],
            [['plan_id', 'curso_id', 'n_horasindep', 'docente_owner_id', 'formula_id','n_sesiones_semana'], 'integer'],
            [['datos_generales', 'sumilla', 'competencias', 'prog_contenidos', 'estrat_metod', 'recursos_didac', 'fuentes_info', 'reserva1', 'reserva2'], 'string'],
           [['docente_owner_id','plan_id'], 'unique','targetAttribute'=>['docente_owner_id','plan_id']],
            [['codperiodo'], 'string', 'max' => 10],   
            [['n_sesiones_semana','formula_txt','n_semanas'], 'safe'],   
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
    
    
    public function getSyllabusPrereq()
    {
        return $this->hasMany(\common\models\masters\PlanesPrerequisito::className(), ['plan_id' => 'id']);
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
    
    /**
     * {@inheritdoc}
     * @return AcadSyllabusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadSyllabusQuery(get_called_class());
    }
    
    public function afterSave($insert, $changedAttributes) {
        // yii::error(' disparador lanza ',__FUNCTION__);
       if($insert){          
           $this->fillCompetencias();           
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
          if(empty($filaACambiar->contenido_bloque)){
           $arrayCapacidades=$this->getSyllabusUnidades()->select(['capacidad'])->column();
            $filaACambiar->contenido_bloque='';
            foreach($arrayCapacidades as $valorTexto){
            $filaACambiar->contenido_bloque.=$valorTexto."\n";
            } 
         } 
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
      foreach($this->syllabusPrereq as $prereq){
          $fullNames.=','.$prereq->plan->codcursocorto;
      }
      return substr($fullNames,1);
  }
    
}
