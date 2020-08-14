<?php

use yii\db\Migration;

//use mdm\admin\models\User;
use backend\components\Installer;
class m200811_164445_add_Menu_import extends Migration
{
       const MENU=[
           'Import'=>[
                        '/import/importacion'=>'importaciones',
                       //'/inter/convocados'=>'Convocados',
                         //'/maestros/default/index-departamentos'=>Yii::t('base.labels', 'Departaments'),
                         ],
            
                  
             ];
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Installer::addMenu(self::MENU ); 
    }

   
   
    public function safeDown()
    {
       Installer::deleteMenu(self::MENU);
    }

    
}
