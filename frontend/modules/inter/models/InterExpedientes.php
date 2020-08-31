<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Documentos;
use common\models\masters\Periodos;
use common\models\masters\Carreras;
use common\models\masters\Personas;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_expedientes}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $programa_id
 * @property int|null $modo_id
 * @property int|null $convocado_id
 * @property string $clase
 * @property string $status
 * @property string $codocu
 * @property string|null $fpresenta
 * @property string|null $fdocu
 * @property string|null $detalles
 * @property string|null $textointerno
 * @property string $estado
 * @property string $requerido
 *
 * @property Documentos $codocu0
 * @property InterModos $modo
 * @property Facultades $facultad
 * @property Universidades $universidad
 * @property InterConvocados $convocado
 * @property Departamentos $depa
 */
class InterExpedientes extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_expedientes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'depa_id', 'programa_id', 'modo_id', 'convocado_id'], 'integer'],
            [['clase', 'status', 'codocu', 'estado', 'requerido'], 'required'],
            [['detalles', 'textointerno'], 'string'],
            [['clase', 'status', 'estado', 'requerido'], 'string', 'max' => 1],
            [['codocu'], 'string', 'max' => 3],
            [['fpresenta', 'fdocu'], 'string', 'max' => 10],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
            [['modo_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterModos::className(), 'targetAttribute' => ['modo_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['convocado_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterConvocados::className(), 'targetAttribute' => ['convocado_id' => 'id']],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'universidad_id' => m::t('labels', 'University'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'depa_id' => m::t('labels', 'Departament'),
            'programa_id' => m::t('labels', 'Program'),
            'modo_id' => m::t('labels', 'Mode'),
            'convocado_id' => m::t('labels', 'Summoned Id'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'codocu' => m::t('labels', 'Document Code'),
            'fpresenta' => m::t('labels', 'Presentation Date'),
            'fdocu' => m::t('labels', 'Document Date'),
            'detalles' => m::t('labels', 'Details'),
            'textointerno' => m::t('labels', 'Internal Text'),
            'estado' => m::t('labels', 'Status'),
            'requerido' => m::t('labels', 'Required'),
        ];
    }

    /**
     * Gets query for [[Codocu0]].
     *
     * @return \yii\db\ActiveQuery|DocumentosQuery
     */
    public function getCodocu0()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
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
     * Gets query for [[Convocado]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosQuery
     */
    public function getConvocado()
    {
        return $this->hasOne(InterConvocados::className(), ['id' => 'convocado_id']);
    }

    /**
     * Gets query for [[Depa]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepa()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'depa_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterExpedientesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterExpedientesQuery(get_called_class());
    }
}
