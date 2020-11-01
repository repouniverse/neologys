<?php

namespace frontend\modules\inter\models;
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Carreras;
use frontend\modules\inter\Module as m;

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
            [['carrera_id'], 'safe'],
            [['finicio', 'ftermino', 'numero'], 'string', 'max' => 10],
            [['web'], 'string', 'max' => 100],
            [['descripcion', 'ciudad'], 'string', 'max' => 40],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
             [['carrera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['carrera_id' => 'id']],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'universidad_id' => m::t('labels', 'University'),
            'finicio' => m::t('labels', 'Begin Date'),
            'ftermino' => m::t('labels', 'End Date'),
            'web' => m::t('labels', 'Web'),
            'numero' => m::t('labels', 'Number'),
            'descripcion' => m::t('labels', 'Description'),
            'ciudad' => m::t('labels', 'City'),
            'detalles' => m::t('labels', 'Details'),
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
    
     public function getCarrera()
    {
        return $this->hasOne(Carreras::className(), ['id' => 'carrera_id']);
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
