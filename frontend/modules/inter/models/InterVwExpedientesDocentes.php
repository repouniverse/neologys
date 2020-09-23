<?php

namespace frontend\modules\inter\models;
USE common\helpers\h;
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
            'codoce1' => Yii::t('base_labels', 'Codoce1'),
            'codoce2' => Yii::t('base_labels', 'Codoce2'),
            'unidest_id' => Yii::t('base_labels', 'Unidest ID'),
            'facudest_id' => Yii::t('base_labels', 'Facudest ID'),
            'carreradest_id' => Yii::t('base_labels', 'Carreradest ID'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'nombre' => Yii::t('base_labels', 'Nombre'),
            'id_expediente' => Yii::t('base_labels', 'Id Expediente'),
            'plan_id' => Yii::t('base_labels', 'Plan ID'),
            'estadoexp' => Yii::t('base_labels', 'Estadoexp'),
            'requerido' => Yii::t('base_labels', 'Requerido'),
            'orden' => Yii::t('base_labels', 'Orden'),
            'etapa_id' => Yii::t('base_labels', 'Etapa ID'),
            'desdocu' => Yii::t('base_labels', 'Desdocu'),
            'acronimoplan' => Yii::t('base_labels', 'Acronimoplan'),
            'decriplan' => Yii::t('base_labels', 'Decriplan'),
            'id_eval' => Yii::t('base_labels', 'Id Eval'),
            'acronimoeval' => Yii::t('base_labels', 'Acronimoeval'),
            'descrieval' => Yii::t('base_labels', 'Descrieval'),
            'apeval' => Yii::t('base_labels', 'Apeval'),
            'ameval' => Yii::t('base_labels', 'Ameval'),
            'nombreseval' => Yii::t('base_labels', 'Nombreseval'),
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
