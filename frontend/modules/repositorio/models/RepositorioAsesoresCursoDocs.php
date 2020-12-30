<?php

namespace frontend\modules\repositorio\models;
use common\models\masters\Documentos;
use common\models\masters\AsesoresCurso;
use common\behaviors\FileBehavior;
use common\helpers\timeHelper;
use Yii;

/**
 * This is the model class for table "{{%repositorio_asesores_curso_docs}}".
 *
 * @property int $id
 * @property int $asesores_curso_id
 * @property string|null $codocu
 * @property string|null $fpresentacion
 * @property string|null $orcid
 * @property string|null $comentarios
 *
 * @property Documentos $codocu0
 * @property AsesoresCurso $asesoresCurso
 */
class RepositorioAsesoresCursoDocs extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public $booleanFields=['activo','publico'];
    /* public $dateorTimeFields = [
      
    ];*/
    
    public static function tableName()
    {
        return '{{%repositorio_asesores_curso_docs}}';
    }
    
     public function behaviors() {
        return [
            
            'fileBehavior' => [
                'class' => FileBehavior::className()
            ],
           
        ];
      }
    
  public function init(){
    $this->on(FileBehavior::EVENT_AFTER_ATTACH_FILES, function ($event) {
        /** @var $files \nemmo\attachments\models\File[] */
        $files = $event->files;
         //$fechahora=self::CarbonNow();
        yii::error('haciendo seguimiemto al trigger');
        yii::error( self::CarbonNow()->format(timeHelper::formatMysqlDate()));
        yii::error( self::SwichtFormatDate(
            self::CarbonNow()->format(timeHelper::formatMysqlDate())
            ,'date',
            true
            ));
        $this->fpresentacion=self::SwichtFormatDate(
            self::CarbonNow()->format(timeHelper::formatMysqlDate())
            ,'date',
            true
            );
         $this->fpresentacion='hola';
        $this->save();
    });
    parent::init();
   }  

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asesores_curso_id'], 'required'],
            [['asesores_curso_id'], 'integer'],
            [['comentarios'], 'string'],
            [['activo','publico'], 'safe'],
            [['codocu'], 'string', 'max' => 3],
             [['fpresentacion'], 'safe'],
            [['fpresentacion'], 'string', 'max' => 10],
            [['orcid'], 'string', 'max' => 250],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
            [['asesores_curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsesoresCurso::className(), 'targetAttribute' => ['asesores_curso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'asesores_curso_id' => Yii::t('base_labels', 'Asesores Curso ID'),
            'codocu' => Yii::t('base_labels', 'Codocu'),
            'fpresentacion' => Yii::t('base_labels', 'Fpresentacion'),
            'orcid' => Yii::t('base_labels', 'Orcid'),
            'comentarios' => Yii::t('base_labels', 'Comentarios'),
        ];
    }

    /**
     * Gets query for [[Codocu0]].
     *
     * @return \yii\db\ActiveQuery|DocumentosQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    /**
     * Gets query for [[AsesoresCurso]].
     *
     * @return \yii\db\ActiveQuery|AsesoresCursoQuery
     */
    public function getAsesoresCurso()
    {
        return $this->hasOne(AsesoresCurso::className(), ['id' => 'asesores_curso_id']);
    }

    /**
     * {@inheritdoc}
     * @return RepositorioAsesoresCursoDocsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RepositorioAsesoresCursoDocsQuery(get_called_class());
    }
    
    
    /*
 * Zipea los adjuntos de STADOCUENTOS 
 * Y LO GUARAD COO AFJUNTO 
 */
    
  public  function zipeaArchivos($codocu,$offset=1){
    //$ids=array_map('intval',$ids);
      $pathDirectory=\yii::getAlias('@frontend/web/temp');
    if(!is_dir($pathDirectory))
        mkdir ($pathDirectory);
      
    
    $idsDocus=static::find()->select(['asesores_curso_id'])->andWhere(['codocu'=>$codocu])->column();
    $docentes=RepoVwAsesoresAsignados::find()->select(['apasesor','amasesor','nombresasesor'])->distinct()->andWhere(['id'=>$idsDocus])->all();
    foreach($docentes as $docente){
           $zip=New \ZipArchive();  
           $rutaTemp=$pathDirectory.'/'.$docente->apasesor.'_'.$docente->amasesor.'_'.$docente->nombresasesor.'.zip';
            $zip->open($rutaTemp, \ZipArchive::CREATE);
            $registros=self::find()->andWhere(['codocu'=>$codocu])->
     orderby(['id'=>SORT_ASC])->offset($offset)->limit(50)->all();
         foreach ( $registros as $documento){
             If($documento->hasAttachments() ){
           $path=$documento->files[0]->path;
           $ext=\common\helpers\FileHelper::extensionFile($path, true);
           //yii::error('zipeando');
           //yii::error($documento->files[0]->path);
            $zip->addFile($path, \common\helpers\FileHelper::fileName($path)); 
            //$documento->logAudit(\common\behaviors\AccessDownloadBehavior::ACCESS_DOWNLOAD);
                    } 
         }
          $zip->close();
        $zip->addFile($rutaTempGeneral, \common\helpers\FileHelper::fileName($path));    
    }
    $zipGeneral->close();
    return $rutaTempGeneral;
  }
       
