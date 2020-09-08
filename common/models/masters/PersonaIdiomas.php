<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%persona_idiomas}}".
 *
 * @property int $id
 * @property int|null $persona_id
 * @property string $codnivel
 * @property string|null $detalle
 * @property string $certificado
 *
 * @property Personas $persona
 */
class PersonaIdiomas extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%persona_idiomas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persona_id'], 'integer'],
            [['codnivel', 'certificado'], 'required'],
            [['detalle'], 'string'],
            [['codnivel', 'certificado'], 'string', 'max' => 1],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'persona_id' => Yii::t('base_labels', 'Persona ID'),
            'codnivel' => Yii::t('base_labels', 'Codnivel'),
            'detalle' => Yii::t('base_labels', 'Detalle'),
            'certificado' => Yii::t('base_labels', 'Certificado'),
        ];
    }

    /**
     * Gets query for [[Persona]].
     *
     * @return \yii\db\ActiveQuery|PersonasQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_id']);
    }

    /**
     * {@inheritdoc}
     * @return PersonaIdiomasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonaIdiomasQuery(get_called_class());
    }
}
