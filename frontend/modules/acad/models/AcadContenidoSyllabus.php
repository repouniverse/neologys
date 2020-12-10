<?php

namespace frontend\modules\acad\models;

use Yii;

/**
 * This is the model class for table "{{%acad_contenido_syllabus}}".
 *
 * @property int $id
 * @property int $syllabus_id
 * @property int $n_semana
 * @property string|null $bloque1
 * @property string|null $bloque2
 * @property string|null $bloque3
 * @property string|null $bloque4
 * @property string|null $bloque5
 * @property string|null $bloque6
 * @property string|null $bloque7
 * @property string|null $bloque8
 * @property string|null $bloque9
 *
 * @property AcadSyllabus $syllabus
 */
class AcadContenidoSyllabus extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_contenido_syllabus}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['syllabus_id', 'n_semana'], 'required'],
            [['syllabus_id', 'n_semana'], 'integer'],
            [['unidad_id','n_horas_trabajo_indep','n_horas_cumplimiento','n_sesion','n_semana'], 'safe'],
            [['bloque1', 'bloque2', 'bloque3', 'bloque4', 'bloque5', 'bloque6', 'bloque7', 'bloque8', 'bloque9'], 'string'],
            [['syllabus_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadSyllabus::className(), 'targetAttribute' => ['syllabus_id' => 'id']],
             [['unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadSyllabusUnidades::className(), 'targetAttribute' => ['unidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'syllabus_id' => Yii::t('base_labels', 'Syllabus ID'),
            'n_semana' => Yii::t('base_labels', 'Week'),
            'bloque1' => Yii::t('base_labels', 'Conceptual contents'),
            'bloque2' => Yii::t('base_labels', 'Procedural contents'),
            'bloque3' => Yii::t('base_labels', 'Learning activity'),
            'bloque4' => Yii::t('base_labels', ''),
            'bloque5' => Yii::t('base_labels', ''),
            'bloque6' => Yii::t('base_labels', 'Bloque6'),
            'bloque7' => Yii::t('base_labels', 'Bloque7'),
            'bloque8' => Yii::t('base_labels', 'Bloque8'),
            'bloque9' => Yii::t('base_labels', 'Bloque9'),
        ];
    }

    /**
     * Gets query for [[Syllabus]].
     *
     * @return \yii\db\ActiveQuery|AcadSyllabusQuery
     */
    public function getSyllabus()
    {
        return $this->hasOne(AcadSyllabus::className(), ['id' => 'syllabus_id']);
    }
    
    public function getSyllabusUnidad()
    {
        return $this->hasOne(AcadSyllabusUnidades::className(), ['id' => 'unidadad_id']);
    }

    /**
     * {@inheritdoc}
     * @return AcadContenidoSyllabusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadContenidoSyllabusQuery(get_called_class());
    }
}
