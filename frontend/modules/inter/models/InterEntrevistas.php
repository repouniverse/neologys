<?php

namespace frontend\modules\inter\models;

use Yii;

/**
 * This is the model class for table "7pxv4v_inter_entrevistas".
 *
 * @property int $id
 * @property int $facultad_id
 * @property int $etapa_id
 * @property int $universidad_id
 * @property int $modo_id
 * @property string|null $codperiodo
 * @property int $expediente_id
 * @property int $convocado_id
 * @property int $persona_id
 * @property string|null $finicio
 * @property string|null $numero
 * @property string|null $ftermino
 * @property string|null $asistio
 * @property string|null $detalles
 * @property string|null $detalles_secre
 * @property string $activo
 * @property string $masivo
 * @property int $duracion
 * @property string $codfac
 * @property int $flujo_id
 *
 * @property InterEtapas $etapa
 * @property InterExpedientes $expediente
 * @property InterModos $modo
 * @property Facultades $facultad
 * @property Universidades $universidad
 */
class InterEntrevistas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_entrevistas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['facultad_id', 'etapa_id', 'universidad_id', 'modo_id', 'expediente_id', 'convocado_id', 'persona_id', 'activo', 'masivo', 'duracion', 'codfac', 'flujo_id'], 'required'],
            [['facultad_id', 'etapa_id', 'universidad_id', 'modo_id', 'expediente_id', 'convocado_id', 'persona_id', 'duracion', 'flujo_id'], 'integer'],
            [['detalles', 'detalles_secre'], 'string'],
            [['codperiodo', 'finicio', 'ftermino'], 'string', 'max' => 19],
            [['numero', 'codfac'], 'string', 'max' => 8],
            [['asistio', 'activo', 'masivo'], 'string', 'max' => 1],
            [['etapa_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterEtapas::className(), 'targetAttribute' => ['etapa_id' => 'id']],
            [['expediente_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterExpedientes::className(), 'targetAttribute' => ['expediente_id' => 'id']],
            [['modo_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterModos::className(), 'targetAttribute' => ['modo_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'facultad_id' => 'Facultad ID',
            'etapa_id' => 'Etapa ID',
            'universidad_id' => 'Universidad ID',
            'modo_id' => 'Modo ID',
            'codperiodo' => 'Codperiodo',
            'expediente_id' => 'Expediente ID',
            'convocado_id' => 'Convocado ID',
            'persona_id' => 'Persona ID',
            'finicio' => 'Finicio',
            'numero' => 'Numero',
            'ftermino' => 'Ftermino',
            'asistio' => 'Asistio',
            'detalles' => 'Detalles',
            'detalles_secre' => 'Detalles Secre',
            'activo' => 'Activo',
            'masivo' => 'Masivo',
            'duracion' => 'Duracion',
            'codfac' => 'Codfac',
            'flujo_id' => 'Flujo ID',
        ];
    }

    /**
     * Gets query for [[Etapa]].
     *
     * @return \yii\db\ActiveQuery|InterEtapasQuery
     */
    public function getEtapa()
    {
        return $this->hasOne(InterEtapas::className(), ['id' => 'etapa_id']);
    }

    /**
     * Gets query for [[Expediente]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getExpediente()
    {
        return $this->hasOne(InterExpedientes::className(), ['id' => 'expediente_id']);
    }

    /**
     * Gets query for [[Modo]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getModo()
    {
        return $this->hasOne(InterModos::className(), ['id' => 'modo_id']);
    }

    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterEntrevistasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterEntrevistasQuery(get_called_class());
    }
}
