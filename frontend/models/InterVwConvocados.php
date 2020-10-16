<?php

namespace app\models;

use Yii;
use \common\traits\identidadTrait;
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
use identidadTrait;
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
            'id' => Yii::t('base_labels', 'ID'),
            'universidad_id' => Yii::t('base_labels', 'University'),
            'facultad_id' => Yii::t('base_labels', 'Faculty'),
            'depa_id' => 'Depa ID',
            'modo_id' => Yii::t('base_labels', 'Mode'),
            'codperiodo' => Yii::t('base_labels', 'Period Code'),
            'codocu' => Yii::t('base_labels', 'Document Code'),
            'programa_id' => Yii::t('base_labels', 'Program'),
            'clase' => Yii::t('base_labels', 'Class'),
            'status' => Yii::t('base_labels', 'Status'),
            'secuencia' => Yii::t('base_labels', 'Sequence'),
            'alumno_id' => Yii::t('base_labels', 'Student'),
            'docente_id' => Yii::t('base_labels', 'Teacher'),
            'persona_id' => Yii::t('base_labels', 'Person'),
            'identidad_id' => Yii::t('base_labels', 'Identity'),
            'codalu' => Yii::t('base_labels', 'Code Student'),
            'codigo1' => Yii::t('base_labels', 'Code Student 1'),
            'codigo2' => Yii::t('base_labels', 'Code Student 2'),
            'am' => Yii::t('base_labels', 'Mother Last Name'),
            'ap' => Yii::t('base_labels', 'Last Name'),
            'nombres' => Yii::t('base_labels', 'Names'),
            'acronimo' => Yii::t('base_labels', 'Acronym'),
            'descripcion' => Yii::t('base_labels', 'Description'),
            'desprograma' => Yii::t('base_labels', 'Desprogram'),
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
