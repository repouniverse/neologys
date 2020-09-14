<?php
namespace common\widgets\timelinewidget;
//use common\models\base\modelBase;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\base\InvalidConfigException;
class timeLineWidget extends \yii\base\Widget
{
    public $id;
    public $datos=[];
   
    public function init()
    {
       
        parent::init();
        
       
    }

    public function run()
    {
        
       
         // Register AssetBundle
        timeLineWidgetAsset::register($this->getView());
       
         return  $this->render('controls',[
                'datos'=>$this->datos,
               // 'form'=>$this->form,
               
                ]);
        
        
        
        }
    
 
   
}
?>