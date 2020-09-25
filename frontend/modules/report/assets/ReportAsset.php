<?php
// your_app/votewidget/VoteWidgetAsset.php
namespace frontend\modules\report\assets;
use yii\web\AssetBundle;
class ReportAsset extends AssetBundle
{
    

    //public $basePath = '@webroot';
   // public $baseUrl = '@web';
    // public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $js = [
        
    ];

    public $css = [
        'css/report.css',
         // CDN lib
       // '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
      // 'css/select2.css'
    ];

    public $depends = [
      // 'yii\bootstrap\BootstrapAsset'
    ];

    public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . "/../web";
       
         parent::init();
    // resetting BootstrapAsset to not load own css files
    
        //parent::init();
    }
}