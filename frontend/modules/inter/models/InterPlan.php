<?php
use common\models\masters\Universidades;
use common\models\masters\Facultades;
use common\models\masters\Departamentos;
use common\models\masters\Periodos;
use common\models\masters\Carreras;
use common\models\masters\Personas;
namespace frontend\modules\inter\models;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_plan}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $eval_id
 * @property int|null $modo_id
 * @property int|null $programa_id
 * @property string $clase
 * @property string $status
 * @property string $codocu
 * @property string $acronimo
 * @property string $descripcion
 * @property string|null $detalles
 *
 * @property InterEvaluadores $eval
 * @property Facultades $facultad
 * @property InterModos $modo
 * @property Departamentos $depa
 * @property Universidades $universidad
 */
class InterPlan extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_plan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'facultad_id', 'depa_id', 'eval_id', 'modo_id', 'programa_id'], 'integer'],
            [['acronimo', 'descripcion'], 'required'],
            [['detalles'], 'string'],
             [['orden','requisito_id'], 'safe'],
            [['clase', 'status'], 'string', 'max' => 1],
            [['codocu'], 'string', 'max' => 3],
            [['acronimo', 'descripcion'], 'string', 'max' => 40],
            [['eval_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterEvaluadores::className(), 'targetAttribute' => ['eval_id' => 'id']],
            [['facultad_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Facultades::className(), 'targetAttribute' => ['facultad_id' => 'id']],
            [['modo_id'], 'exist', 'skipOnError' => true, 'targetClass' => InterModos::className(), 'targetAttribute' => ['modo_id' => 'id']],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Departamentos::className(), 'targetAttribute' => ['depa_id' => 'id']],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\masters\Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            //[['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'id' => m::t('labels', 'ID'),
            'universidad_id' => m::t('labels', 'University'),
            'facultad_id' => m::t('labels', 'Faculty'),
            'depa_id' => m::t('labels', 'Departament'),
            'eval_id' => m::t('labels', 'Evaluator'),
            'modo_id' => m::t('labels', 'Mode'),
            'programa_id' => m::t('labels', 'Program'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'codocu' => m::t('labels', 'Document Code'),
            'acronimo' => m::t('labels', 'Acronym'),
            'descripcion' => m::t('labels', 'Description'),
            'detalles' => m::t('labels', 'Details'),
        ];
    }

    /**
     * Gets query for [[Eval]].
     *
     * @return \yii\db\ActiveQuery|InterEvaluadoresQuery
     */
    public function getEval()
    {
        return $this->hasOne(InterEvaluadores::className(), ['id' => 'eval_id']);
    }

    
    public function getDocumento()
    {
        return $this->hasOne(\common\models\masters\Documentos::className(), ['codocu' => 'codocu']);
    }
    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadesQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(\common\models\masters\Facultades::className(), ['id' => 'facultad_id']);
    }

    /**
     * Gets query for [[Modo]].
     *
     * @return \yii\db\ActiveQuery|InterModosQuery
     */
    public function getModo()
    {
        return $this->hasOne(InterModos::className(), ['id' => 'modo_id']);
    }

    /**
     * Gets query for [[Depa]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepa()
    {
        return $this->hasOne(\common\models\masters\Departamentos::className(), ['id' => 'depa_id']);
    }

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(\common\models\masters\Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * {@inheritdoc}
     * @return InterPlanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterPlanQuery(get_called_class());
    }
    
    public function requisitosPosibles(){
       Return \yii\helpers\ArrayHelper::map(self::find()->select(['id','descripcion'])->andWhere([
            'programa_id'=>$this->programa_id,
            'modo_id'=>$this->modo_id,
        ])->andWhere(['<>','id',$this->id])->asArray(),
             'id','descripcion');
    }
}
