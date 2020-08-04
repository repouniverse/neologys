<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'migrate' => [
                        'class' =>
                    'yii\console\controllers\MigrateController',
                      //'migrationPath'=>'console\migrations',
                        'migrationNamespaces' => [
                            /*Ojo:
                             * Al aplicar estos namespaces
                             * Todos los archivos de migraciones tienen
                             * que tner declarado su namespace en 
                             * la cabecera de otro modo habra error 
                             * al momento de ejecutar la migracion 
                             */
                           //  'console\migrations',
                          'nemmo\attachments\migrations', 
                        //'backend\database\migrations', 
                          'frontend\modules\import\database\migrations', 
                             'frontend\modules\inter\database\migrations', 
                          /*   'yii2mod\settings\migrations',  
                          'backend\database\migrations', 
                           'frontend\database\migrations',  
                             //'frontend\modules\message\database\migrations',
                          'nemmo\attachments\migrations', 
                          //'yii\rbac\migrations', 
                          
                        // 'nemmo\attachments\migrations',   
                           // 'mdm\admin\migrations',
                         //'frontend\modules\people\database\migrations',
                        // 'frontend\modules\bigitems\database\migrations', 
                        // 'frontend\modules\report\database\migrations',
                           // 'frontend\modules\import\database\migrations',
                            //'frontend\modules\sta\database\migrations',
                           // 'frontend\modules\sigi\database\migrations',
                             //'frontend\modules\access\database\migrations',
                            //'frontend\modules\avisos\database\migrations',
                            
                          */  ],
                        ],
        
        
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    
    
    
    
    'components' => [
        
    ],
    'params' => $params,
];
