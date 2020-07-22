<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%grupo_parametros}}".
 *
 * @property int $id
 * @property string|null $codgrupo
 * @property string|null $descripcion
 * @property string|null $detalle
 */
class GrupoParametros extends \common\models\base\modelBase
{
   const PREFIX_ADVANCED = '/';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%grupo_parametros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detalle'], 'string'],
            [['codgrupo'], 'string', 'max' => 3],
            [['descripcion'], 'string', 'max' => 40],
        ];
    }

     public function behaviors() {
        return [
            
            'auditoriaBehavior' => [
                'class' => '\common\behaviors\AuditBehavior',
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend.base', 'ID'),
            'codgrupo' => Yii::t('backend.base', 'Codgrupo'),
            'descripcion' => Yii::t('backend.base', 'Descripcion'),
            'detalle' => Yii::t('backend.base', 'Detalle'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return GrupoParametrosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrupoParametrosQuery(get_called_class());
    }
}
