<?php
//Un comentario
return [  
    
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error'/*, 'warning','info','debug'*/],
                ],
                /*[
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                   'message' => [
                       'from' => ['log@example.com'],
                       'to' => ['hipogea@hotmail.com'],
                       'subject' => 'Database errors at example.com',
                    ],
                ],*/
            ],
        ],
        
       
        
        
        
        'urlManager' => [
                'class' => 'yii\web\UrlManager',
                    // Disable index.php
                        'showScriptName' => false,
                        // Disable r= routes
                                'enablePrettyUrl' => true,
                        'rules' => array(
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    ),
                ],
        
        'settings' => [
        'class' => 'yii2mod\settings\components\Settings',
        'cache'=>['class'=>'yii\caching\FileCache'],
             ],
        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
          'authManager' => [
                  'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
                ],
        'user' => [
           'class' => 'common\components\User',
        //'identityClass' => 'mdm\admin\models\User',
            'identityClass' => 'common\models\User',
        //'loginUrl' => ['admin/user/login'],
            //'class' => 'mdm\admin\models\User',
        'loginUrl' => ['admin/user/login'],
               ],
        
         'i18n' => [
            'translations' => [
                'rbac-admin'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@mdm/admin/messages',
                    'sourceLanguage' => 'en',
                ],
              
                'base.errors'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@root/messages',                                          
                                            ], 
                'base.labels'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@root/messages',                                          
                                            ], 
                
               'base.names'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@root/messages',                                          
                                  ], 
                 'base.paises'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@root/messages',                                          
                                  ], 
                 'base.success'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' =>'@root/messages',                                         
                       ], 
                     'base.verbs'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@root/messages',                                        
               
                                  ],
                'base.warnings'=>[
                                 'class' => 'yii\i18n\PhpMessageSource',
                                 'basePath' => '@root/messages',                                        
               
                                  ],
                  ], 
        
        
                ],
    ],
    'modules' => [
        
                  'inter' => [
            'class' => 'frontend\modules\inter\Module',
                    ],
        
                'settings' => [
                        'class' => 'yii2mod\settings\Module',
                    ],
        
                 'admin' => [
                    'class' => 'mdm\admin\Module',
                        ],
        
                  'attachments' => [
		'class' => nemmo\attachments\Module::className(),
		'tempPath' => '@app/uploads/temp',
		'storePath' => '@app/uploads/store',
		'rules' => [ // Rules according to the FileValidator
		    'maxFiles' => 10, // Allow to upload maximum 3 files, default to 3
			'mimeTypes' => 'image/png', // Only png images
			'maxSize' => 1024 * 1024 // 1 MB
		],
		'tableName' => '{{%attachments}}' // Optional, default to 'attach_file'
	                ]
                ],
    
];
