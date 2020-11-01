<?php

namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;

use Yii;

/**
 * This is the model class for table "7pxv4v_inter_idiomasalu".
 *
 * @property int $id
 * @property int|null $convocatoria_id
 * @property int|null $programa_id
 * @property int|null $modo_id
 * @property string $idioma
 * @property string $codnivel
 * @property string|null $detalle
 * @property string $certificado
 *
 * @property InterConvocados $convocatoria
 * @property InterModos $modo
 * @property InterPrograma $programa
 */
class InterIdiomasalu extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_idiomasalu}}';
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
    public function rules()
    {
        return [
            [['convocatoria_id', 'programa_id', 'modo_id'], 'integer'],
            [['idioma', 'codnivel',], 'required'],
            [['detalle'], 'string'],
            [['idioma'], 'string', 'max' => 3],
            [['codnivel', 'certificado'], 'string', 'max' => 1],
            [['convocatoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterConvocados::className(), 'targetAttribute' => ['convocatoria_id' => 'id']],
            [['modo_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterModos::className(), 'targetAttribute' => ['modo_id' => 'id']],
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
            'convocatoria_id' => m::t('labels', 'Announcement Id'),
            'programa_id' => m::t('labels', 'Program'),
            'modo_id' => m::t('labels', 'Mode ID'),
            'idioma' => m::t('labels', 'Language'),
            'codnivel' => m::t('labels', 'Level Code'),
            'detalle' => m::t('labels', 'Detail'),
            'certificado' => m::t('labels', 'Certificate'),
        ];
    }

    /**
     * Gets query for [[Convocatoria]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosQuery
     */
    public function getConvocatoria()
    {
        return $this->hasOne(InterConvocados::className(), ['id' => 'convocatoria_id']);
    }

    /**
     * Gets query for [[Modo]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getModo()
    {
        return $this->hasOne(InterModos::className(), ['id' => 'modo_id']);
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
     * @return InterIdiomasaluQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterIdiomasaluQuery(get_called_class());
    }
}
