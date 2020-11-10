<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/personal.css',
    ];
    public $js = [
         'js/jquery-ui.js',
    ];
    public $depends = [
        /*'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',*/
         'yii\web\JqueryAsset',
        'yii\widgets\ActiveFormAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
