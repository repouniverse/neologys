<?php

use console\migrations\baseMigration;

/**
 * Class m201021_203346_alter_table_alumnos
 */
class m201021_203346_alter_table_alumnos extends baseMigration
{
    const NAME_TABLE='{{%alumnos}}';
    public function safeUp()
    {
        $table=static::NAME_TABLE; 
        if($this->existsColumn($table,'codalu'))
           $this->alterColumn ($table, 'codalu', 'varchar(14)'); 
     
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'codalu'))
          $this->alterColumn ($table, 'codalu', 'varchar(14)'); 
     
     
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