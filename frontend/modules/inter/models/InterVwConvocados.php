<?php

namespace frontend\modules\inter\models;

use Yii;

/**
 * This is the model class for table "7pxv4v_inter_vw_convocados".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $modo_id
 * @property string|null $codperiodo
 * @property string $codocu
 * @property int|null $programa_id
 * @property string $clase
 * @property string $status
 * @property int|null $secuencia
 * @property int|null $alumno_id
 * @property int|null $docente_id
 * @property int|null $persona_id
 * @property int|null $identidad_id
 * @property string|null $codalu
 * @property string|null $codigo1
 * @property string|null $codigo2
 * @property string|null $am
 * @property string|null $ap
 * @property string|null $nombres
 * @property string $acronimo
 * @property string $descripcion
 * @property string $desprograma
 */
class InterVwConvocados extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_vw_convocados}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id'], 'integer'],
            [['codocu', 'clase', 'status', 'acronimo', 'descripcion', 'desprograma'], 'required'],
            [['codperiodo'], 'string', 'max' => 10],
            [['codocu'], 'string', 'max' => 3],
            [['clase', 'status'], 'string', 'max' => 1],
            [['codalu', 'codigo1', 'codigo2'], 'string', 'max' => 16],
            [['am', 'ap', 'nombres', 'acronimo', 'descripcion', 'desprograma'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'universidad_id' => 'Universidad ID',
            'facultad_id' => 'Facultad ID',
            'depa_id' => 'Depa ID',
            'modo_id' => 'Modo ID',
            'codperiodo' => 'Codperiodo',
            'codocu' => 'Codocu',
            'programa_id' => 'Programa ID',
            'clase' => 'Clase',
            'status' => 'Status',
            'secuencia' => 'Secuencia',
            'alumno_id' => 'Alumno ID',
            'docente_id' => 'Docente ID',
            'persona_id' => 'Persona ID',
            'identidad_id' => 'Identidad ID',
            'codalu' => 'Codalu',
            'codigo1' => 'Codigo1',
            'codigo2' => 'Codigo2',
            'am' => 'Am',
            'ap' => 'Ap',
            'nombres' => 'Nombres',
            'acronimo' => 'Acronimo',
            'descripcion' => 'Descripcion',
            'desprograma' => 'Desprograma',
        ];
    }

    /**
     * {@inheritdoc}
     * @return InterVwConvocadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterVwConvocadosQuery(get_called_class());
    }
}
