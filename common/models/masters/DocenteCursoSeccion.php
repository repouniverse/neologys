<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%docente_curso_seccion}}".
 *
 * @property int $id
 * @property int $curso_id
 * @property int $docente_id
 * @property string|null $seccion
 * @property string|null $activo
 *
 * @property Docentes $docente
 * @property Docentes $curso
 */
class DocenteCursoSeccion extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%docente_curso_seccion}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['curso_id', 'docente_id'], 'required'],
            [['curso_id', 'docente_id'], 'integer'],
            [['seccion'], 'string', 'max' => 12],
            [['activo'], 'string', 'max' => 1],
            [['docente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::className(), 'targetAttribute' => ['docente_id' => 'id']],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::className(), 'targetAttribute' => ['curso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'curso_id' => Yii::t('base_labels', 'Curso ID'),
            'docente_id' => Yii::t('base_labels', 'Docente ID'),
            'seccion' => Yii::t('base_labels', 'Seccion'),
            'activo' => Yii::t('base_labels', 'Activo'),
        ];
    }

    /**
     * Gets query for [[Docente]].
     *
     * @return \yii\db\ActiveQuery|DocentesQuery
     */
    public function getDocente()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'docente_id']);
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery|DocentesQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'curso_id']);
    }

    /**
     * {@inheritdoc}
     * @return DocenteCursoSeccionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocenteCursoSeccionQuery(get_called_class());
    }
    
    
}
