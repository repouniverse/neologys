<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%departamentos}}".
 *
 * @property string $coddepa
 * @property string $nombredepa
 * @property string|null $detalles
 * @property string|null $correodepa
 * @property string|null $webdepa
 * @property string|null $codigoper
 *
 * @property Persona $codigoper0
 */
class Areas extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%departamentos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coddepa', 'nombredepa'], 'required'],
            [['detalles'], 'string'],
            [['coddepa'], 'string', 'max' => 10],
            [['nombredepa'], 'string', 'max' => 40],
            [['correodepa'], 'string', 'max' => 80],
            [['webdepa'], 'string', 'max' => 100],
            [['codigoper'], 'string', 'max' => 8],
            [['coddepa'], 'unique'],
            [['codigoper'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['codigoper' => 'codigoper']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coddepa' => Yii::t('base.labels', 'Coddepa'),
            'nombredepa' => Yii::t('base.labels', 'Nombredepa'),
            'detalles' => Yii::t('base.labels', 'Detalles'),
            'correodepa' => Yii::t('base.labels', 'Correodepa'),
            'webdepa' => Yii::t('base.labels', 'Webdepa'),
            'codigoper' => Yii::t('base.labels', 'Codigoper'),
        ];
    }

    /**
     * Gets query for [[Codigoper0]].
     *
     * @return \yii\db\ActiveQuery|PersonaQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['codigoper' => 'codigoper']);
    }

    /**
     * {@inheritdoc}
     * @return AreasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AreasQuery(get_called_class());
    }
}
