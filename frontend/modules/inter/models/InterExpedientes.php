<?php

namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;
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
     public $booleanFields=['estado','requerido','iscurrent'];  

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
             'auditoriaBehavior' => [ 
                'class' => '\common\behaviors\AuditBehavior',
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
            [['plan_id','orden','etapa_id','secuencia','iscurrent'], 'safe'],
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
            'id' => m::t('labels', 'ID'),
            'universidad_id' => m::t('labels', 'University'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'depa_id' => m::t('labels', 'Depa ID'),
            'programa_id' => m::t('labels', 'Program'),
            'modo_id' => m::t('labels', 'Mode ID'),
            'convocado_id' => m::t('labels', 'Summoned ID'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'codocu' => m::t('labels', 'Document Code'),
            'fpresenta' => m::t('labels', 'Presentation Date'),
            'fdocu' => m::t('labels', 'Document Date'),
            'detalles' => m::t('labels', 'Details'),
            'textointerno' => m::t('labels', 'Internal Text'),
            'estado' => m::t('labels', 'Status'),
            'requerido' => m::t('labels', 'Required'),
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
        $convocado=$this->convocado;
        $convocado->createExpedientes($convocado->currentStage());
        
        /*Si se nhixo efectiva la arpobacion 
         * actualizar el foco*/
         
        if($grabo && $approbe){
            
            $this->updateFocus();
        }
        if($grabo && !$approbe){/*Si desapruebas */
            $this->updateFocus(true);
        }
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
       if($tieneAdjunto)
       return '<i style="font-size:20px; color:'.$color.'">'.$icono.'</i>';
       return '';
    }
    
     public function flagStatus(){
        $tieneAdjunto=$this->hasAttachments();
        if($tieneAdjunto){
            if($this->hasObserves()){
                $icono=h::awe('eye');
               $color='red';
               $message=m::t('validaciones','You have a annotation CLICK HERE');
               $link=\yii\helpers\Url::to(['/inter/expedientes/modal-view-obs','id'=>$this->id,'idGrilla'=>'s']);
               $options=['class'=>'botonAbre',];
               return '<i style="font-size:20px; color:'.$color.'">'.$icono.'</i>'.\yii\helpers\Html::a($message,$link,$options);
            }ELSE{
               if($this->estado) {
                   $icono=h::awe('check');
                   $color='green';
                   return '<i style="font-size:20px; color:'.$color.'">'.$icono.'</i>';
               }else{
                   return '';
               }
            } 
        }else{
            return '';
        }
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
        $message = new \common\components\MessageMail();
        $message->setSubject('APROBACION DE EXPEDIENTE')
                ->setFrom([\common\helpers\h::gsetting('mail', 'userservermail') => 'Departamento Internacional'])
                ->setTo($postulante->mail)
                ->SetHtmlBody("Buenas Tardes   " . $postulante->fullName() . " <br>"
                        //->SetHtmlBody("Buenas Tardes   ALUMNO XXXX XXX XXXX  <br>"     
                        . "La presente es para notificarle que has  "
                        . "aprobado con éxito. <br>".$this->plan->descripcion." <br>"
                        . "Te esperamos en la siguiente etapa  ");
        $message->ResolveMessage();
        try {

            $result = $mailer->send($message);
            return true;
            $mensajes['success'] = m::t('validaciones','The mail was sent, confirming the approval of the file');
        } catch (\Swift_TransportException $Ste) {
            
            $mensajes['error'] = $Ste->getMessage();
        }
          return $mensajes;
        
        }
       

public function hasObserves(){
    return $this->getObservaciones()
      ->andWhere(['valido'=>'1'])->exists();
}
 
public function nextExpediente($onlyAprove=false){
    /*Primero buscamos el siguiente expediente
     * dentro de la misma etapa, recuerde que el campos 'orden' 
     * es el que registra la secuencia de la etapa
     */
    
    
    if(!$onlyAprove){
       $expediente= $this->querySameExpedientes()->
               andWhere(['>','secuencia',$this->secuencia])->
            andWhere(['orden'=>$this->orden])->
                   orderBy(['orden'=>SORT_ASC,'secuencia'=>SORT_ASC])->limit(1)->one();
      
         if(!is_null($expediente)){
             return $expediente;
         }else{/*sIO NO Lo encuentra en la misma etapa
          * va a la siguiente, pero antes crea el expediente
          */
             
           $siguiente=  $this->querySameExpedientes()->
                 andWhere(['>','orden',$this->orden])->
                   orderBy(['orden'=>SORT_ASC,'secuencia'=>SORT_ASC])
                   ->limit(1)->one(); 
           
         }
    }else{
        $expediente= $this->querySameExpedientes()->andWhere(['estado'=>'1'])->
               andWhere(['>','secuencia',$this->secuencia])->
                andWhere(['orden'=>$this->orden])->
                orderBy(['orden'=>SORT_ASC,'secuencia'=>SORT_ASC])->limit(1)->one();
         if(!is_null($expediente)){
             return $expediente;
         }else{
           return  $this->querySameExpendientes()->andWhere(['estado'=>'1'])->
                 andWhere(['>','orden',$this->orden])->
                   orderBy(['orden'=>SORT_ASC,'secuencia'=>SORT_ASC])
                   ->limit(1)->one(); 
         }
        
        
    }
               
}


public function previousExpediente($onlyAprove=false){
    /*Primero buscamos el siguiente expediente
     * dentro de la misma etapa, recuerde que el campos 'orden' 
     * es el que registra la secuencia de la etapa
     */
    
    
    if(!$onlyAprove){
       $expediente= $this->querySameExpedientes()->
               andWhere(['<','secuencia',$this->secuencia])->
            andWhere(['orden'=>$this->orden])->
                   orderBy(['orden'=>SORT_DESC,'secuencia'=>SORT_DESC])->limit(1)->one();
      
         if(!is_null($expediente)){
             return $expediente;
         }else{
             
           return  $this->querySameExpedientes()->
                 andWhere(['<','orden',$this->orden])->
                   orderBy(['orden'=>SORT_DESC,'secuencia'=>SORT_DESC])
                   ->limit(1)->one(); 
         }
    }else{
        $expediente= $this->querySameExpedientes()->andWhere(['estado'=>'1'])->
               andWhere(['<','secuencia',$this->secuencia])->
                andWhere(['orden'=>$this->orden])->
                orderBy(['orden'=>SORT_DESC,'secuencia'=>SORT_DESC])->limit(1)->one();
         if(!is_null($expediente)){
             return $expediente;
         }else{
           return  $this->querySameExpendientes()->andWhere(['estado'=>'1'])->
                 andWhere(['<','orden',$this->orden])->
                   orderBy(['orden'=>SORT_DESC,'secuencia'=>SORT_DESC])
                   ->limit(1)->one(); 
         }
        
        
    }
               
}

/*Criterio para 
 * filtrar los expedientes del postualnte 
 * actual 
 */
private function querySameExpedientes(){
    return $this->find()->andWhere(['convocado_id'=>$this->convocado_id]);
}

/*
 * Esta funcion vetifia si el usuario tiene derechos
 * de ver este registro, es una regla 
 * puede verlo sólo el mismo postulante  * 
 * Ejmplo un postulante no puede ver 
 * el expediente de otro postulante
 */
public function isAccessByPostulante(){
   return  $this->convocado->postulante->persona->profile->user->id==h::userId();
}



/*
 * Coloca el foco  en el registro  actual 
 * Cual es el foco? 
 * Pues EL REGISTRO INMEDIATO POSTERIOR AL ULTIMO REGISTRO APROBADO
 * Es decir cuando se aprueba un registro,inmediatamente el 
 * foco pasa al registro siguiente (nextExpediente())
 */

public function updateFocus($reverse=false){
    if(!$reverse){
          if(!is_null($siguiente=$this->nextExpediente())){
                return $siguiente->setCurrent();
            }else{
                return $this->setCurrent();
            } 
    }else{
        if(!is_null($anterior=$this->previousExpediente())){
                return $anterior->setCurrent();
            }else{
                return $this->setCurrent();
            } 
    }
    
}

private function setCurrent(){
    /*Limpiamos todos los expedientes primero*/
    self::updateAll(['iscurrent'=>'0'], ['convocado_id'=>$this->convocado_id]);
    $this->iscurrent=true;
    return $this->save();  
}

   
}
