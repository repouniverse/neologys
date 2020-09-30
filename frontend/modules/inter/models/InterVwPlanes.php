<?php

namespace frontend\modules\inter\models;

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
            'id' => Yii::t('base_labels', 'ID'),
            'universidad_id' => Yii::t('base_labels', 'Universidad ID'),
            'facultad_id' => Yii::t('base_labels', 'Facultad ID'),
            'depa_id' => Yii::t('base_labels', 'Depa ID'),
            'eval_id' => Yii::t('base_labels', 'Eval ID'),
            'modo_id' => Yii::t('base_labels', 'Modo ID'),
            'programa_id' => Yii::t('base_labels', 'Programa ID'),
            'clase' => Yii::t('base_labels', 'Clase'),
            'status' => Yii::t('base_labels', 'Status'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'acronimo' => Yii::t('base_labels', 'Acronimo'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'detalles' => Yii::t('base_labels', 'Detalles'),
            'orden' => Yii::t('base_labels', 'Secuencia'),
            'requisito_id' => Yii::t('base_labels', 'Requisito ID'),
            'etapa' => Yii::t('base_labels', 'Etapa'),
            'etapa_id' => Yii::t('base_labels', 'Etapa ID'),
            'ordenetapa' => Yii::t('base_labels', 'Etapa'),
            'finicio' => Yii::t('base_labels', 'Finicio'),
            'notificamail' => Yii::t('base_labels', 'Notificamail'),
            'acromodo' => Yii::t('base_labels', 'Acromodo'),
            'descrimodo' => Yii::t('base_labels', 'Descrimodo'),
            'acroeval' => Yii::t('base_labels', 'Acroeval'),
            'descrieval' => Yii::t('base_labels', 'Descrieval'),
            'codperiodo' => Yii::t('base_labels', 'Codperiodo'),
            'descrietapa' => Yii::t('base_labels', 'Descrietapa'),
            'ap' => Yii::t('base_labels', 'Ap'),
            'am' => Yii::t('base_labels', 'Am'),
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'nombredepa' => Yii::t('base_labels', 'Nombredepa'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'nombrecarrera' => Yii::t('base_labels', 'Nombrecarrera'),
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
