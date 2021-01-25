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
            [[ 'departamento_id'], 'required'],
            [['user_id', 'departamento_id'], 'integer'],
            [['mensaje','mensaje_de_respuesta'], 'string'],
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
           if($insert){          
            yii::error("Es una inserccion");
           }else{
                yii::error("Es una actualización");
                //DESPUES DE GUARDAR LLAMA AL FUNCION DE NOTIFICACIÓN POR CORREO
                yii::error("quiero ver si se activa esto");
                yii::error($this->mensaje_de_respuesta);
                $this->sendEmail();
           }  
        return parent::afterSave($insert, $changedAttributes);
    }

    private function sendEmail(){
        $buzom_msg = BuzonMensajes::findOne($this->id);
        if(!is_null($buzom_msg)){
            if($buzom_msg->user_id != null){
                yii::error("id usuarioalumno  ".$this->user->profile->persona->id);

                $alumno = Alumnos::findOne(['persona_id'=>$this->user->profile->persona->id]);
                $this->emailTemplate($alumno,$alumno->mail);
            }else {

                yii::error("ESTA VACIO");
                $alumno = BuzonUserNoreg::findOne(['bm_id'=>$this->id]);
                $this->emailTemplate($alumno,$alumno->email);
            }   

        }
    }

    private function emailTemplate($user , $email = null){
        yii::error("SU CORREO ES: ".strtolower($email));
    }
}