<?php
namespace common\widgets\auditwidget;
use common\models\base\modelBase;
use common\models\audit\Activerecordlog;
use yii\base\Model;
use yii\base\Widget;
use yii\web\View;

use yii\helpers\Url;
use yii\base\InvalidConfigException;
class auditWidget extends Widget
{
    public $id;
    public $controllerName='finder';
    public $actionName='audit';
    public $model;//EL modelo
   
    public function init()
    {
        
        parent::init();
        //echo get_class($this->model);die();
        if(!($this->model instanceof Model))
        throw new InvalidConfigException('The "model" property is not subclass from "Model".');
       if($this->model->isNewRecord)
        throw new InvalidConfigException('The "model" property is a New Record');
       
// if(!($this->form instanceof \yii\widgets\ActiveForm))
        //throw new InvalidConfigException('The "form" property is not subclass from "ActiveForm".');
  
        //$this->_foreignClass=$this->model->obtenerForeignClass($this->campo);
        //$this->_foreignField=$this->model->obtenerForeignField($this->campo);

    }

    public function run()
    {
        auditWidgetAsset::register($this->getView());
        $arrttribute=array_keys($this->model->getPrimaryKey(true));
       $attribute= $arrttribute[0];
         return  $this->render('controls',[
                'model'=>$this->model,
                 'attribute'=>$attribute,
                  'controllerName'=>$this->controllerName,
                  'actionName'=>$this->actionName,
                ]);
        
    }
    
    
   
}

?>