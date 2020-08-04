<?php

namespace frontend\modules\inter\models;
use common\models\masters\Periodos;
use common\models\masters\Alumnos;
use common\models\masters\Facultades;
use common\models\masters\Universidades;
use common\models\masters\Personas;
use frontend\modules\inter\Module as InterModule;
use Yii;

/**
 * This is the model class for table "{{%inter_programa}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property string $codfac
 * @property string $codperiodo
 * @property string $coddepa
 * @property string|null $clase
 * @property int|null $programa_id
 * @property string $fopen
 * @property string $descripcion
 * @property string|null $detalles
 *
 * @property InterConvocadosAlu[] $interConvocadosAlus
 * @property InterConvocatorium[] $interConvocatoria
 * @property Periodo $codperiodo0
 * @property Departamento $coddepa0
 * @property Facultade $codfac0
 * @property Universidade $universidad
 */
class InterPrograma extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_programa}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id'], 'integer'],
            [['codfac', 'codperiodo', 'coddepa', 'fopen', 'descripcion'], 'required'],
            [['detalles'], 'string'],
             [['codigoper'], 'safe'],
            [['codfac', 'codperiodo', 'coddepa', 'fopen'], 'string', 'max' => 10],
            [['clase'], 'string', 'max' => 1],
            [['descripcion'], 'string', 'max' => 40],
            [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
            //[['coddepa'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['coddepa' => 'coddepa']],
            [['codfac'], 'exist', 'skipOnError' => true, 'targetClass' => Facultades::className(), 'targetAttribute' => ['codfac' => 'codfac']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.labels', 'ID'),
            'universidad_id' => Yii::t('base.labels', 'Universidad ID'),
            'codfac' => Yii::t('base.labels', 'Codfac'),
            'codperiodo' => Yii::t('base.labels', 'Codperiodo'),
            'coddepa' => Yii::t('base.labels', 'Coddepa'),
            'clase' => Yii::t('base.labels', 'Clase'),
            'programa_id' => Yii::t('base.labels', 'Programa ID'),
            'fopen' => Yii::t('base.labels', 'Fopen'),
            'descripcion' => Yii::t('base.labels', 'Descripcion'),
            'detalles' => Yii::t('base.labels', 'Detalles'),
        ];
    }

    /**
     * Gets query for [[InterConvocadosAlus]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosAluQuery
     */
    public function getInterConvocadosAlus()
    {
        //return $this->hasMany(InterConvocadosAlu::className(), ['programa_id' => 'id']);
    }

    /**
     * Gets query for [[InterConvocatoria]].
     *
     * @return \yii\db\ActiveQuery|InterConvocatoriumQuery
     */
    public function getInterConvocatoria()
    {
       // return $this->hasMany(InterConvocatorium::className(), ['programa_id' => 'id']);
    }

    /**
     * Gets query for [[Codperiodo0]].
     *
     * @return \yii\db\ActiveQuery|PeriodoQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(Periodos::className(), ['codperiodo' => 'codperiodo']);
    }

    /**
     * Gets query for [[Coddepa0]].
     *
     * @return \yii\db\ActiveQuery|DepartamentoQuery
     */
    /*public function getCoddepa0()
    {
        return $this->hasOne(Departamento::className(), ['coddepa' => 'coddepa']);
    }*/

    /**
     * Gets query for [[Codfac0]].
     *
     * @return \yii\db\ActiveQuery|FacultadeQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultades::className(), ['codfac' => 'codfac']);
    }

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadeQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }
    
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['codigoper' => 'codigoper']);
    }

    /**
     * {@inheritdoc}
     * @return InterProgramaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterProgramaQuery(get_called_class());
    }
    
    public function beforeSave($insert) {
        $this->clase=InterModule::CLASE_GENERAL;
        return parent::beforeSave($insert);
    }
}
