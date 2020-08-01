<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%grupo_personas}}".
 *
 * @property string $codgrupo
 * @property string $desgrupo
 * @property string $modelo
 * @property string|null $detalle
 *
 * @property Persona[] $personas
 */
class GrupoPersonas extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%grupo_personas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codgrupo', 'desgrupo', 'modelo'], 'required'],
            [['detalle'], 'string'],
            [['codgrupo'], 'string', 'max' => 3],
            [['desgrupo'], 'string', 'max' => 60],
            [['modelo'], 'string', 'max' => 100],
            [['codgrupo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codgrupo' => Yii::t('base.labels', 'Codgrupo'),
            'desgrupo' => Yii::t('base.labels', 'Desgrupo'),
            'modelo' => Yii::t('base.labels', 'Modelo'),
            'detalle' => Yii::t('base.labels', 'Detalle'),
        ];
    }

    /**
     * Gets query for [[Personas]].
     *
     * @return \yii\db\ActiveQuery|PersonaQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['codgrupo' => 'codgrupo']);
    }

    /**
     * {@inheritdoc}
     * @return GrupoPersonasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrupoPersonasQuery(get_called_class());
    }
}
