<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m200903_040748_create_table_entrevistas
 */
class m200903_040748_create_table_entrevistas extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200903_040748_create_table_entrevistas cannot be reverted.\n";

        return false;
    }
    */
}
