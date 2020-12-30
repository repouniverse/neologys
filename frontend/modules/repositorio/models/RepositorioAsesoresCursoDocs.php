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
            //yii::error('mutiplo de 20');
           $zip=New \ZipArchive();  
           $rutaTemp=$pathDirectory.'/'.uniqid().'.zip';
            $zip->open($rutaTemp, \ZipArchive::CREATE); 
    $registros=self::find()->andWhere(['codocu'=>$codocu])->
     orderby(['id'=>SORT_ASC])->offset($offset)->limit(50)->all();
      foreach ( $registros as $documento){
          //yii::error('recorrien do el bucle'); 
       If($documento->hasAttachments() ){
           $path=$documento->files[0]->path;
           yii::error('zipeando');
           yii::error($documento->files[0]->path);
            $zip->addFile($path, $this->prepareNameFile()/*\common\helpers\FileHelper::fileName($path)*/); 
            //$documento->logAudit(\common\behaviors\AccessDownloadBehavior::ACCESS_DOWNLOAD);
        }else{
            yii::error('No encontro adjuntos'); 
        }
    }
    $zip->close();
  }
       
private function prepareNameFile(){
    $docente=$this->asesoresCurso->asesor->docente;
    return $docente->fullName();
}  
  
}
