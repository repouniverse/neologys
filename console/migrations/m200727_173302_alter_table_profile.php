<?php

use console\migrations\baseMigration;

/**
 * Class m200727_173302_alter_table_profile
 */
class m200727_173302_alter_table_profile extends baseMigration
{
    const NAME_TABLE='{{%profile}}';
    const NAME_COLUMN='codtra';
    public function safeUp()
    {
    $this->alterColumn(self::NAME_TABLE, self::NAME_COLUMN, $this->string(8));
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(self::NAME_TABLE, self::NAME_COLUMN, $this->string(6));
   
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200727_173302_alter_table_profile cannot be reverted.\n";

        return false;
    }
    */
}
