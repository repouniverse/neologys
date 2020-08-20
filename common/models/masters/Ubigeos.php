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
            'id' => Yii::t('base.names', 'ID'),
            'coddepa' => Yii::t('base.names', 'Coddepa'),
            'codprov' => Yii::t('base.names', 'Codprov'),
            'coddist' => Yii::t('base.names', 'Coddist'),
            'departamento' => Yii::t('base.names', 'Departamento'),
            'provincia' => Yii::t('base.names', 'Provincia'),
            'distrito' => Yii::t('base.names', 'Distrito'),
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
