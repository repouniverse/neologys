<?php

namespace common\models\masters;
use common\behaviors\FileBehavior;
use Yii;

/**
 * This is the model class for table "{{%universidades}}".
 *
 * @property int $id
 * @property string|null $codpais
 * @property string $nombre
 * @property string $acronimo
 * @property string|null $estado
 * @property string|null $detalle
 *
 * @property Alumnos[] $alumnos
 * @property Carreras[] $carreras
 * @property Departamentos[] $departamentos
 * @property Facultades[] $facultades
 * @property InterConvocados[] $interConvocados
 * @property InterEvaluadores[] $interEvaluadores
 * @property InterExpedientes[] $interExpedientes
 * @property InterModos[] $interModos
 * @property InterPlan[] $interPlans
 * @property InterPrograma[] $interProgramas
 */
class Universidades extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%universidades}}';
    }
    
     public function behaviors() {
        return [
           
            'fileBehavior' => [
                'class' => FileBehavior::className()
            ],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'acronimo','codpais'], 'required'],
            [['latitud', 'meridiano'], 'safe'],
            //[['latitud', 'meridiano'], 'decimal'],
            [['detalle'], 'string'],
            [['codpais'], 'string', 'max' => 3],
            [['nombre'], 'string', 'max' => 60],
            [['acronimo'], 'string', 'max' => 12],
            [['estado'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'codpais' => Yii::t('base_labels', 'Country Code'),
            'nombre' => Yii::t('base_labels', 'Name'),
            'acronimo' => Yii::t('base_labels', 'Acronym'),
            'estado' => Yii::t('base_labels', 'Status'),
            'detalle' => Yii::t('base_labels', 'Detail'),
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery|AlumnosQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[Carreras]].
     *
     * @return \yii\db\ActiveQuery|CarrerasQuery
     */
    public function getCarreras()
    {
        //return $this->hasMany(Carreras::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[Departamentos]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepartamentos()
    {
       // return $this->hasMany(Departamentos::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[Facultades]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultades()
    {
        //return $this->hasMany(Facultades::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[InterConvocados]].
     *
     * @return \yii\db\ActiveQuery|InterConvocadosQuery
     */
    public function getInterConvocados()
    {
        //return $this->hasMany(InterConvocados::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[InterEvaluadores]].
     *
     * @return \yii\db\ActiveQuery|InterEvaluadoresQuery
     */
    public function getInterEvaluadores()
    {
        //return $this->hasMany(InterEvaluadores::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[InterExpedientes]].
     *
     * @return \yii\db\ActiveQuery|InterExpedientesQuery
     */
    public function getInterExpedientes()
    {
        //return $this->hasMany(InterExpedientes::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[InterModos]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getInterModos()
    {
        //return $this->hasMany(InterModos::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[InterPlans]].
     *
     * @return \yii\db\ActiveQuery|InterPlanQuery
     */
    public function getInterPlans()
    {
       // return $this->hasMany(InterPlan::className(), ['universidad_id' => 'id']);
    }

    /**
     * Gets query for [[InterProgramas]].
     *
     * @return \yii\db\ActiveQuery|InterProgramaQuery
     */
    public function getInterProgramas()
    {
        //return $this->hasMany(InterPrograma::className(), ['universidad_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UniversidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UniversidadesQuery(get_called_class());
    }
    
    
    public function renderLogo($dimensiones=[]){
        if(count($dimensiones)==0)$dimensiones=[150,150];
        if($this->hasAttachments())
        return Html::img($this->files[0]->url,['height'=>$dimensiones[0],'width'=>$dimensiones[1]]);
        return '';
    }
    
    
}
