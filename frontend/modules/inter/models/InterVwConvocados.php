<?php

namespace frontend\modules\inter\models;

use frontend\modules\inter\Module as m;
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
            [['codocu', 'clase', 'status', 'acronimo', 'descripcion', 'desprograma', 'codigoper'], 'required'],
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
            'id' => m::t('labels', 'ID'),
            'codigoper' => m::t('labels', 'Person Code'),
            'tipodoc' => m::t('labels', 'Document Type'),
            'numerodoc' => m::t('labels', 'Document Number'),
            'codgrupo' => m::t('labels', 'Group'),
            'universidad_id' => m::t('labels', 'University'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'depa_id' => m::t('labels', 'Departament'),
            'modo_id' => m::t('labels', 'Mode'),
            'codperiodo' => m::t('labels', 'Period Code'),
            'codocu' => m::t('labels', 'Document Code'),
            'programa_id' => m::t('labels', 'Program'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'secuencia' => m::t('labels', 'Sequence'),
            'alumno_id' => m::t('labels', 'Student'),
            'docente_id' => m::t('labels', 'Teacher'),
            'persona_id' => m::t('labels', 'Person'),
            'identidad_id' => m::t('labels', 'Identity'),
            'codalu' => m::t('labels', 'Student Code'),
            'codigo1' => m::t('labels', 'Code 1'),
            'codigo2' => m::t('labels', 'Code 2'),
            'am' => m::t('labels', 'Last Name'),
            'ap' => m::t('labels', 'Mother Last Name'),
            'nombres' => m::t('labels', 'Names'),
            'acronimo' => m::t('labels', 'Acronym'),
            'descripcion' => m::t('labels', 'Mode'),
            'desprograma' => m::t('labels', 'Deprogram'),
            'current_etapa' => m::t('labels', 'Current Stage'),
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
