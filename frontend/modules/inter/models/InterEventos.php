<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use Yii;

/**
 * This is the model class for table "{{%inter_eventos}}".
 *
 * @property int $id
 * @property int $facultad_id
 * @property int $universidad_id
 * @property string|null $finicio
 * @property string|null $ftermino
 * @property string|null $web
 * @property string|null $numero
 * @property string|null $descripcion
 * @property string|null $ciudad
 * @property string|null $detalles
 *
 * @property Universidades $universidad
 * @property Facultades $facultad
 */
class InterEventos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public $prefijo='39';
    public $finicio1=null;
    public static function tableName()
    {
        return '{{%inter_eventos}}';
    }
 public $dateorTimeFields = [
         'finicio' => self::_FDATE,
      'finicio1' => self::_FDATE,
        'ftermino' => self::_FDATE,
        //'ftermino' => self::_FDATETIME
    ];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['facultad_id', 'universidad_id'], 'required'],
            [['facultad_id', 'universidad_id'], 'integer'],
            [['detalles'], 'string'],
            [['finicio', 'ftermino', 'numero'], 'string', 'max' => 10],
            [['web'], 'string', 'max' => 100],
            [['descripcion', 'ciudad'], 'string', 'max' => 40],
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
            'id' => Yii::t('base_labels', 'ID'),
            'facultad_id' => Yii::t('base_labels', 'Facultad ID'),
            'universidad_id' => Yii::t('base_labels', 'Universidad ID'),
            'finicio' => Yii::t('base_labels', 'Finicio'),
            'ftermino' => Yii::t('base_labels', 'Ftermino'),
            'web' => Yii::t('base_labels', 'Web'),
            'numero' => Yii::t('base_labels', 'Numero'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'ciudad' => Yii::t('base_labels', 'Ciudad'),
            'detalles' => Yii::t('base_labels', 'Detalles'),
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
     * {@inheritdoc}
     * @return InterEventosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterEventosQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        if($insert){
            $this->numero=$this->correlativo('numero');
        }
        return parent::beforeSave($insert);
    }
}
