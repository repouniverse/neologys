<?php
// your_app/votewidget/VoteWidgetAsset.php
namespace common\widgets\timelinewidget;
use yii\web\AssetBundle;
class timeLineWidgetAsset extends AssetBundle
{
    public $js = [
        
    ];

    public $css = [
         'css/estilo.css'
    ];

    public $depends = [
        //'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . "/assets";
        parent::init();
    }
}