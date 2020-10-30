<?php

use console\migrations\baseMigration;

/**
 * Class m201027_151136_alter_table_profile
 */
class m201028_164122_alter_table_universidades extends baseMigration
{
    const NAME_TABLE='{{%universidades}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'idioma'))
     $this->addColumn($table, 'idioma', $this->string(8));  
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'idioma'))
           $this->dropColumn($table,'idioma');
      
    }
}
