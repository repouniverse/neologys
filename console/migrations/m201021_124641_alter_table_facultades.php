<?php
use console\migrations\baseMigration;

/**
 * Class m201021_124641_alter_table_facultades
 */
class m201021_124641_alter_table_facultades extends baseMigration
{
    const NAME_TABLE='{{%facultades}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE; 
        if($this->existsColumn($table,'codfac'))
           $this->alterColumn ($table, 'codfac', 'varchar(20)'); 
     
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'codfac'))
          $this->alterColumn ($table, 'codfac', 'varchar(20)'); 
     
     
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