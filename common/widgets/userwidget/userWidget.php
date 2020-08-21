<?php
namespace common\widgets\userwidget;
//use common\models\base\modelBase;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Html;
use common\helpers\h;
use yii\base\InvalidConfigException;
class userWidget extends Widget
{
    public $forma='Redonda';//Use "Cuadrada" para imgs cuadradas
    public $size='60';// use tamanos 30, 60 y 100
    public $orientacion='horizontal';
    public $longName=false;
   // public $id;
    public $_src;//Ruta de la imagen
   // public $form; //El active FOrm 
   // public $campo;//el nombre del campo modelo
   // public $foreignskeys=[2,3,4];//Orden de los campos del modelo foraneo 
    //que s evan a amostrar o renderizar en el forumlario eta propida debe de especficarse al momento de usar el widget 
    //private $_foreignClass; //nombe de la clase foranea
    //private $_foreignField; //nombre del campo foranea
   // private $_varsJs=[];
    
    public function init()
    {
        
        $profile=h::user()->getProfile();
      if(!is_null($profile) && //Si tiene asociado un profile
            count($profile->files)>0  && //Si tiene adjunto
            trim(substr($profile->files[0]->mime,0,5))=='image' //si es imagen 
                ){
            $this->_src=$profile->files[0]->getUrl();
            
            
        }else{
           $this->_src='@web/img/anonimo.svg';
            //$this->longName='';
        }
       // var_dump($this->_src);die();
        $this->longName=(!$this->longName)?'':$profile->names;
        parent::init();
        
       // throw new InvalidConfigException('The "form" property is not subclass from "ActiveForm".');
        
    }

    public function run()
    {
         // Register AssetBundle
        userWidgetAsset::register($this->getView());
       
          return  $this->render('userImage'. ucfirst($this->orientacion),[
                'src'=>$this->_src,
                'forma'=>$this->forma,
                'size'=>$this->size,
                'longName'=>$this->longName,
                //'valores'=>$this->getValuesForaneos(),
                ]);
       
       // return $this->render('controls', ['product' => $this->model]);
    }
    
       
   
   
  
}

?>