private function prepareNameFile($modelo,$ext){
    //$docente=$modelo->asesoresCurso->asesor->docente;
   // return $docente->fullName().'_'.uniqid().$ext;
    
}  


public function zipeaFiles($codocu,$offset=1){
      $ruta=\yii::getAlias('@frontend/web/temp/').'_'.uniqid().'/';
      if (!is_dir($ruta)) mkdir ($ruta);
        $idsDocus=static::find()->select(['asesores_curso_id'])->andWhere(['codocu'=>$codocu])->column();
        $docentes=RepoVwAsesoresAsignados::find()->select(['id','apasesor','amasesor','nombresasesor'])->distinct()->andWhere(['id'=>$idsDocus])->all();
          
         foreach($docentes as $docente){
             $rutaDocente=$ruta.'/'.str_replace([' ','Á','É','Í','Ó','Ú'],'_',$docente->apasesor).'_'.$docente->amasesor.'_'.$docente->nombresasesor.'/';
             if (!is_dir($rutaDocente))mkdir ($rutaDocente);
              $registros=self::find()->andWhere(['codocu'=>$codocu])->andWhere(['asesores_curso_id'=>$docente->id])->
                            orderby(['id'=>SORT_ASC])->offset($offset)->limit(50)->all();
              yii::error(self::find()->andWhere(['codocu'=>$codocu])->andWhere(['asesores_curso_id'=>$docente->id])->
                            orderby(['id'=>SORT_ASC])->limit(50)->createCommand()->rawSql);
         foreach ( $registros as $documento){
               If($documento->hasAttachments() ){
                         $path=$documento->files[0]->path;
                         $nameF=\common\helpers\FileHelper::fileName($path);
                         $pathDestino=$rutaDocente.$nameF;
                         yii::error($path);
                          yii::error($pathDestino);
                         copy($path,$pathDestino);
                  } ELSE{
                      YII::ERROR('NO HAY ATTACHSMNETS');
                  }
            }
         }
      
     $camino=  $this->zipeaCarpetaInformes($ruta);
     //rmdir($ruta);
     return $camino;
  }
  
  
  public function zipeaCarpetaInformes($rutaCarpeta){
   // $rutaCarpeta=\yii::getAlias('@frontend/web/img_repo/preuba/');
    $zip=New \ZipArchive();  
     //$destination=\yii::getAlias('@frontend/web/img_repo/temp/'. uniqid().'.zip');
    $destination=\yii::getAlias('@frontend/web/temp/dscarga_'. uniqid().'.zip');    
    if (!$zip->open($destination, \ZipArchive::CREATE)) {
        return false;
    }
    $source = str_replace('\\', '/', realpath($rutaCarpeta));
    if (is_dir($source) === true)    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);
            foreach ($files as $file)
                {
            $file = str_replace('\\', '/', $file);
            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;
            $file = realpath($file);
            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }
   $zip->close();   
    return $destination;
  }

  
}
