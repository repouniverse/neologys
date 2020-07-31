<?php

namespace common\models\masters;
use common\interfaces\identidadesInterface;
use Yii;

/**
 * This is the model class for table "{{%alumnos}}".
 *
 * @property int $id
 * @property string $codalu
 * @property string|null $codalu1
 * @property string|null $codalu2
 * @property string|null $codper
 * @property string|null $ap
 * @property string|null $am
 * @property string|null $nombres
 * @property string $codpering
 * @property string $codfac
 * @property string|null $codesp
 */
class Alumnos extends \common\models\base\modelBase 
implements identidadesInterface
{
    /*
     * porpeidades privadas
     * 
     */
    
    
    /*
     * CAMpO PARA IDENTIFICAR
     * EL TIPO DE IDENTIFICACION
     */

    const SCE_CREACION_BASICA='base';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%alumnos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codalu', 'codpering', 'codfac'], 'required'],
            
            /* PARA ESCENARIOBASICO*/
            [[
            'ap', 'am',
            'nombres',  'codalu'
            ],'required','on'=>self::SCE_CREACION_BASICA
            ],
            
            /*****/
            [['codalu', 'codalu1', 'codalu2'], 'string', 'max' => 16],
            [['codper', 'codesp'], 'string', 'max' => 8],
            [['ap', 'am', 'nombres'], 'string', 'max' => 40],
            [['codpering', 'codfac'], 'string', 'max' => 10],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_CREACION_BASICA] = [
            'ap', 'am',
            'nombres', 'tipodoc', 'codalu'
            ];
        /*$scenarios[self::SCENARIO_ASISTIO] = ['asistio'];
        $scenarios[self::SCENARIO_PSICO] = ['codtra'];
        $scenarios[self::SCENARIO_ACTIVO] = ['activo'];
        $scenarios[self::SCENARIO_REPROGRAMA] = ['fechaprog', 'duracion', 'finicio', 'ftermino', 'codtra'];
        */return $scenarios;
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.labels', 'ID'),
            'codalu' => Yii::t('base.labels', 'Codalu'),
            'codalu1' => Yii::t('base.labels', 'Codalu1'),
            'codalu2' => Yii::t('base.labels', 'Codalu2'),
            'codper' => Yii::t('base.labels', 'Codper'),
            'ap' => Yii::t('base.labels', 'Ap'),
            'am' => Yii::t('base.labels', 'Am'),
            'nombres' => Yii::t('base.labels', 'Nombres'),
            'codpering' => Yii::t('base.labels', 'Codpering'),
            'codfac' => Yii::t('base.labels', 'Codfac'),
            'codesp' => Yii::t('base.labels', 'Codesp'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AlumnosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AlumnosQuery(get_called_class());
    }
    
    
    
    /*
     * Permite crear una persosna a partir de estos datos 
     */
    public function createPersonFromThis() {
        ;
    }
}
