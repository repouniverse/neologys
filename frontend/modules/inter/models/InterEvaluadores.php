<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use frontend\modules\inter\models\InterExpedientes;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Periodos;
use common\models\masters\Carreras;
use common\models\masters\Personas;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_evaluadores}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $carrera_id
 * @property int|null $programa_id
 * @property string $clase
 * @property string $status
 * @property string $codocu
 * @property string $acronimo
 * @property string $descripcion
 * @property string|null $detalles
 *
 * @property Departamentos $depa
 * @property Facultades $facultad
 * @property Carreras $carrera
 * @property Universidades $universidad
 * @property InterPlan[] $interPlans
 */
class InterEvaluadores extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_evaluadores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'depa_id', 'carrera_id', 'programa_id'], 'integer'],
            [[ 'acronimo', 'descripcion'], 'required'],
            [['detalles'], 'string'],
            [['persona_id','trabajador_id'], 'safe'],
            [['clase', 'status'], 'string', 'max' => 1],
            [['codocu'], 'string', 'max' => 3],
            [['acronimo'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 40],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['carrera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['carrera_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
             //[['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_id' => 'id']],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'universidad_id' => m::t('labels', 'University'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'depa_id' => m::t('labels', 'Depa ID'),
            'carrera_id' => m::t('labels', 'Race'),
            'programa_id' => m::t('labels', 'Program'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'codocu' => m::t('labels', 'Document Code'),
            'acronimo' => m::t('labels', 'Acronym'),
            'descripcion' => m::t('labels', 'Description'),
            'detalles' => m::t('labels', 'Details'),
        ];
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
    
     public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
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
     * Gets query for [[Carrera]].
     *
     * @return \yii\db\ActiveQuery|CarrerasQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(Carreras::className(), ['id' => 'carrera_id']);
    }

    
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_id']);
    }
    
    public function getTrabajador()
    {
        return $this->hasOne(\common\models\masters\Trabajadores::className(), ['id' => 'trabajador_id']);
    }

    /**
  

    /**
     * Gets query for [[InterPlans]].
     *
     * @return \yii\db\ActiveQuery|InterPlanQuery
     */
    public function getInterPlan()
    {
        return $this->hasMany(InterPlan::className(), ['eval_id' => 'id']);
    }
    
   

    /**
     * {@inheritdoc}
     * @return InterEvaluadoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterEvaluadoresQuery(get_called_class());
    }
    
    
    /*******************************************
     * funciones para sacar metricas de
     * avance de evaluacion
     ******************************************/
    private function queryExpedientes(){
        //Join con la tabla planes
       return InterExpedientes::find()->alias('t')
       ->join('INNER JOIN','{{%inter_plane}} x', 't.plan_id =x.id');
    }
    
    /*
     * Numero de expedientes sin aprobar 
     */
    public function numExpSinAprobar(){        
      return  $this->queryExpedientes()->
       andWhere(['t.estadoexp'=>'0','x.id'=>$this->id])->count();
    }
    
     /*
    
    
   /********************
     * Fin de funciones metricas
     */
     
}
