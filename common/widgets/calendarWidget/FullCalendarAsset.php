<?php

namespace common\widgets\calendarWidget;

use yii\web\AssetBundle;

class FullCalendarAsset extends AssetBundle
{
    public $sourcePath =__DIR__ . '/assets';

    public $css = [
        //'fullcalendar/dist/fullcalendar.min.css',
        'fullcalendar.min.css',
    ];

    public $js = [
        //'moment/min/moment.min.js',
        'moment.min.js',
        
        //'fullcalendar/dist/fullcalendar.min.js',
        'fullcalendar.min.js',
        
       // 'fullcalendar/dist/locale/zh-cn.js',
        'es-us.js',
        
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
    ];
}
