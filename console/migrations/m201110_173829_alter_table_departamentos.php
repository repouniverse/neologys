<?php
use console\migrations\baseMigration;
class m201110_173829_alter_table_departamentos extends baseMigration
{
    const NAME_TABLE='{{%departamentos}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      return true;
    }
}
