<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%facultades}}".
 *
 * @property string $codfac
 * @property string $desfac
 * @property string|null $code1
 * @property string|null $code2
 * @property string|null $code3
 */
class Facultades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%facultades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codfac', 'desfac','universidad_id'], 'required'],
            [['codfac'], 'string', 'max' => 10],
            [['desfac'], 'string', 'max' => 60],
            [['universidad_id'], 'safe'],
            [['code1', 'code2'], 'string', 'max' => 2],
            [['code3'], 'string', 'max' => 3],
            [['codfac'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codfac' => Yii::t('base.labels', 'Codfac'),
            'desfac' => Yii::t('base.labels', 'Desfac'),
            'code1' => Yii::t('base.labels', 'Code1'),
            'code2' => Yii::t('base.labels', 'Code2'),
            'code3' => Yii::t('base.labels', 'Code3'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return FacultadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FacultadesQuery(get_called_class());
    }
}
