<?php
 use console\migrations\baseMigration;
class m200919_141840_alter_table_universidades extends baseMigration
{
    const NAME_TABLE='{{%universidades}}';
    const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        true;
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
        echo "m200908_234434_alter_personas cannot be reverted.\n";

        return false;
    }
    */
}
