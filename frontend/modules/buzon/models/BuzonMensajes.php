<?php

namespace frontend\modules\buzon\models;

use Yii;
use common\models\User;
use common\models\masters\Departamentos;
use common\models\masters\Personas;
use common\models\masters\Alumnos;
use common\helpers\h;

/**
 * This is the model class for table "{{%buzon_mensajes}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $departamento_id
 * @property string|null $mensaje
 * @property string|null $estado
 * @property string|null $prioridad
 * @property string|null $fecha_registro
 *
 * @property User $user
 * @property Departamentos $departamento
 * @property Trabajadores $trabajador
 */
class BuzonMensajes extends \yii\db\ActiveRecord
{
    public $mensaje_de_respuesta;
    /** */
    public $esc_id=NULL;
    public $nombres=NULL;
    public $ap=NULL;
    public $am=NULL;
    public $numerodoc=NULL;
    public $email=NULL;
    public $celular=NULL;
    /**CORDI ACAD */
    /*
    public $docente_ca=NULL;
    public $curso_ca=NULL;
    public $celular=NULL;
    public $celular=NULL;
    public $celular=NULL;
    public $celular=NULL;
    public $celular=NULL;*/


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%buzon_mensajes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['departamento_id'], 'required'],
            //[['departamento_id'],'validacionajax'],
            [['user_id', 'departamento_id', 'esc_id'], 'integer'],
            //[['celular', 'match','pattern'=>"/[9][0123456789]{8}/", 'message'=>" Número celular invalido"]],
            [['mensaje', 'mensaje_de_respuesta', 'nombres', 'ap', 'am', 'numerodoc', 'email', 'celular'], 'string'],
            [['fecha_registro'], 'safe'],
            [['estado', 'prioridad'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['departamento_id' => 'id']],
            [['trabajador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['trabajador_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'user_id' => Yii::t('base_labels', 'User ID'),
            'departamento_id' => Yii::t('base_labels', 'Departamento ID'),
            'trabajador_id' => Yii::t('base_labels', 'TRABAJADOR ID'),
            'mensaje' => Yii::t('base_labels', 'Mensaje'),
            'estado' => Yii::t('base_labels', 'Estado'),
            'prioridad' => Yii::t('base_labels', 'Prioridad'),
            'fecha_registro' => Yii::t('base_labels', 'Fecha Registro'),
            'esc_id' => Yii::t('base_labels', 'Escuela'),
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'ap' => Yii::t('base_labels', 'Apellido Paterno'),
            'am' => Yii::t('base_labels', 'Apellido Materno'),
            'numerodoc' => Yii::t('base_labels', 'Dni'),
            'email' => Yii::t('base_labels', 'Email'),
            'celular' => Yii::t('base_labels', 'Celular'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'departamento_id']);
    }

    /**
     * Gets query for [[Trabajador]].
     *
     * @return \yii\db\ActiveQuery|TrabajadoresQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'trabajador_id']);
    }

    /**
     * {@inheritdoc}
     * @return BuzonMensajesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuzonMensajesQuery(get_called_class());
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            yii::error("Es CREACIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOON");
            $this->crearUserNoRegistrado();
        } else {
            yii::error("Es una actualización");
            //DESPUES DE GUARDAR LLAMA AL FUNCION DE NOTIFICACIÓN POR CORREO
            yii::error("quiero ver si se activa esto");
            yii::error($this->mensaje_de_respuesta);
            $this->sendEmail();
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    private function crearUserNoRegistrado()
    {
        //$usernor = new BuzonUserNoreg();

        yii::error("CON FE 5");
        BuzonUserNoreg::firstOrCreateStatic(
            [
                'bm_id' => $this->id,
                'esc_id' => $this->esc_id,
                'nombres' => $this->nombres,
                'ap' => $this->ap,
                'am' => $this->am,
                'numerodoc' => $this->numerodoc,
                'email' => $this->email,
                'celular' => $this->celular,
            ],
            null,
            [
                'bm_id' => $this->id,
                'esc_id' => $this->esc_id,
            ]
    );
    }
    private function crearTablaCordiAcademica(){
        //$usernor = new BuzonUserNoreg();

        yii::error("CON FE 5");
        BuzonCordiAcad::firstOrCreateStatic([
            'bm_id'=> $this->id,
            'docente' => $this->esc_id,
            'curso' => $this->nombres,
            'seccion' => $this->ap,
        ],
        null,
        [
          'bm_id'=>$this->id,
          'esc_id'=>$this->esc_id, 
            ]
    );
    }
    private function crearTablaAulaVirtual(){
        //$usernor = new BuzonUserNoreg();

        yii::error("CON FE 5");
        BuzonAulaVirt::firstOrCreateStatic([
            'bm_id'=> $this->id,
            'docente' => $this->esc_id,
            'curso' => $this->nombres,
            'seccion' => $this->ap,
            'ciclo' => $this->ap,
        ],
        null,
        [
          'bm_id'=>$this->id,
            ]
    );
    }    


    private function sendEmail()
    {
        $buzom_msg = BuzonMensajes::findOne($this->id);
        if (!is_null($buzom_msg)) {
            if ($buzom_msg->user_id != null) {
                yii::error("id usuarioalumno  " . $this->user->profile->persona->id);

                $alumno = Alumnos::findOne(['persona_id' => $this->user->profile->persona->id]);
                $this->emailTemplate($alumno, $alumno->mail);
            } else {

                yii::error("ESTA VACIO");
                $alumno = BuzonUserNoreg::findOne(['bm_id' => $this->id]);
                $this->emailTemplate($alumno, $alumno->email);
            }
        }
    }

    private function emailTemplate($user, $email = null)
    {
        yii::error("CORRE EL CORREO??!?!?!?!?!?");


        if ($email != null) {
            $message = new \yii\swiftmailer\Message();
            $htmlBody =
                  '<div style="background-color : #EAEAEA; color: #000000; font-size: 20px " >'
                . '<div style="background-color : #982222; height: 70px;"></div>'
                . '<div style="padding-left: 20px; padding-right:20px">'
                . '<div style="padding: 25px; margin:30px; background-color : #FFFFFF;">'
                . '<label> Estimado <b>' . $user->ap . ' ' . $user->am . ', ' . $user->nombres .   '</b></label>'
                . '<br><br>'
                . '<label> Como respuesta a la consulta hecha al departamento  <b>' . $this->departamento->nombredepa . ':</b> </label> '
                . '<br><br>'
                . '<div style="margin-left: 30px; margin-right:30px ;">'
                . ' <br>' . $this->mensaje_de_respuesta
                . '</div>'
                . '<br><br><br>'
                . '<label> Atentamente Oficina de Tecnología Informática-USMP. </label> '
                . '</div>'
                . '</div>'
                . '<div style="background-color : #982222; height: 70px;"></div>'
                . '</div>';
            yii::error("EL CORREO ES : ");
            yii::error($email);
            $mailer = new \common\components\Mailer();
            $message->setSubject('PRUEBA')
                ->setFrom([\common\helpers\h::gsetting('mail', 'userservermail') => 'POSTMASTER@USMP.PE'])
                ->setTo($email)
                ->setHtmlBody($htmlBody);

            try {

                $result = $mailer->send($message);
                return $result;
            } catch (\Swift_TransportException $Ste) {

                yii::error($Ste->getMessage(), __FUNCTION__);
            }
        }
    }

}
