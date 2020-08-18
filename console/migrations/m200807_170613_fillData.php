<?php

use yii\db\Migration;
use mdm\admin\models\User;
use backend\components\Installer;
/**
 * Class m200806_193731_fillData
 */
class m200807_170613_fillData extends Migration
{
       const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_PERIODOS='{{%periodos}}';
    const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Installer::createSettings();         
        Installer::createBasicRole(Installer::createFirstUser());
                 
    }

    
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       Installer::revertCreateBasicRole();
    }

   
}
