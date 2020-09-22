<?php

namespace frontend\modules\inter\models;
use common\models\masters\Carreras;
use frontend\modules\inter\Module as m;
USE common\helpers\h;
use yii\helpers\Url;
use yii\helpers\Html;
use Yii;
/**
 * This is the model class for table "{{%inter_vw_convocados_docentes}}".
 *
 * @property int $id
 * @property int|null $universidad_id
 * @property int|null $facultad_id
 * @property int|null $depa_id
 * @property int|null $modo_id
 * @property string|null $codperiodo
 * @property string $codocu
 * @property int|null $programa_id
 * @property string $clase
 * @property string $status
 * @property int|null $secuencia
 * @property int|null $alumno_id
 * @property int|null $docente_id
 * @property int|null $persona_id
 * @property int|null $identidad_id
 * @property string|null $codalu
 * @property string|null $codigo1
 * @property string|null $codigo2
 * @property string|null $estado
 * @property string|null $motivos
 * @property int|null $current_etapa
 * @property string|null $pendiente
 * @property string|null $am
 * @property string $ap
 * @property string $nombres
 * @property string $codigoper
 * @property string|null $tipodoc
 * @property string|null $numerodoc
 * @property string $codgrupo
 * @property string $acronimo
 * @property string $descripcion
 * @property string $codigodocente
 */
class InterVwConvocadosDocentes extends \common\models\base\modelBase
{
    use \common\traits\identidadTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_vw_convocados_docentes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id', 'current_etapa'], 'integer'],
            [['codocu', 'clase', 'status', 'ap', 'nombres', 'codigoper', 'codgrupo', 'acronimo', 'descripcion', 'codigodocente'], 'required'],
            [['motivos'], 'string'],
            [['codperiodo'], 'string', 'max' => 10],
            [['codocu', 'codgrupo'], 'string', 'max' => 3],
            [['clase', 'status', 'estado', 'pendiente'], 'string', 'max' => 1],
            [['codalu', 'codigo1', 'codigo2', 'codigodocente'], 'string', 'max' => 16],
            [['am', 'ap', 'nombres', 'acronimo', 'descripcion'], 'string', 'max' => 40],
            [['codigoper'], 'string', 'max' => 8],
            [['tipodoc'], 'string', 'max' => 2],
            [['numerodoc'], 'string', 'max' => 20],
        ];
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
            'depa_id' => Yii::t('base_labels', 'Depa ID'),
            'modo_id' => Yii::t('base_labels', 'Modo ID'),
            'codperiodo' => Yii::t('base_labels', 'Codperiodo'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'programa_id' => Yii::t('base_labels', 'Programa ID'),
            'clase' => Yii::t('base_labels', 'Clase'),
            'status' => Yii::t('base_labels', 'Status'),
            'secuencia' => Yii::t('base_labels', 'Secuencia'),
            'alumno_id' => Yii::t('base_labels', 'Alumno ID'),
            'docente_id' => Yii::t('base_labels', 'Docente ID'),
            'persona_id' => Yii::t('base_labels', 'Persona ID'),
            'identidad_id' => Yii::t('base_labels', 'Identidad ID'),
            'codalu' => Yii::t('base_labels', 'Codalu'),
            'codigo1' => Yii::t('base_labels', 'Codigo1'),
            'codigo2' => Yii::t('base_labels', 'Codigo2'),
            'estado' => Yii::t('base_labels', 'Estado'),
            'motivos' => Yii::t('base_labels', 'Motivos'),
            'current_etapa' => Yii::t('base_labels', 'Current Etapa'),
            'pendiente' => Yii::t('base_labels', 'Pendiente'),
            'am' => Yii::t('base_labels', 'Am'),
            'ap' => Yii::t('base_labels', 'Ap'),
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'codigoper' => Yii::t('base_labels', 'Codigoper'),
            'tipodoc' => Yii::t('base_labels', 'Tipodoc'),
            'numerodoc' => Yii::t('base_labels', 'Numerodoc'),
            'codgrupo' => Yii::t('base_labels', 'Codgrupo'),
            'acronimo' => Yii::t('base_labels', 'Acronimo'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'codigodocente' => Yii::t('base_labels', 'Codigodocente'),
        ];
    }
public function getExpedientes()
    {
        return $this->hasMany(InterExpedientes::className(), ['convocado_id' => 'id']);
    }
    /**
     * {@inheritdoc}
     * @return InterVwConvocadosDocentesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterVwConvocadosDocentesQuery(get_called_class());
    }
    
        /*saca datos de los expedientes según etapas*/
 public function datosExpedientes(){
     $datos=[];$datos1=[];
     $registros=$this->getExpedientes()->orderBy(['orden'=>SORT_ASC,'secuencia'=>SORT_ASC])->all();
     foreach($registros as $expediente){
         $datos1['titulo']=$expediente->plan->acronimo;
         $datos1['subtitulo']=Html::a($expediente->documento->desdocu,Url::to(['/inter/expedientes/update','id'=>$expediente->id]),['data-pjax'=>'0','target'=>'_blank']);
         $plan=$expediente->plan;
         $area=m::t('labels','Departament').': '.$plan->eval->depa->nombredepa;
         $texto=m::t('labels','Aprobe For').': '.$plan->eval->trabajador->fullName();
         $font=($expediente->estado)?'check-circle':'exclamation-triangle';
         $color=($expediente->estado)?'#60a917':'#f39c12';
         $datos1['texto']=$area.'<br>'.$texto.'<br><i style="font-size:32px; color:'.$color.'">'.h::awe($font).'</i>';
    $datos[]=$datos1;
            $datos1=[];
         }
     //var_dump($datos);die();
     return $datos;
 }
}
