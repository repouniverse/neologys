<?php

namespace frontend\modules\buzon\models;

use Yii;

/**
 * This is the model class for table "buzon_vw_mensajes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $departamento_id
 * @property string|null $nombres
 * @property string|null $ap
 * @property string|null $am
 * @property string|null $codesp
 * @property string|null $numerodoc
 * @property string $email
 * @property string $nombredepa
 * @property string|null $mensaje
 * @property string|null $estado
 * @property string|null $fecha_registro
 * @property string|null $prioridad
 */
class BuzonVwMensajes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buzon_vw_mensajes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'departamento_id'], 'integer'],
            [['user_id', 'departamento_id', 'email', 'nombredepa'], 'required'],
            [['mensaje'], 'string'],
            [['fecha_registro'], 'safe'],
            [['nombres', 'ap', 'am', 'nombredepa'], 'string', 'max' => 40],
            [['codesp'], 'string', 'max' => 8],
            [['numerodoc', 'estado', 'prioridad'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
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
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'ap' => Yii::t('base_labels', 'Ap'),
            'am' => Yii::t('base_labels', 'Am'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'numerodoc' => Yii::t('base_labels', 'Numerodoc'),
            'email' => Yii::t('base_labels', 'Email'),
            'nombredepa' => Yii::t('base_labels', 'Nombredepa'),
            'mensaje' => Yii::t('base_labels', 'Mensaje'),
            'estado' => Yii::t('base_labels', 'Estado'),
            'fecha_registro' => Yii::t('base_labels', 'Fecha Registro'),
            'prioridad' => Yii::t('base_labels', 'Prioridad'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BuzonVwMensajesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuzonVwMensajesQuery(get_called_class());
    }
}
