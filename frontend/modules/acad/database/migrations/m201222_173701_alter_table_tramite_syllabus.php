<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201222_173701_alter_table_tramite_syllabus extends baseMigration
{
     const NAME_TABLE='{{%acad_tramite_syllabus}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'focus'))
     $this->addColumn($table, 'focus', $this->char(1));  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'focus'))
           $this->dropColumn($table,'focus');
    }
}
