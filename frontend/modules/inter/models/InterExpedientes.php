<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Documentos;
use common\models\masters\Periodos;
use common\models\masters\Carreras;
use common\models\masters\Personas;
use common\helpers\h;
use common\behaviors\FileBehavior;
use yii\helpers\Html;
use Yii;

/**
 * This is the model class for table "{{%inter_expedientes}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $programa_id
 * @property int|null $modo_id
 * @property int|null $convocado_id
 * @property string $clase
 * @property string $status
 * @property string $codocu
 * @property string|null $fpresenta
 * @property string|null $fdocu
 * @property string|null $detalles
 * @property string|null $textointerno
 * @property string $estado
 * @property string $requerido
 *
 * @property Documentos $codocu0
 * @property InterModos $modo
 * @property Facultades $facultad
 * @property Universidades $universidad
 * @property InterConvocados $convocado
 * @property Departamentos $depa
 */
class InterExpedientes extends \common\models\base\modelBase
{
    use \common\traits\identidadTrait;
    
    const SCE_BASICO='basico';
        
    const SCE_ESTADO='estado';
     public $booleanFields=['estado','requerido'];  

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_expedientes}}';
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
            [['universidad_id', 'facultad_id', 'depa_id', 'programa_id', 'modo_id', 'convocado_id'], 'integer'],
            [['codocu'], 'required'],
            [['detalles', 'textointerno'], 'string'],
            [['plan_id','orden','etapa_id','secuencia'], 'safe'],
            [['clase', 'status'], 'string', 'max' => 1],
            [['codocu'], 'string', 'max' => 3],
            [['fpresenta', 'fdocu'], 'string', 'max' => 10],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
            [['modo_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterModos::className(), 'targetAttribute' => ['modo_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['convocado_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterConvocados::className(), 'targetAttribute' => ['convocado_id' => 'id']],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
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
            'modo_id' => Yii::t('base_labels', 'Modo ID'),
            'convocado_id' => Yii::t('base_labels', 'Convocado ID'),
            'clase' => Yii::t('base_labels', 'Clase'),
            'status' => Yii::t('base_labels', 'Status'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'fpresenta' => Yii::t('base_labels', 'Fpresenta'),
            'fdocu' => Yii::t('base_labels', 'Fdocu'),
            'detalles' => Yii::t('base_labels', 'Detalles'),
            'textointerno' => Yii::t('base_labels', 'Textointerno'),
            'estado' => Yii::t('base_labels', 'Estado'),
            'requerido' => Yii::t('base_labels', 'Requerido'),
        ];
    }

    
     public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_BASICO] = [
                        'universidad_id',
                       'facultad_id',
                       'depa_id',
                       'plan_id',
                        'programa_id',
                       'modo_id',            
                       'convocado_id',
                       'codocu',
            'orden',
                        'etapa_id','secuencia',
            ];
        $scenarios[self::SCE_ESTADO] = [
                        
                        'estado',
            ];
        return $scenarios;
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

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    
    public function getPlan()
    {
        return $this->hasOne(InterPlan::className(), ['id' => 'plan_id']);
    }
    
     public function getEtapa()
    {
        return $this->hasOne(InterEtapas::className(), ['id' => 'etapa_id']);
    }
    
    /**
     * Gets query for [[Convocado]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosQuery
     */
    public function getConvocado()
    {
        return $this->hasOne(InterConvocados::className(), ['id' => 'convocado_id']);
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

    public function getEntrevistas()
    {
        return $this->hasMany(InterEntrevistas::className(), ['expediente_id' => 'id']);
    }
    
    public function getObservaciones()
    {
        return $this->hasMany(InterObsexpe::className(), ['expediente_id' => 'id']);
    }
    
    /**
     * {@inheritdoc}
     * @return InterExpedientesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterExpedientesQuery(get_called_class());
    }
    
    public function aprove($approbe=true){
     
        //$oldScenario=$this->getScenario();
       /// $this->setScenario(self::SCE_ESTADO);
        $this->estado=$approbe;
        $grabo=$this->save();
        if($grabo && $this->plan->notificamail){
            yii::error('ENVIANDO CORREO',__FUNCTION__);
             $this->mailAprove();
        }
       
        //var_dump($grabo);die();
        ///$this->setScenario($oldScenario);//dejamos las cosas como estaban antes
        return $grabo;
        
    }
    
    public function flagAttach(){
        $tieneAdjunto=$this->hasAttachments();
       $icono=(!$tieneAdjunto)?h::awe('folder-open'):h::awe('paperclip');
       $color=(!$tieneAdjunto)?'red':'green';
       return '<i style="font-size:20px; color:'.$color.'">'.$icono.'</i>';
    }
    
    
    public function putColorEventsCalendar($events){
        foreach ($events as $key=>$event){
            if($event['id']==$this->id){
               // yii::error('coincidio');
               $event['color']="#ff0000";
               $events[$key]=$event;
              // yii::error($event);
               //break;
            }
        }
        return $events;
        
    }
    
 public function hasEntrevista(){
     $model=$this->getEntrevistas()->andWhere([
         'activo'=>'1'
     ])->one();
//var_dump($model);die();
     return (!is_null($model))?$model:false;
 } 
 
 public function mailAprove(){
  $postulante=$this->convocado->postulante;
 $mailer = new \common\components\Mailer();
        $message = new \yii\swiftmailer\Message();
        $message->setSubject('APROBACION DE EXPEDIENTE')
                ->setFrom([\common\helpers\h::gsetting('mail', 'userservermail') => 'Departamento Internacional'])
                ->setTo($postulante->mail)
                ->SetHtmlBody("Buenas Tardes   " . $postulante->fullName() . " <br>"
                        //->SetHtmlBody("Buenas Tardes   ALUMNO XXXX XXX XXXX  <br>"     
                        . "La presente es para notificarle que has  "
                        . "aprobado con éxito. <br>".$this->plan->descripcion." <br>"
                        . "Te esperamos en la siguiente etapa  ");

        try {

            $result = $mailer->send($message);
            return true;
            $mensajes['success'] = m::t('labels','Se envió el correo, confirmando la aprobación del expediente ');
        } catch (\Swift_TransportException $Ste) {
            
            $mensajes['error'] = $Ste->getMessage();
        }
          return $mensajes;
        
        }
       

public function hasObserves(){
    return $this->getObservaciones()
      ->andWhere(['valido'=>'1'])->exists();
}
 
   
}
