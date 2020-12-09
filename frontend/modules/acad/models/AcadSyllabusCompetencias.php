<?php

namespace frontend\modules\acad\models;

use Yii;

/**
 * This is the model class for table "{{%acad_syllabus_competencias}}".
 *
 * @property int $id
 * @property int $syllabus_id
 * @property string $bloque TITULO DEL BLOQUE COMPETENCIAS
 * @property string $item_bloque
 * @property string|null $contenido_bloque
 *
 * @property AcadSyllabus $syllabus
 */
class AcadSyllabusCompetencias extends \common\models\base\modelBase
{
    
    
    public $booleanFields=['activo'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_syllabus_competencias}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['syllabus_id', 'bloque', 'item_bloque'], 'required'],
            [['syllabus_id'], 'integer'],
            [['contenido_bloque'], 'string'],
            [['bloque_padre','activo'], 'safe'],
            [['bloque'], 'string', 'max' => 60],
            [['item_bloque'], 'string', 'max' => 6],
            [['syllabus_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcadSyllabus::className(), 'targetAttribute' => ['syllabus_id' => 'id']],
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
            'bloque' => Yii::t('base_labels', 'Bloque'),
            'item_bloque' => Yii::t('base_labels', 'Item Bloque'),
            'contenido_bloque' => Yii::t('base_labels', 'Contenido Bloque'),
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

    /**
     * {@inheritdoc}
     * @return AcadSyllabusCompetenciasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadSyllabusCompetenciasQuery(get_called_class());
    }
}
