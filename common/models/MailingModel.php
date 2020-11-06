<?php

namespace common\models;
use common\models\masters\Facultades;
use common\models\masters\Universidades;
use common\models\masters\Departamentos;
use common\models\masters\Documentos;
use Yii;


class MailingModel extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_MINIMO='escenario_minimo';
    
    public static function tableName()
    {
        return '{{%mailing}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'ruta'], 'required'],
            [['universidad_id', 'facultad_id', 'order'], 'integer'],
            [['cuerpo', 'copiato', 'texto'], 'string'],
            [['ruta'], 'string', 'max' => 64],
            [['transaccion'], 'unique',],
            [['activo', 'posic'], 'string', 'max' => 1],
            [['idioma', 'titulo'], 'string', 'max' => 5],
            [['remitente'], 'string', 'max' => 60],
            [['transaccion'], 'string', 'max' => 6],
            [['transaccion'], 'unique',],
            [['codocu'], 'string', 'max' => 3],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
    }

    
     public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_MINIMO] = ['universidad_id', 
            'facultad_id','ruta',
            ];
        
       
       return $scenarios;
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'universidad_id' => Yii::t('base_labels', 'Universidad ID'),
            'facultad_id' => Yii::t('base_labels', 'Facultad ID'),
            'ruta' => Yii::t('base_labels', 'Ruta'),
            'activo' => Yii::t('base_labels', 'Activo'),
            'idioma' => Yii::t('base_labels', 'Idioma'),
            'titulo' => Yii::t('base_labels', 'Titulo'),
            'remitente' => Yii::t('base_labels', 'Remitente'),
            'cuerpo' => Yii::t('base_labels', 'Cuerpo'),
            'copiato' => Yii::t('base_labels', 'Copiato'),
            'transaccion' => Yii::t('base_labels', 'Transaccion'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'posic' => Yii::t('base_labels', 'Posic'),
            'texto' => Yii::t('base_labels', 'Texto'),
            'order' => Yii::t('base_labels', 'Order'),
        ];
    }

    /**
     * Gets query for [[Codocu0]].
     *
     * @return \yii\db\ActiveQuery|DocumentosQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
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
     * {@inheritdoc}
     * @return MailingModelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MailingModelQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
       if($insert){
          $nameTransa=masters\Transacciones::findOne(['name'=>$this->ruta]);
          $this->transaccion=(is_null($nameTransa))?'':$nameTransa; 
       }
       return parent::beforeSave($insert);
    }
}
