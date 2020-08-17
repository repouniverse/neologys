<?php

use console\migrations\baseMigration;

/**
 * Class m200817_173656_alterTableProfile
 */
class m200817_173656_alterTableProfile extends baseMigration
{
    const NAME_TABLE='{{%profile}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'persona_id'))
     $this->addColumn($table, 'persona_id', $this->string(100));  
 
    
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'persona_id'))
           $this->dropColumn($table,'persona_id');
      
    }
}
