<?php

namespace frontend\modules\buzon\models;
use common\models\masters\Carreras;


use Yii;

/**
 * This is the model class for table "{{%buzon_user_noreg}}".
 *
 * @property int $id
 * @property string $nombres
 * @property string $ap
 * @property string $am
 * @property string $numerodoc
 * @property string $email
 * @property string|null $celular
 */
class BuzonUserNoreg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%buzon_user_noreg}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres','bm_id','esc_id', 'ap', 'am', 'numerodoc', 'email'], 'required'],
            [['nombres', 'ap', 'am', 'numerodoc', 'email', 'celular'], 'string', 'max' => 30],
            [['bm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['bm_id' => 'id']],
            [['esc_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuzonMensajes::className(), 'targetAttribute' => ['esc_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'ap' => Yii::t('base_labels', 'Apellido Paterno'),
            'am' => Yii::t('base_labels', 'Apellido Materno'),
            'bm_id' => Yii::t('base_labels', 'Buzon id'),
            'esc_id' => Yii::t('base_labels', 'Escuela id'),
            'numerodoc' => Yii::t('base_labels', 'Dni'),
            'email' => Yii::t('base_labels', 'Email'),
            'celular' => Yii::t('base_labels', 'Celular'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BuzonUserNoregQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuzonUserNoregQuery(get_called_class());
    }
}
