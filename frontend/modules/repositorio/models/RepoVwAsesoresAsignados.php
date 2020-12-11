<?php

namespace frontend\modules\repositorio\models;
use common\models\masters\Alumnos;

use Yii;

/**
 * This is the model class for table "{{%repositorio_vw_asesores_asignados}}".
 *
 * @property string|null $ap
 * @property string|null $am
 * @property int|null $carrera_id
 * @property string|null $nombres
 * @property string|null $numerodoc
 * @property string|null $tipodoc
 * @property string|null $codalu
 * @property string|null $codcur
 * @property string|null $descripcion
 * @property string $apasesor
 * @property string|null $amasesor
 * @property string $nombresasesor
 * @property string|null $numdocasesor
 * @property string|null $tipodocasesor
 * @property string|null $seccion
 * @property int $curso_id
 * @property int $alumno_id
 * @property string|null $activo
 * @property int|null $asesor_id
 * @property int $matricula_id
 * @property string|null $orcid
 * @property string $nombre
 * @property string|null $codesp
 */
class RepoVwAsesoresAsignados extends \common\models\base\modelBase
{
    
    const DOCU_PLAN_INVESTIGACION='156';
    const DOCU_TRABAJO_INVESTIGACION='157';
    
    private $_array_docs=[
        self::DOCU_PLAN_INVESTIGACION=>'1',
        self::DOCU_TRABAJO_INVESTIGACION=>'0'
            ];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%repositorio_vw_asesores_asignados}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['carrera_id', 'curso_id', 'alumno_id', 'asesor_id', 'matricula_id'], 'integer'],
            //[['apasesor', 'nombresasesor', 'curso_id', 'alumno_id', 'matricula_id', 'nombre'], 'required'],
            //[['ap', 'am', 'nombres', 'descripcion', 'apasesor', 'amasesor', 'nombresasesor'], 'string', 'max' => 40],
          //  [['numerodoc', 'codalu', 'numdocasesor'], 'string', 'max' => 20],
            /*[['tipodoc', 'tipodocasesor'], 'string', 'max' => 2],
            [['codcur'], 'string', 'max' => 18],
            [['seccion'], 'string', 'max' => 12],
            [['activo'], 'string', 'max' => 1],
            [['orcid'], 'string', 'max' => 250],
            [['nombre'], 'string', 'max' => 60],
            [['codesp'], 'string', 'max' => 8],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ap' => Yii::t('base_labels', 'Ap'),
            'am' => Yii::t('base_labels', 'Am'),
            'carrera_id' => Yii::t('base_labels', 'Carrera ID'),
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'numerodoc' => Yii::t('base_labels', 'Numerodoc'),
            'tipodoc' => Yii::t('base_labels', 'Tipodoc'),
            'codalu' => Yii::t('base_labels', 'Codalu'),
            'codcur' => Yii::t('base_labels', 'Codcur'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'apasesor' => Yii::t('base_labels', 'Apasesor'),
            'amasesor' => Yii::t('base_labels', 'Amasesor'),
            'nombresasesor' => Yii::t('base_labels', 'Nombresasesor'),
            'numdocasesor' => Yii::t('base_labels', 'Numdocasesor'),
            'tipodocasesor' => Yii::t('base_labels', 'Tipodocasesor'),
            'seccion' => Yii::t('base_labels', 'Seccion'),
            'curso_id' => Yii::t('base_labels', 'Curso ID'),
            'alumno_id' => Yii::t('base_labels', 'Alumno ID'),
            'activo' => Yii::t('base_labels', 'Activo'),
            'asesor_id' => Yii::t('base_labels', 'Asesor ID'),
            'matricula_id' => Yii::t('base_labels', 'Matricula ID'),
            'orcid' => Yii::t('base_labels', 'Orcid'),
            'nombre' => Yii::t('base_labels', 'Nombre'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RepoVwAsesoresAsignadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RepoVwAsesoresAsignadosQuery(get_called_class());
    }
    
    public function getAsesor(){
        
        return $this->hasOne(\common\models\masters\Asesores::className(), ['id' => 'asesor_id']);
    
    }
    
    public function getAlumno(){
        
        return $this->hasOne(\common\models\masters\Alumnos::className(), ['id' => 'alumno_id']);
    
    }
     
    public function generateDocs(){
        foreach($this->_array_docs as $codocu=>$activo){
            yii::error($codocu);
            yii::error($activo);
            RepositorioAsesoresCursoDocs::firstOrCreateStatic(
                    ['asesores_curso_id'=>$this->id,
                        'codocu'=>$codocu.'',
                        'activo'=>$activo,
                        ],null,
                    ['asesores_curso_id'=>$this->id,
                        'codocu'=>$codocu.'',
                        //'activo'=>($this->activo)?'1':'0'
                        ]
                    );
        }
    }
    
    
    public function getRepoAsesoresCursoDocs()
    {
        return $this->hasMany(RepositorioAsesoresCursoDocs::className(), ['asesores_curso_id' => 'id']);
    } 
    
    
    public function listAttachedFiles(){
        $array_links=[];
        foreach($this->repoAsesoresCursoDocs as $fila){
            if($fila->hasAttachments() && $fila->activo)
            $array_links[$fila->codocu]=$fila->urlFirstFile;
        }
        return $array_links;
    }
    
    
    
}
