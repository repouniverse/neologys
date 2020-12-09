<?php
namespace  frontend\modules\acad\models;
use common\models\masters\Docentes;
use yii;
class CabeceraAsignacionSyllabus extends \common\models\base\modelBase
{
    public $carrera_id=null;
    public $docente_id=null;
    public $plan_id=null;
    
    public static function tableName()
    {
        return '{{%planes}}';
    }
    
    public function rules()
    {
        return [
            [['docente_id', 'plan_id','carrera_id'], 'required'],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'carrera_id' => Yii::t('base_labels', 'Race'),
            'plan_id' => Yii::t('base_labels', 'Plan'),
        ];
    }
   
   public function getDocente()
    {
        return $this->hasOne(Docentes::className(), ['id' => 'docente_id']);
    }
    
}

