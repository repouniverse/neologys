<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'name'=>'Internacional',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        
          'assetManager'=>[
               'bundles'=>[
                   //'dmstr\web\AdminLteAsset'=>['skin'=>'skin-red-light'],
                   'backend\views\skins\apariencia_1\AdminLteAsset'=>['skin'=>'skin-purple'],
                   /*'yii\web\JqueryAsset' => [
                                        'js' => [YII_DEBUG ? 'https://code.jquery.com/jquery-3.2.1.js' : 'https://code.jquery.com/jquery-3.2.1.min.js'],
                                        'jsOptions' => ['type' => 'text/javascript'],
                                            ],*/
                             ],
                        ],
        'view' => [
                    'theme' => [
                            'pathMap' => [
                                             '@app/views' => '@backend/views/skins/apariencia_1/',
                                           // '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                                            
                                            ],
                                ],
                    ],
        
        
        
        
        
        
        
        
        
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'maestros' => [
            'class' => 'frontend\modules\maestros\MaestrosModule',
        ],
    ],
    
    
    'params' => $params,
];
