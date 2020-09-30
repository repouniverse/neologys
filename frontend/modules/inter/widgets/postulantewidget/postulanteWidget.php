<?php
namespace frontend\modules\inter\widgets\postulantewidget;
//use common\models\base\modelBase;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Html;
use common\helpers\h;
use yii\base\InvalidConfigException;
class postulanteWidget extends Widget
{
   
    public function init()
    {
        parent::init();
     }

    public function run()
    {
         // Register AssetBundle
        postulanteWidgetAsset::register($this->getView());
       
          return  $this->render('postulante',[
                'src'=>$this->_src,
               
                ]);
       
       // return $this->render('controls', ['product' => $this->model]);
    }
    
       
   
   
  
}

?>