<?php

namespace frontend\modules\acad\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%acad_observaciones_syllabus}}".
 *
 * @property int $id
 * @property int $flujo_syllabus_id
 * @property int $syllabus_id
 * @property string|null $seccion
 * @property string|null $observacion
 * @property string|null $fecha
 *
 * @property AcadSyllabus $syllabus
 * @property AcadTramiteSyllabus $flujoSyllabus
 */
class AcadObservacionesSyllabus extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    
    public $booleanFields=['activo'];
    
    public static function tableName()
    {
        return '{{%acad_observaciones_syllabus}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flujo_syllabus_id', 'syllabus_id'], 'required'],
            [['flujo_syllabus_id', 'syllabus_id'], 'integer'],
            [['observacion'], 'string'],
             [['activo'], 'safe'],
            [['seccion'], 'string', 'max' => 40],            
             [['fecha'], 'string', 'max' => 19],            
            [['flujo_syllabus_id', 'syllabus_id'], 'unique','targetAttribute'=>['flujo_syllabus_id', 'syllabus_id']],
            [['fecha'], 'string', 'max' => 19],
            [['syllabus_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadSyllabus::className(), 'targetAttribute' => ['syllabus_id' => 'id']],
            [['flujo_syllabus_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadTramiteSyllabus::className(), 'targetAttribute' => ['flujo_syllabus_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'flujo_syllabus_id' => Yii::t('app', 'Flujo Syllabus ID'),
            'syllabus_id' => Yii::t('app', 'Syllabus ID'),
            'seccion' => Yii::t('app', 'Seccion'),
            'observacion' => Yii::t('app', 'Observacion'),
            'fecha' => Yii::t('app', 'Fecha'),
        ];
    }

    /**
     * Gets query for [[Syllabus]].
     *
     * @return \yii\db\ActiveQuery|AcadSyllabusQuery
     */
    public function getSyllabus()
    {
        return $this->hasOne(AcadSyllabus::className(), ['id' => 'syllabus_id']);
    }

    /**
     * Gets query for [[FlujoSyllabus]].
     *
     * @return \yii\db\ActiveQuery|AcadTramiteSyllabusQuery
     */
    public function getFlujoSyllabus()
    {
        return $this->hasOne(AcadTramiteSyllabus::className(), ['id' => 'flujo_syllabus_id']);
    }

    /**
     * {@inheritdoc}
     * @return AcadObservacionesSyllabusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadObservacionesSyllabusQuery(get_called_class());
    }
    
    public function afterSave($insert, $changedAttributes) {
        //DESPUES DE GUARDAR LLAMA AL FUNCION DE NOTIFICACIÓN POR CORREO
        $this->notificaMail();
        return parent::afterSave($insert, $changedAttributes);
    }
    
    
    //NOTIFICA LA OBSERVACIÓN POR CORREO
    private function notificaMail(){
        if(!empty($this->getDocOwner())){
            $this->sendObservacion($this->getDocOwner(),$this->observacion);
        }
        //$this->sendObservacion($this->getDocOwner(),$this->observacion);
        
        return true;
    }
    
    //FUNCION PARA ENVIAR LA OBSERVACIÓN 
    private function sendObservacion($user,$observacion ){
        
        $message = new \yii\swiftmailer\Message();
        $ruta = Url::toRoute(['/acad/syllabus/update','id'=>$this->syllabus_id],true);
        $htmlBody = 'Estimado <b>'.$user->username.'</b>'
            . ' <br> Se le remite la observación en el Syllabus con id: <b>'.$this->syllabus_id.'</b>'
            . ' <br> Ingrese a la siguiente ruta: <b>'.Html::a($ruta,$ruta,['target'=>'_blank']).'</b>'
            . ' <div style="padding-left:10px;">'
            . ' <br> En la sección: <b>'.$this->seccion.'</b>'
            . ' <br> El documento cuenta con la siguiente observación:'
            . ' <br> <b>'.$observacion.'</b>'
            . ' </div>'
            . ' <br><b>Se espera la corrección inmediata.<b>'
            . ' <br><br>Atte.'
            . ' <br>Unidad de Gestión Académica e Innovación.' ;
        yii::error("EL CORREO ES : ");
        yii::error($user->email);
        $mailer = new \common\components\Mailer();
        $message->setSubject('PRUEBA')
                ->setFrom([\common\helpers\h::gsetting('mail', 'userservermail') => 'POSTMASTER@USMP.PE'])
                ->setTo($user->email)
                ->setHtmlBody($htmlBody);

        try {

            $result = $mailer->send($message);
            return $result;
            
        } catch (\Swift_TransportException $Ste) {
           
             yii::error($Ste->getMessage(),__FUNCTION__);
             // return $result;
        }
                  
    }
    
    //GETER DEL DOCENTE OWNER
    public function getDocOwner(){
        return $this->syllabus->docenteOwner->persona->profile->user;
    }
  
}
