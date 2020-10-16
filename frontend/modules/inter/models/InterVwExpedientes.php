<?php

namespace frontend\modules\inter\models;
use common\helpers\h;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_vw_expedientes}}".
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
 * @property string $am
 * @property string $ap
 * @property string $nombres
 * @property string $codigoper
 * @property string|null $tipodoc
 * @property string|null $numerodoc
 * @property string $codgrupo
 * @property string $acronimo
 * @property string $descripcion
 * @property string $codigoalumno
 * @property string|null $codalu1
 * @property string|null $codalu2
 * @property int|null $carrera_id
 * @property string|null $codesp
 * @property string $nombre
 * @property string $estadoexp
 * @property string $requerido
 * @property int|null $orden
 * @property int|null $etapa_id
 * @property string $desdocu
 */
class InterVwExpedientes extends \common\models\base\modelBase
{
    use \common\traits\identidadTrait;
    use \common\traits\nameTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_vw_expedientes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id', 'current_etapa', 'carrera_id', 'orden', 'etapa_id'], 'integer'],
            [['codocu', 'clase', 'status', 'am', 'ap', 'nombres', 'codigoper', 'codgrupo', 'acronimo', 'descripcion', 'codigoalumno', 'nombre', 'estadoexp', 'requerido', 'desdocu'], 'required'],
            [['motivos'], 'string'],
            [['codperiodo'], 'string', 'max' => 10],
            [['codocu', 'codgrupo'], 'string', 'max' => 3],
            [['clase', 'status', 'estado', 'pendiente', 'estadoexp', 'requerido'], 'string', 'max' => 1],
            [['codalu', 'codigo1', 'codigo2', 'codigoalumno', 'codalu1', 'codalu2'], 'string', 'max' => 16],
            [['am', 'ap', 'nombres', 'acronimo', 'descripcion'], 'string', 'max' => 40],
            [['codigoper', 'codesp'], 'string', 'max' => 8],
            [['tipodoc'], 'string', 'max' => 2],
            [['numerodoc'], 'string', 'max' => 20],
            [['nombre', 'desdocu'], 'string', 'max' => 60],
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
            'depa_id' => m::t('labels', 'Depa ID'),
            'modo_id' => m::t('labels', 'Mode ID'),
            'codperiodo' => m::t('labels', 'Period Code'),
            'codocu' => m::t('labels', 'Document Code'),
            'programa_id' => m::t('labels', 'Program'),
            'clase' => m::t('labels', 'Class'),
            'status' => m::t('labels', 'Status'),
            'secuencia' => m::t('labels', 'Sequence'),
            'alumno_id' => m::t('labels', 'Student'),
            'docente_id' => m::t('labels', 'Teacher'),
            'persona_id' => m::t('labels', 'Person'),
            'identidad_id' => m::t('labels', 'Identity Id'),
            'codalu' => m::t('labels', 'Student Code'),
            'codigo1' => m::t('labels', 'Code 1'),
            'codigo2' => m::t('labels', 'Code 2'),
            'estado' => m::t('labels', 'Status'),
            'motivos' => m::t('labels', 'Reasons'),
            'current_etapa' => m::t('labels', 'Current Stage'),
            'pendiente' => m::t('labels', 'Pending'),
            'am' => m::t('labels', 'Mother Last Name'),
            'ap' => m::t('labels', 'Last Name'),
            'nombres' => m::t('labels', 'Names'),
            'codigoper' => m::t('labels', 'Person code'),
            'tipodoc' => m::t('labels', 'Document Type'),
            'numerodoc' => m::t('labels', 'Document Number'),
            'codgrupo' => m::t('labels', 'Group Code'),
            'acronimo' => m::t('labels', 'Acronym'),
            'descripcion' => m::t('labels', 'Description'),
            'codigoalumno' => m::t('labels', 'Student Code'),
            'codalu1' => m::t('labels', 'Student Code 1'),
            'codalu2' => m::t('labels', 'Student Code 2'),
            'carrera_id' => m::t('labels', 'Race'),
            'codesp' => m::t('labels', 'Codesp'),
            'nombre' => m::t('labels', 'Name'),
            'estadoexp' => m::t('labels', 'Estadoexp'),
            'requerido' => m::t('labels', 'Required'),
            'orden' => m::t('labels', 'Order'),
            'etapa_id' => m::t('labels', 'Stage Id'),
            'desdocu' => m::t('labels', 'Document description'),
        ];
    }

    public function getExpediente()
    {
        return $this->hasOne(InterExpedientes::className(), ['id' => 'id_expediente']);
    }
    
    
    
    
    public function getExpedientes()
    {
        return $this->hasMany(InterExpedientes::className(), ['convocado_id' => 'id']);
    }
    
    /**
     * {@inheritdoc}
     * @return InterVwExpedientesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterVwExpedientesQuery(get_called_class());
    }
    
    
    public function datosExpedientes(){
     $datos=[];$datos1=[];
     $registros=$this->getExpedientes()->orderBy(['orden'=>SORT_ASC,'secuencia'=>SORT_ASC])->all();
    
     foreach($registros as $expediente){
         $datos1['titulo']=$expediente->plan->acronimo;
         $datos1['subtitulo']=$expediente->documento->desdocu;
         $plan=$expediente->plan;
         $area=yii::t('base_labels','Departament').': '.$plan->depa->nombredepa;
         $texto=yii::t('base_labels','Aprobe For').': '.$plan->eval->trabajador->fullName();
         $font=($expediente->estado)?'check-circle':'exclamation-triangle';
         $color=($expediente->estado)?'green':'yellow';
         $datos1['texto']=$area.'<br>'.$texto.'<br><i style="font-size:32px; color:'.$color.'">'.h::awe($font).'</i>';
    $datos[]=$datos1;
            $datos1=[];
         }
     //var_dump($datos);die();
     return $datos;
 }
}
