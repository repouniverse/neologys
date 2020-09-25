<?php

namespace frontend\modules\inter\models;
use common\models\masters\Facultades;
use common\models\masters\Universidades;
use common\helpers\h;
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
            'id' => Yii::t('base_labels', 'ID'),
            'expediente_id' => Yii::t('base_labels', 'Expediente ID'),
            'facultad_id' => Yii::t('base_labels', 'Facultad ID'),
            'universidad_id' => Yii::t('base_labels', 'Universidad ID'),
            'convocado_id' => Yii::t('base_labels', 'Convocado ID'),
            'user_id' => Yii::t('base_labels', 'User ID'),
            'valido' => Yii::t('base_labels', 'Valido'),
            'detalles' => Yii::t('base_labels', 'Detalles'),
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
