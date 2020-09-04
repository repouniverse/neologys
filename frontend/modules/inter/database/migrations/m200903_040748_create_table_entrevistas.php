<?php

use yii\db\Migration;

/**
 * Class m200903_040748_create_table_entrevistas
 */
class m200903_040748_create_table_entrevistas extends Migration
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
        echo "m200903_040748_create_table_entrevistas cannot be reverted.\n";

        return false;
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
