<?php
/**
 * AssetBundle.php
 * @author Revin Roman
 * @link https://rmrevin.ru
 */

namespace frontend\views\layouts\perfiles;

/**
 * Class AssetBundle
 * @package rmrevin\yii\fontawesome
 */
class alumnoAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/mapa.css',
        'css/boxes.css',
       // 'css/jquery-jvectormap-1.2.2.css',
    ];
    public $js = [
          //'js/jquery-jvectormap-1.2.2.min.js',
        //'js/jquery-jvectormap-world-mill-en.js',
    ];
    public $depends = [
       //'yii\web\YiiAsset',
        // 'yii\web\JqueryAsset',
       // 'yii\bootstrap\BootstrapAsset',
    ];
    
    
   
}
