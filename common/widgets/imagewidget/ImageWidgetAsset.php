<?php
// your_app/votewidget/VoteWidgetAsset.php
namespace common\widgets\imagewidget;
use yii\web\AssetBundle;
class ImageWidgetAsset extends AssetBundle
{
    public $js = [
        
    ];

    public $css = [
        'css/imagen.css',
         // CDN lib
       // '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
      // 'css/select2.css'
    ];

    public $depends = [
       // 'yii\web\JqueryAsset'
    ];

    public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . "/assets";
        parent::init();
    }
}