<?php

namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_vw_planes}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $eval_id
 * @property int|null $modo_id
 * @property int|null $programa_id
 * @property string $clase
 * @property string $status
 * @property string $codocu
 * @property string $acronimo
 * @property string $descripcion
 * @property string|null $detalles
 * @property int|null $orden
 * @property int|null $requisito_id
 * @property string|null $etapa
 * @property int|null $etapa_id
 * @property int|null $ordenetapa
 * @property string|null $finicio
 * @property string|null $notificamail
 * @property string $acromodo
 * @property string $descrimodo
 * @property string $acroeval
 * @property string $descrieval
 * @property string $codperiodo
 * @property string $descrietapa
 * @property string $ap
 * @property string $am
 * @property string $nombres
 * @property string $nombredepa
 * @property string|null $codesp
 * @property string $nombrecarrera
 */
class InterVwPlanes extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_vw_planes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'eval_id', 'modo_id', 'programa_id', 'orden', 'requisito_id', 'etapa_id', 'ordenetapa'], 'integer'],
            [['clase', 'status', 'codocu', 'acronimo', 'descripcion', 'acromodo', 'descrimodo', 'acroeval', 'descrieval', 'codperiodo', 'descrietapa', 'ap', 'am', 'nombres', 'nombredepa', 'nombrecarrera'], 'required'],
            [['detalles'], 'string'],
            [['clase', 'status', 'etapa', 'notificamail'], 'string', 'max' => 1],
            [['codocu'], 'string', 'max' => 3],
            [['acronimo', 'descripcion', 'acromodo', 'descrimodo', 'descrieval', 'ap', 'am', 'nombres', 'nombredepa'], 'string', 'max' => 40],
            [['finicio', 'acroeval', 'codperiodo'], 'string', 'max' => 10],
            [['descrietapa'], 'string', 'max' => 30],
            [['codesp'], 'string', 'max' => 8],
            [['nombrecarrera'], 'string', 'max' => 60],
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
            'depa_id' => m::t('labels', 'Depa ID'),
            'eval_id' => m::t('labels', 'Evaluator ID'),
            'modo_id' => m::t('labels', 'Mode ID'),
            'programa_id' => m::t('labels', 'Program'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'codocu' => m::t('labels', 'Document Code'),
            'acronimo' => m::t('labels', 'Acronym'),
            'descripcion' => m::t('labels', 'Description'),
            'detalles' => m::t('labels', 'Details'),
            'orden' => m::t('labels', 'Sequence'),
            'requisito_id' => m::t('labels', 'Requisito ID'),
            'etapa' => m::t('labels', 'Stage'),
            'etapa_id' => m::t('labels', 'Stage ID'),
            'ordenetapa' => m::t('labels', 'Etapa'),
            'finicio' => m::t('labels', 'Begin Date'),
            'notificamail' => m::t('labels', 'Notificamail'),
            'acromodo' => m::t('labels', 'Acromodo'),
            'descrimodo' => m::t('labels', 'Descrimodo'),
            'acroeval' => m::t('labels', 'Acroeval'),
            'descrieval' => m::t('labels', 'Descrieval'),
            'codperiodo' => m::t('labels', 'Period Code'),
            'descrietapa' => m::t('labels', 'Descrietapa'),
            'ap' => m::t('labels', 'Last Name'),
            'am' => m::t('labels', 'Mother Last Name'),
            'nombres' => m::t('labels', 'Names'),
            'nombredepa' => m::t('labels', 'Nombredepa'),
            'codesp' => m::t('labels', 'Codesp'),
            'nombrecarrera' => m::t('labels', 'Nombrecarrera'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return InterVwPlanesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterVwPlanesQuery(get_called_class());
    }
}
