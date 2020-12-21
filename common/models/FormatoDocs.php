<?php

namespace common\models;
use common\behaviors\FileBehavior;
use Yii;

/**
 * This is the model class for table "{{%formato_docs}}".
 *
 * @property int $id
 * @property string|null $codocu
 * @property string $descripcion
 * @property string|null $comentario
 */
class FormatoDocs extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%formato_docs}}';
    }

   public function behaviors() {
        return [
            
            'fileBehavior' => [
                'class' => FileBehavior::className()
            ],
            
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['comentario'], 'string'],
            [['codocu'], 'string', 'max' => 3],
            [['descripcion'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'comentario' => Yii::t('base_labels', 'Comentario'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return FormatoDocsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormatoDocsQuery(get_called_class());
    }
}
