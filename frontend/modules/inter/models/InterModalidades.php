<?php

namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_modalidades}}".
 *
 * @property int $id
 * @property int|null $programa_id
 * @property string $descripcion
 * @property string|null $detalles
 * @property string|null $textoexterno
 * @property string|null $slogan
 * @property string|null $local
 *
 * @property InterPrograma $programa
 */
class InterModalidades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_modalidades}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['programa_id'], 'integer'],
            [['descripcion'], 'required'],
            [['detalles', 'textoexterno', 'slogan'], 'string'],
            [['descripcion'], 'string', 'max' => 40],
            [['local'], 'string', 'max' => 1],
            [['programa_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterPrograma::className(), 'targetAttribute' => ['programa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'programa_id' => m::t('labels', 'Programa ID'),
            'descripcion' => m::t('labels', 'Descripcion'),
            'detalles' => m::t('labels', 'Detalles'),
            'textoexterno' => m::t('labels', 'Textoexterno'),
            'slogan' => m::t('labels', 'Slogan'),
            'local' => m::t('labels', 'Local'),
        ];
    }

    /**
     * Gets query for [[Programa]].
     *
     * @return \yii\db\ActiveQuery|InterProgramaQuery
     */
    public function getPrograma()
    {
        return $this->hasOne(InterPrograma::className(), ['id' => 'programa_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterModalidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterModalidadesQuery(get_called_class());
    }
}
