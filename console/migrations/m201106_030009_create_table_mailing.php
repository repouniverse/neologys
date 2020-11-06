<?php

use yii\db\Migration;

/**
 * Class m201106_030009_create_table_mailing
 */
class m201106_030009_create_table_mailing extends Migration
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
        echo "m201106_030009_create_table_mailing cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201106_030009_create_table_mailing cannot be reverted.\n";

        return false;
    }
    */
}
