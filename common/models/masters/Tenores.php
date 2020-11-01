<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%tenores}}".
 *
 * @property int $id
 * @property int $universidad_id
 * @property int $facultad_id
 * @property string $codocu
 * @property string|null $activo
 * @property string|null $idioma
 * @property string|null $posic
 * @property string|null $texto
 * @property int|null $order
 *
 * @property Facultades $facultad
 * @property Documentos $codocu0
 * @property Universidades $universidad
 */
class Tenores extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tenores}}';
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
            [['universidad_id', 'facultad_id', 'codocu'], 'required'],
            [['universidad_id', 'facultad_id', 'order'], 'integer'],
            [['texto'], 'string'],
            [['codocu'], 'string', 'max' => 3],
            [['activo', 'posic'], 'string', 'max' => 1],
            [['idioma'], 'string', 'max' => 2],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'universidad_id' => Yii::t('base_labels', 'University'),
            'facultad_id' => Yii::t('base_labels', 'Faculty'),
            'codocu' => Yii::t('base_labels', 'Document Code'),
            'activo' => Yii::t('base_labels', 'Active'),
            'idioma' => Yii::t('base_labels', 'Language'),
            'posic' => Yii::t('base_labels', 'Position'),
            'texto' => Yii::t('base_labels', 'Text'),
            'order' => Yii::t('base_labels', 'Order'),
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
     * Gets query for [[Codocu0]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
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
     * {@inheritdoc}
     * @return TenoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TenoresQuery(get_called_class());
    }
}
