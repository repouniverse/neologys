<?php

namespace frontend\modules\buzon\models;
use common\models\masters\Personas;
use common\models\masters\Departamentos;
use Yii;

/**
 * This is the model class for table "{{%buzon_administradores}}".
 *
 * @property int $id
 * @property int $persona_id
 * @property int $departamento_id
 * @property string $activo
 *
 * @property Personas $persona
 * @property Departamentos $departamento
 */
class BuzonAdministradores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%buzon_administradores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persona_id', 'departamento_id', 'activo'], 'required'],
            [['persona_id', 'departamento_id'], 'integer'],
            [['activo'], 'string', 'max' => 11],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_id' => 'id']],
            [['departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['departamento_id' => 'id']],
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
            'departamento_id' => Yii::t('base_labels', 'Departamento ID'),
            'activo' => Yii::t('base_labels', 'Activo'),
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
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'departamento_id']);
    }

    /**
     * {@inheritdoc}
     * @return BuzonAdministradoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuzonAdministradoresQuery(get_called_class());
    }
}
