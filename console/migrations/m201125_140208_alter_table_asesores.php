<?php

use console\migrations\baseMigration;
class m201125_140208_alter_table_asesores  extends baseMigration
{
    const NAME_TABLE='{{%asesores}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'docente_id'))
     $this->addColumn($table, 'docente_id', $this->integer(11));  
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'docente_id'))
           $this->dropColumn($table,'docente_id');
      
    }
}
