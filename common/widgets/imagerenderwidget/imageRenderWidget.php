<?php
namespace common\widgets\imagerenderwidget;
//use common\models\base\modelBase;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Html;
use common\helpers\h;
use yii\base\InvalidConfigException;
class imageRenderWidget extends Widget
{
    public $forma='Redonda';//Use "Cuadrada" para imgs cuadradas
    public $size='100';// use tamanos 30, 60 y 100
    public $orientacion='horizontal';
    //public $model=null;
   // public $longName=false;
   // public $id;
    public $src;//Ruta de la imagen
   // public $form; //El active FOrm 
   // public $campo;//el nombre del campo modelo
   // public $foreignskeys=[2,3,4];//Orden de los campos del modelo foraneo 
    //que s evan a amostrar o renderizar en el forumlario eta propida debe de especficarse al momento de usar el widget 
    //private $_foreignClass; //nombe de la clase foranea
    //private $_foreignField; //nombre del campo foranea
   // private $_varsJs=[];
    
    public function init()
    {
        
        
      
        parent::init();
        
       // throw new InvalidConfigException('The "form" property is not subclass from "ActiveForm".');
        
    }

    public function run()
    {
         // Register AssetBundle
         imageRenderWidgetAsset::register($this->getView());
       
          return  $this->render('userImage',[
                'src'=>$this->src,
                'forma'=>$this->forma,
                'size'=>$this->size,
                //'longName'=>$this->longName,
                //'valores'=>$this->getValuesForaneos(),
                ]);
       
       // return $this->render('controls', ['product' => $this->model]);
    }
    
       
   
   
  
}

?>