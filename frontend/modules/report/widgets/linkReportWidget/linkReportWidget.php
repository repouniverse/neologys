<?php
namespace frontend\modules\report\widgets\linkReportWidget;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Url;
use yii;
use yii\base\InvalidConfigException;
class linkReportWidget extends \yii\base\Widget
{
    const ATTRIBUTE_REPORT='reporte_id';
    
    public $model; //El active FOrm    
    public $newPage=true; //Si abre en otr apagina 
      /********************************/
      
    public function init()
    {      
        parent::init();
       /* print_r($this->model->attributes);die();
        if(!$this->model->hasAttribute(self::ATTRIBUTE_REPORT));
         throw new InvalidConfigException(yii::t('sta.errors','El modelo no tiene la propiedad : '.self::ATTRIBUTE_REPORT));
      */
      if(empty($this->model->{self::ATTRIBUTE_REPORT}))
        throw new InvalidConfigException('La propiedad Reporte_id está vacía');
    
    }
    public function run()
    {
         linkReportWidgetAsset::register($this->getView());
       // $this->makeJs();
         //$pk=$this->model->getPrimaryKey(true);
        if(!$this->model->isNewRecord){
           return  $this->render('controls',[
                'model'=>$this->model,
                'newPage'=>$this->newPage,
                'idReporte'=>$this->model->reporte_id,
        'idFiltro'=>$this->model->getPrimaryKey(),
                
                ]);
        }
       // return $this->render('controls', ['product' => $this->model]);
    }
    
  
        
  
}
?>