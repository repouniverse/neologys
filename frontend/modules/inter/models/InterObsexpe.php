<?php

namespace frontend\modules\inter\models;
use common\models\masters\Facultades;
use common\models\masters\Universidades;
use common\helpers\h;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_obsexpe}}".
 *
 * @property int $id
 * @property int $expediente_id
 * @property int $facultad_id
 * @property int $universidad_id
 * @property int $convocado_id
 * @property int $user_id
 * @property string $valido
 * @property string|null $detalles
 *
 * @property Facultades $facultad
 * @property Universidades $universidad
 * @property InterExpedientes $expediente
 */
class InterObsexpe extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_obsexpe}}';
    }
public $booleanFields=['valido'];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expediente_id', 'facultad_id', 'universidad_id', 'convocado_id', 'valido'], 'required'],
            [['expediente_id', 'facultad_id', 'universidad_id', 'convocado_id', 'user_id'], 'integer'],
            [['detalles'], 'string'],
            //[['valido'], 'string', 'max' => 1],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['expediente_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterExpedientes::className(), 'targetAttribute' => ['expediente_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'expediente_id' => m::t('labels', 'Proceedings Id'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'universidad_id' => m::t('labels', 'University'),
            'convocado_id' => m::t('labels', 'Summoned ID'),
            'user_id' => m::t('labels', 'User ID'),
            'valido' => m::t('labels', 'Valid'),
            'detalles' => m::t('labels', 'Details'),
        ];
    }

    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * Gets query for [[Expediente]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getExpediente()
    {
        return $this->hasOne(InterExpedientes::className(), ['id' => 'expediente_id']);
    }
    
    public function getConvocado()
    {
        return $this->hasOne(InterConvocados::className(), ['id' => 'convocado_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterObsexpeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterObsexpeQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        if($insert){
        $this->user_id=h::userId();
         $this->valido=true;
        }
        return parent::beforeSave($insert);
    }
}
