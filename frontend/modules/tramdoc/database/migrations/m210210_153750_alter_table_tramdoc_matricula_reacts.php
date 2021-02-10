<?php
namespace frontend\modules\tramdoc\database\migrations;
use console\migrations\baseMigration;
class m210210_153750_alter_table_tramdoc_matricula_reacts  extends baseMigration
{
    const NAME_TABLE='{{%tramdoc_matricula_reacts}}';
   
    /** 
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'estado'))
     $this->addColumn($table, 'estado', $this->char(3));  
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'estado'))
           $this->dropColumn($table,'estado');
      
    }
}