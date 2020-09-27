<?php
namespace common\widgets\imagewidget;
use common\helpers\FileHelper;
use common\models\base\modelBase;
use kartik\base\TranslationTrait;
//use nemmo\attachments\components\AttachmentsInput;
use yii;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\base\InvalidConfigException;
class ImageWidget extends \yii\widgets\InputWidget
{
    use TranslationTrait;
   public $id;
   public $options;
   public $ancho=50;
   public $alto=50;
   public $pluginOptions;
   public $controllerName='finder';
    public $actionName='selectimage';
    public $isImage=true;
   // public $idGrilla=null;//Id del pjax para refrescar cone l action 
    public $extensions=null; //array de extensiones permitidas
     //protected $_msgCat = 'widImage'; //Priedad para hacer cumplir el trait de kartik importado para la internacionalizacion


   public function run()
    {
       ImageWidgetAsset::register($this->getView());
       $this->initI18N(__DIR__,'widImage');
       $mensaje=($this->isImage)?yii::t('widImage','This record has a Picture.'):
       yii::t('widImage','Este registro anexa Archivos.');
       $extensiones=(is_null($this->extensions) or count($this->extensions)==0)?null:\yii\helpers\Json::encode($this->extensions);
            return $this->render('controls',[
                'model'=>$this->model,
               'ancho'=> $this->ancho,
                'alto'=>$this->alto,
                'urlModal'=>\yii\helpers\Url::toRoute(['/'.$this->controllerName.'/'.$this->actionName,'isImage'=>$this->isImage,'idModal'=>'imagemodal','modelid'=>$this->model->id,'nombreclase'=> str_replace('\\','_',get_class($this->model)),/*'idGrilla'=>$this->idGrilla,*/'extension'=>$extensiones]),
                'urlImage'=>$this->getPathFileImage(),
                    'isNew'=>$this->model->isNewRecord,
                    'numeroImages'=>($this->isImage)?$this->model->getCountImages():
                  count($this->model->files),
                    'mensaje'=>$mensaje,
            ]);
        }


 private function makeJs(){

                        }

 private function getPathFileImage(){
     /*
      * Intentamos obtener los archivos adjuntos del modelo
      * Si no tiene el file Atachment behavior oberner una ruta de un archivo sin imagen
      */
     try{
         $files=$this->model->files; //puede arrojar un error porque l modelo no tiene el behavior
     } catch (\yii\base\Exception $ex) {
          throw new \yii\base\Exception(Yii::t('base.errors', 'This model doesn\'t have file Attachment behavior '));
     }
   if(count($files)==0){
       if($this->isImage)
       return FileHelper::UrlEmptyImage();
       return FileHelper::UrlEmptyFile();
   }else{
       if($this->isImage)
      return $this->model->getPathFirstImage();
        return FileHelper::UrlSomeFile();
   }

 }
}

?>
