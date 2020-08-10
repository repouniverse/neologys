<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    /*
     * Ojo : para cambiar dináimcamente el lenguaje
     * se debe de hacer lo siguiente
     * // change target language to Chinese
        \Yii::$app->language = 'zh-CN';
     */
     'language' => 'es-PE',
    
    // set source language to be English
    'sourceLanguage' => 'en-US',
    'name'=>'Administrador',
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
   'modules' => [
        'base' => [
            'class' => 'backend\modules\base\Module',
        ],
    ],
    'components' => [        
        'i18n' => [
                    'translations' => [
                                    
                                    'base.names' => [
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            //'sourceLanguage' => 'en-US',
                                            'basePath' => '@root/messages'
                                            ],
                                'base.labels' => [
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            //'sourceLanguage' => 'en-US',
                                            'basePath' => '@root/messages'
                                            ],
                        
                'yii2mod.settings' => [
                                            'class' => 'yii\i18n\PhpMessageSource',
                                            'basePath' => '@yii2mod/settings/messages',
                                            ], 
                                    ],
                ],
       'assetManager'=>[
               'bundles'=>[
                   //'dmstr\web\AdminLteAsset'=>['skin'=>'skin-red-light'],
                   'backend\views\skins\apariencia_2\AdminLteAsset'=>['skin'=>'skin-red'],
                   /*'yii\web\JqueryAsset' => [
                                        'js' => [YII_DEBUG ? 'https://code.jquery.com/jquery-3.2.1.js' : 'https://code.jquery.com/jquery-3.2.1.min.js'],
                                        'jsOptions' => ['type' => 'text/javascript'],
                                            ],*/
                             ],
                        ],
        'view' => [
                    'theme' => [
                            'pathMap' => [
                                             '@app/views' => '@backend/views/skins/apariencia_2/',
                                           // '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                                            
                                            ],
                                ],
                    ],
        
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            //'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
    'params' => $params,
];
