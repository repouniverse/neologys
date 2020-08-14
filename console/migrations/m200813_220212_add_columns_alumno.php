<?php

use console\migrations\baseMigration;

/**
 * Class m200813_220212_add_columns_alumno
 */
class m200813_220212_add_columns_alumno extends baseMigration
{
    const NAME_TABLE='{{%alumnos}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'mail'))
     $this->addColumn($table, 'mail', $this->string(100));  
 
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'mail'))
           $this->dropColumn($table,'mail');
      
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
