<?php


namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%departamentos}}".
 *
 * @property string $coddepa
 * @property string $nombredepa
 * @property string|null $detalles
 * @property string|null $correodepa
 * @property string|null $webdepa
 * @property string|null $codigoper
 * @property int|null $universidad_id
 * @property string|null $facultad_id
 *
 * @property Personas $codigoper0
 * @property InterConvocadosAlu[] $interConvocadosAlus
 * @property InterConvocatoria[] $interConvocatorias
 * @property InterPrograma[] $interProgramas
 */
class Departamentos extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%departamentos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'nombredepa'], 'required'],
            [['detalles'], 'string'],
            [['universidad_id'], 'integer'],
            [['coddepa', 'facultad_id'], 'string', 'max' => 10],
            [['nombredepa'], 'string', 'max' => 40],
            [['correodepa'], 'string', 'max' => 80],
            [['webdepa'], 'string', 'max' => 100],
            [['codigoper'], 'string', 'max' => 8],
            [['coddepa'], 'unique'],
            [['codigoper'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['codigoper' => 'codigoper']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coddepa' => Yii::t('base.labels', 'Coddepa'),
            'nombredepa' => Yii::t('base.labels', 'Nombredepa'),
            'detalles' => Yii::t('base.labels', 'Detalles'),
            'correodepa' => Yii::t('base.labels', 'Correodepa'),
            'webdepa' => Yii::t('base.labels', 'Webdepa'),
            'codigoper' => Yii::t('base.labels', 'Codigoper'),
            'universidad_id' => Yii::t('base.labels', 'Universidad ID'),
            'facultad_id' => Yii::t('base.labels', 'Codfac'),
        ];
    }

    /**
     * Gets query for [[Codigoper0]].
     *
     * @return \yii\db\ActiveQuery|PersonasQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['codigoper' => 'codigoper']);
    }
    
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['facultad_id' => 'facultad_id']);
    }

    /**
     * Gets query for [[InterConvocadosAlus]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosAluQuery
     */
    public function getInterConvocadosAlus()
    {
        ///return $this->hasMany(InterConvocadosAlu::className(), ['coddepa' => 'coddepa']);
    }

    /**
     * Gets query for [[InterConvocatorias]].
     *
     * @return \yii\db\ActiveQuery|InterConvocatoriaQuery
     */
    public function getInterConvocatorias()
    {
       // return $this->hasMany(InterConvocatoria::className(), ['coddepa' => 'coddepa']);
    }

    /**
     * Gets query for [[InterProgramas]].
     *
     * @return \yii\db\ActiveQuery|InterProgramaQuery
     */
    public function getInterProgramas()
    {
        //return $this->hasMany(InterPrograma::className(), ['coddepa' => 'coddepa']);
    }

    /**
     * {@inheritdoc}
     * @return DepartamentosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartamentosQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        if($insert){
          $this->prefijo='45';
          $this->coddepa=$this->correlativo('coddepa',7);
         
          
        }
       RETURN parent::beforeSave($insert);
    }
}
