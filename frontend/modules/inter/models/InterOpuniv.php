<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_opuniv}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $convocatoria_id
 * @property int|null $univop_id
 * @property int|null $prioridad
 * @property string|null $comentarios
 *
 * @property Universidades $universidad
 * @property Facultades $facultad
 */
class InterOpuniv extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_opuniv}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'convocatoria_id', 'univop_id', 'prioridad'], 'integer'],
            [['comentarios'], 'string'],
             [['prioridad'], 'unique','targetAttribute'=>['prioridad','convocatoria_id']],
             [['univop_id'], 'unique','targetAttribute'=>['univop_id','convocatoria_id']],
             
            //[['univop_id','convocatoria_id'], 'unique'],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => m::t('labels', 'ID'),
            'University Id' => m::t('labels', 'University'),
            'Facultaty Id' => m::t('labels', 'Faculty'),
            'Announcement Id' => m::t('labels', 'Announcement Id'),
            'UnivOp Id' => m::t('labels', 'Univop Id'),
            'Priority' => m::t('labels', 'Priority'),
            'Comments' => m::t('labels', 'Comments'),
        ];
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
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getConvocatoria()
    {
        return $this->hasOne(InterConvocados::className(), ['id' => 'convocatoria_id']);
    }
    
    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getUnivop()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'univop_id']);
    }
    
    /**
     * {@inheritdoc}
     * @return InterOpunivQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterOpunivQuery(get_called_class());
    }
}
