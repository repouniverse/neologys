<?php

namespace frontend\modules\buzon\models;

use Yii;
use common\models\User; 
use common\models\masters\Departamentos;
use common\models\masters\Trabajadores;
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
class BuzonMensajes extends \common\models\base\modelBase
{   
    
    //DATOS POR DEFECTO EN EL INGRESO DEL SISTEMA
    /*const BUZON_MENSAJE_ESTADO = "pendiente";
    const BUZON_MENSAJE_PRIORIDAD = "1";*/
    

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
            [['user_id', 'departamento_id'], 'required'],
            [['user_id', 'departamento_id'], 'integer'],
            [['mensaje'], 'string'],
            [['fecha_registro'], 'safe'],
            [['estado', 'prioridad'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['departamento_id' => 'id']],
            [['trabajador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajadores::className(), 'targetAttribute' => ['trabajador_id' => 'id']],
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
    public function getTrabajador()
    {
        return $this->hasOne(Trabajadores::className(), ['id' => 'trabajador_id']);
    }

    /**
     * {@inheritdoc}
     * @return BuzonMensajesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuzonMensajesQuery(get_called_class());
    }

    /*public function guardarMensaje(){
        $trabajador_por_definir = Trabajadores::findOne(['numerodoc'=>'77175855']);
        $this::firstOrCreateStatic([
           
            'user_id'=>h::userId(),
            'estado'=>self::BUZON_MENSAJE_ESTADO, 
            'prioridad'=>self::BUZON_MENSAJE_PRIORIDAD,
            'trabajador_id'=>$trabajador_por_definir->id,            
            'fecha_registro'=>null,
            
        ]);
    }*/
}