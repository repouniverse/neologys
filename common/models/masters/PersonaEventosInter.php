<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%persona_eventosinter}}".
 *
 * @property int $id
 * @property int|null $persona_id
 * @property string $nombre
 * @property string|null $web
 * @property string|null $finicio
 * @property int|null $duracion
 * @property string|null $ciudad
 * @property string|null $pais
 * @property string|null $detalle
 * @property string|null $objetivosacad
 * @property string|null $obetivosinter
 * @property string $tipoexpo
 *
 * @property Personas $persona
 */
class PersonaEventosInter extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%persona_eventosinter}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persona_id', 'duracion'], 'integer'],
            [['nombre', 'tipoexpo'], 'required'],
            [['detalle', 'objetivosacad', 'obetivosinter'], 'string'],
            [['nombre'], 'string', 'max' => 60],
            [['web'], 'string', 'max' => 100],
            [['finicio'], 'string', 'max' => 10],
            [['ciudad'], 'string', 'max' => 30],
            [['pais'], 'string', 'max' => 3],
            [['tipoexpo'], 'string', 'max' => 1],
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
            'persona_id' => Yii::t('base_labels', 'Person ID'),
            'nombre' => Yii::t('base_labels', 'Name'),
            'web' => Yii::t('base_labels', 'Web'),
            'finicio' => Yii::t('base_labels', 'Start date'),
            'duracion' => Yii::t('base_labels', 'Duration'),
            'ciudad' => Yii::t('base_labels', 'City'),
            'pais' => Yii::t('base_labels', 'Country'),
            'detalle' => Yii::t('base_labels', 'Detail'),
            'objetivosacad' => Yii::t('base_labels', 'Academic Goals'),
            'obetivosinter' => Yii::t('base_labels', 'Inter Goals'),
            'tipoexpo' => Yii::t('base_labels', 'Display Type'),
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
     * @return PersonaEventosInterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonaEventosInterQuery(get_called_class());
    }
}
