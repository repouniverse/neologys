<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Periodos;
use common\models\masters\Carreras;
use common\models\masters\Personas;
use common\interfaces\postulantesInterface;
use Yii;

/**
 * This is the model class for table "{{%inter_modos}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $programa_id
 * @property string $acronimo
 * @property string $descripcion
 * @property string|null $detalles
 *
 * @property InterConvocados[] $interConvocados
 * @property InterExpedientes[] $interExpedientes
 * @property InterPrograma $programa
 * @property Departamentos $depa
 * @property Facultades $facultad
 * @property Universidades $universidad
 * @property InterPlan[] $interPlans
 */
class InterModos extends \common\models\base\modelBase
{
    
    
    //public $claseModeloFuente='common\models\masters\Alumnos';
    protected $modelFuente;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_modos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'depa_id', 'programa_id'], 'integer'],
            [['acronimo', 'descripcion'], 'required'],
            [['detalles','modelofuente'], 'string'],
            [['modelofuente'], 'safe'],
            [['acronimo', 'descripcion'], 'string', 'max' => 40],
            [['programa_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterPrograma::className(), 'targetAttribute' => ['programa_id' => 'id']],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'universidad_id' => Yii::t('base_labels', 'Universidad ID'),
            'facultad_id' => Yii::t('base_labels', 'Facultad ID'),
            'depa_id' => Yii::t('base_labels', 'Depa ID'),
            'programa_id' => Yii::t('base_labels', 'Programa ID'),
            'acronimo' => Yii::t('base_labels', 'Acronimo'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'detalles' => Yii::t('base_labels', 'Detalles'),
        ];
    }

    /**
     * Gets query for [[InterConvocados]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosQuery
     */
    public function getInterConvocados()
    {
        return $this->hasMany(InterConvocados::className(), ['modo_id' => 'id']);
    }

    /**
     * Gets query for [[InterExpedientes]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getInterExpedientes()
    {
        return $this->hasMany(InterExpedientes::className(), ['modo_id' => 'id']);
    }
    
    

    /**
     * Gets query for [[Programa]].
     *
     * @return \yii\db\ActiveQuery|InterProgramaQuery
     */
    public function getPrograma()
    {
        return $this->hasOne(InterPrograma::className(), ['id' => 'programa_id']);
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
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
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
     * Gets query for [[InterPlans]].
     *
     * @return \yii\db\ActiveQuery|InterPlanQuery
     */
    public function getInterPlans()
    {
        return $this->hasMany(InterPlan::className(), ['modo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return InterModosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterModosQuery(get_called_class());
    }
    
     /*
    * Inserta un registro de convocado
    * en referencia a este alumno
    */
   public function convocaPersona(postulantesInterface $postulante){
       
      if(!$postulante->isNewRecord && $postulante->esconvocable()){
          $model=new \frontend\modules\inter\models\InterConvocados();
          $model->setScenario($model::SCENARIO_CONVOCATORIAMINIMA);
           $model->setAttributes(
                   [
                       'universidad_id'=>$this->universidad_id,
                       'facultad_id'=>$this->facultad_id,
                       'depa_id'=>$this->depa_id,
                       'modo_id'=>$this->id,
                       'persona_id'=>$postulante->persona->id,
                       //'docente_id'=>$postulante->id,
                       'programa_id'=>$this->programa_id,
                       'codperiodo'=>$this->programa->codperiodo,
                       'codocu'=>$model::CODIGO_DOCUMENTO,
                       
                       
                    ]);
           $model->attributes=$postulante->pushAttributeInterModo(
                   $model->attributes);
           yii::error($model->firstOrCreate($model->attributes,
                   $model::SCENARIO_CONVOCATORIAMINIMA));
           
      }else{
          return false;
      }
         
           
           
      
   }
    
    
   public function convocaMasivamente(){
       $this->modelFuente = Yii::createObject($this->modelofuente);
       if($this->modelFuente instanceof postulantesInterface) {
           $providerPersons=$this->modelFuente->providerPersonsToConvocar();
             foreach($providerPersons->batch(10) as $persons){
                 foreach($persons as $person){
                     yii::error('siguiendo a '.$person->id);
                    $this->convocaPersona($person);  
                 }
                
             }
           
       } else{
           throw new \yii\base\InvalidConfigException(Yii::t('base_errors', 'Class {clase} is not Instance of postulanteInterface ',['clase'=>$this->claseModeloFuente])); 
       
       }   
   }
   
  
   
}
