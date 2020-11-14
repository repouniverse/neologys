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
    'name'=>'Internacional',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        
         'mailer' =>['class'=>'common\components\Mailer',
                'viewPath'=>'@frontend/mail',
            ],
        
          'assetManager'=>[
               'bundles'=>[
                   //'dmstr\web\AdminLteAsset'=>['skin'=>'skin-red-light'],
                   'frontend\views\skins\apariencia_1\AdminLteAsset'=>['skin'=>'skin-purple'],
                   /*'yii\web\JqueryAsset' => [
                                        'js' => [YII_DEBUG ? 'https://code.jquery.com/jquery-3.2.1.js' : 'https://code.jquery.com/jquery-3.2.1.min.js'],
                                        'jsOptions' => ['type' => 'text/javascript'],
                                            ],*/
                             ],
                        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@frontend/views/skins/apariencia_1/',
                     // '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                               ],
                        ],
                 ],
        
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
             'flushInterval' => 100, 
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
        
        'import' => [
            'class' => 'frontend\modules\import\ModuleImport',
        ],
      
        'regacad' => [
            'class' => 'frontend\modules\regacad\Module',
            ],
        
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            ' ', 
            'site/login',
            'site/clear-cache',
           // 'site/signup',
             'site/request-password-reset',
            'site/reset-password', 
           'site/logout',
           'site/mantenimiento',
           'inter/default/base-auth'
        ]
    ],
    /*
     * Para asignarlel leguaje de 
     * cada usuario según el país
     */
    'as beforeRequest' => [
        'class' =>'common\filters\LanguageFilter',
       // 'class' => 'common\filters\ActionAuditFilter',  
                        ],
    'params' => $params,
];
