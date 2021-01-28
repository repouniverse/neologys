<?php

namespace frontend\modules\buzon\models;

use Yii;

/**
 * This is the model class for table "{{%user_no_reg}}".
 *
 * @property int $id
 * @property string $nombre
 * @property string $ap
 * @property string $am
 * @property string $dni
 * @property string $email
 * @property string|null $celular
 */
class UserNoReg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_no_reg}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'ap', 'am', 'dni', 'email'], 'required'],
            [['nombre', 'ap', 'am', 'dni', 'email', 'celular'], 'string', 'max' => 30],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'nombre' => Yii::t('base_labels', 'Nombre'),
            'ap' => Yii::t('base_labels', 'Ap'),
            'am' => Yii::t('base_labels', 'Am'),
            'dni' => Yii::t('base_labels', 'Dni'),
            'email' => Yii::t('base_labels', 'Email'),
            'celular' => Yii::t('base_labels', 'Celular'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserNoRegQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserNoRegQuery(get_called_class());
    }
}
