<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'p8rrHOIe-r0_g2rRnCZnrGihTDP0TIlC',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

     $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
          'allowedIPs'=>['*'],
         'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'myCrud' => '@common/my_templates/crud/default', // template name => path to template
                       ]
                    ],
            ]
    ];
    
    
    
    $config['bootstrap'][] = 'gii';
    
}

return $config;
