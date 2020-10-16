<?php

namespace frontend\modules\inter\models;
use common\helpers\h;
use frontend\modules\inter\Module as m;
use Yii;

/**
 * This is the model class for table "{{%inter_vw_expedientes_docentes}}".
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
 * @property string|null $codoce1
 * @property string|null $codoce2
 * @property int $unidest_id
 * @property int $facudest_id
 * @property int $carreradest_id
 * @property string|null $codesp
 * @property string $nombre
 * @property int $id_expediente
 * @property int|null $plan_id
 * @property string $estadoexp
 * @property string $requerido
 * @property int|null $orden
 * @property int|null $etapa_id
 * @property string $desdocu
 * @property string $acronimoplan
 * @property string $decriplan
 * @property int $id_eval
 * @property string $acronimoeval
 * @property string $descrieval
 * @property string $apeval
 * @property string $ameval
 * @property string $nombreseval
 */
class InterVwExpedientesDocentes extends \common\models\base\modelBase
{
 use \common\traits\identidadTrait;
    use \common\traits\nameTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inter_vw_expedientes_docentes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id', 'current_etapa', 'unidest_id', 'facudest_id', 'carreradest_id', 'id_expediente', 'plan_id', 'orden', 'etapa_id', 'id_eval'], 'integer'],
            [['codocu', 'clase', 'status', 'ap', 'nombres', 'codigoper', 'codgrupo', 'acronimo', 'descripcion', 'codigodocente', 'unidest_id', 'facudest_id', 'carreradest_id', 'nombre', 'estadoexp', 'requerido', 'desdocu', 'acronimoplan', 'decriplan', 'acronimoeval', 'descrieval', 'apeval', 'ameval', 'nombreseval'], 'required'],
            [['motivos'], 'string'],
            [['codperiodo', 'acronimoeval'], 'string', 'max' => 10],
            [['codocu', 'codgrupo'], 'string', 'max' => 3],
            [['clase', 'status', 'estado', 'pendiente', 'estadoexp', 'requerido'], 'string', 'max' => 1],
            [['codalu', 'codigo1', 'codigo2', 'codigodocente', 'codoce1', 'codoce2'], 'string', 'max' => 16],
            [['am', 'ap', 'nombres', 'acronimo', 'descripcion', 'acronimoplan', 'decriplan', 'descrieval', 'apeval', 'ameval', 'nombreseval'], 'string', 'max' => 40],
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
            'identidad_id' => m::t('labels', 'Identity ID'),
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
            'codigoper' => m::t('labels', 'Person Code'),
            'tipodoc' => m::t('labels', 'Document Type'),
            'numerodoc' => m::t('labels', 'Document Number'),
            'codgrupo' => m::t('labels', 'Group Code'),
            'acronimo' => m::t('labels', 'Acronym'),
            'descripcion' => m::t('labels', 'Description'),
            'codigodocente' => m::t('labels', 'Teacher Code'),
            'codoce2' => m::t('labels', 'Codoce2'),
            'unidest_id' => m::t('labels', 'Unidest ID'),
            'facudest_id' => m::t('labels', 'Facudest ID'),
            'carreradest_id' => m::t('labels', 'Carreradest ID'),
            'codesp' => m::t('labels', 'Codesp'),
            'nombre' => m::t('labels', 'Name'),
            'id_expediente' => m::t('labels', 'Id Expediente'),
            'plan_id' => m::t('labels', 'Plan ID'),
            'estadoexp' => m::t('labels', 'Estadoexp'),
            'requerido' => m::t('labels', 'Requerido'),
            'orden' => m::t('labels', 'Order'),
            'etapa_id' => m::t('labels', 'Stage ID'),
            'desdocu' => m::t('labels', 'Document Description'),
            'acronimoplan' => m::t('labels', 'Acronimoplan'),
            'decriplan' => m::t('labels', 'Decriplan'),
            'id_eval' => m::t('labels', 'Id Eval'),
            'acronimoeval' => m::t('labels', 'Acronimoeval'),
            'descrieval' => m::t('labels', 'Descrieval'),
            'apeval' => m::t('labels', 'Apeval'),
            'ameval' => m::t('labels', 'Ameval'),
            'nombreseval' => m::t('labels', 'Nombreseval'),
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
     * @return InterVwExpedientesDocentesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterVwExpedientesDocentesQuery(get_called_class());
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
