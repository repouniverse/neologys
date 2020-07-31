<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%universidades}}".
 *
 * @property int $id
 * @property string|null $codpais
 * @property string $nombre
 * @property string $acronimo
 * @property string|null $estado
 * @property string|null $detalle
 */
class Universidades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%universidades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'acronimo'], 'required'],
            [['detalle'], 'string'],
            [['codpais'], 'string', 'max' => 3],
            [['nombre'], 'string', 'max' => 60],
            [['acronimo'], 'string', 'max' => 12],
            [['estado'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.labels', 'ID'),
            'codpais' => Yii::t('base.labels', 'Country'),
            'nombre' => Yii::t('base.labels', 'Name'),
            'acronimo' => Yii::t('base.labels', 'Acronym'),
            'estado' => Yii::t('base.labels', 'State'),
            'detalle' => Yii::t('base.labels', 'Details'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UniversidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UniversidadesQuery(get_called_class());
    }
}
