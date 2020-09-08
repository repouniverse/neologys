<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%persona_publicaciones}}".
 *
 * @property int $id
 * @property int|null $persona_id
 * @property string $nombre
 * @property string $editorial
 * @property string|null $isbn
 * @property string|null $detalle
 *
 * @property Personas $persona
 */
class PersonaPublicaciones extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%persona_publicaciones}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persona_id'], 'integer'],
            [['nombre', 'editorial'], 'required'],
            [['detalle'], 'string'],
            [['nombre', 'editorial'], 'string', 'max' => 40],
            [['isbn'], 'string', 'max' => 30],
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
            'nombre' => Yii::t('base_labels', 'Nombre'),
            'editorial' => Yii::t('base_labels', 'Editorial'),
            'isbn' => Yii::t('base_labels', 'Isbn'),
            'detalle' => Yii::t('base_labels', 'Detalle'),
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
     * @return PersonaPublicacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonaPublicacionesQuery(get_called_class());
    }
}
