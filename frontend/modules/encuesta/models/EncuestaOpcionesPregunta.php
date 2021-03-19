<?php

namespace frontend\modules\encuesta\models;

use Yii;

/**
 * This is the model class for table "{{%encuesta_opciones_pregunta}}".
 *
 * @property int $id
 * @property int $id_pregunta
 * @property string $valor
 * @property string $descripcion
 *
 * @property EncuestaPreguntaEncuesta $pregunta
 */
class EncuestaOpcionesPregunta extends \common\models\base\modelBase 
{   
    public $array1 = [];
    public $array2 = [];
    public $array3 = [];
    public $array4 = [];
    public $array5 = [];
    public $array6 = [];
    public $array7 = [];
    public $array8 = [];
    public $array9 = [];
    public $array10 = [];
    public $array11= [];
    public $array12 = [];
    public $array13 = [];
    public $array14 = [];
    public $array15 = [];
    public $array16 = [];
    public $array17 = [];
    public $array18 = [];
    public $array19 = [];
    public $array20 = [];
    public $array21 = [];
    public $array22 = [];
    public $array23 = [];
    public $array24 = [];
    public $array25 = [];
    public $array26 = [];
    public $array27 = [];
    public $array28 = [];
    public $array29 = [];
    public $array30 = [];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%encuesta_opciones_pregunta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pregunta', 'valor', 'descripcion'], 'required'],
            [['id_pregunta'], 'integer'],            
            [['array','array2', 
            'array3' ,
            'array4' ,
            'array5' ,
            'array6' ,
            'array7' ,
            'array8' ,
            'array9' ,
            'array10',
            'array11',
            'array12',
            'array13',
            'array14',
            'array15',
            'array16',
            'array17',
            'array18',
            'array19',
            'array20',
            'array21',
            'array22',
            'array23',
            'array24',
            'array25',
            'array26',
            'array27',
            'array28',
            'array29',
            'array30'],'each', 'rule' => ['string']],
            [['valor', 'descripcion'], 'string', 'max' => 30],
            [['id_pregunta'], 'exist', 'skipOnError' => true, 'targetClass' => EncuestaPreguntaEncuesta::className(), 'targetAttribute' => ['id_pregunta' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'id_pregunta' => Yii::t('base_labels', 'Id Pregunta'),
            'valor' => Yii::t('base_labels', 'Valor'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'array'=> Yii::t('base_labels', 'Opciones De Pregunta'),
        ];
    }

    /**
     * Gets query for [[Pregunta]].
     *
     * @return \yii\db\ActiveQuery|EncuestaPreguntaEncuestaQuery
     */
    public function getPregunta()
    {
        return $this->hasOne(EncuestaPreguntaEncuesta::className(), ['id' => 'id_pregunta']);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaOpcionesPreguntaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EncuestaOpcionesPreguntaQuery(get_called_class());
    }
}
