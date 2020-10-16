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
            'coddepa' => Yii::t('base_labels', 'Code Area'),
            'nombredepa' => Yii::t('base_labels', 'Name Area'),
            'detalles' => Yii::t('base_labels', 'Details'),
            'correodepa' => Yii::t('base_labels', 'Mail Area'),
            'webdepa' => Yii::t('base_labels', 'Web Area'),
            'codigoper' => Yii::t('base_labels', 'Code Person'),
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
