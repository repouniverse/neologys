<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%curso_area}}".
 *
 * @property int $id
 * @property string $codarea
 * @property string $nombre
 */
class CursoArea extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%curso_area}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codarea', 'nombre'], 'required'],
            [['codarea'], 'string', 'max' => 3],
            [['nombre'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'codarea' => Yii::t('base_labels', 'Codarea'),
            'nombre' => Yii::t('base_labels', 'Nombre'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CursoAreaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CursoAreaQuery(get_called_class());
    }
}
