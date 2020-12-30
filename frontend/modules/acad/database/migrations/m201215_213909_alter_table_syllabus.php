<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201215_213909_alter_table_syllabus extends baseMigration
{
    const NAME_TABLE='{{%acad_syllabus}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'codocu'))
     $this->addColumn($table, 'codocu', $this->char(3));  
 if(!$this->existsColumn($table,'codestado'))
     $this->addColumn($table, 'codestado', $this->char(2));     

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'codocu'))
           $this->dropColumn($table,'codocu');
      if($this->existsColumn($table,'codestado'))
           $this->dropColumn($table,'codestado');
      
    }
}
