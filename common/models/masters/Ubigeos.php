<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%ubigeos}}".
 *
 * @property int $id
 * @property string $coddepa
 * @property string $codprov
 * @property string $coddist
 * @property string $departamento
 * @property string $provincia
 * @property string $distrito
 */
class Ubigeos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ubigeos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coddepa', 'codprov', 'coddist', 'departamento', 'provincia', 'distrito'], 'required'],
            [['coddepa', 'codprov', 'coddist'], 'string', 'max' => 3],
            [['departamento', 'provincia', 'distrito'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_names', 'ID'),
            'coddepa' => Yii::t('base_names', 'Department Code'),
            'codprov' => Yii::t('base_names', 'Province Code'),
            'coddist' => Yii::t('base_names', 'District Code'),
            'departamento' => Yii::t('base_names', 'Department'),
            'provincia' => Yii::t('base_names', 'Province'),
            'distrito' => Yii::t('base_names', 'District'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UbigeosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UbigeosQuery(get_called_class());
    }
}
