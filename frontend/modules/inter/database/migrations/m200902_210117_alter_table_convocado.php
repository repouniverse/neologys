<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200902_210117_alter_table_convocado  extends baseMigration
{
    const NAME_TABLE='{{%inter_convocados}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'pendiente'))
     $this->addColumn($table, 'pendiente', $this->char(1));  
  
    
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'pendiente'))
           $this->dropColumn($table,'pendiente');
     
    }
}
