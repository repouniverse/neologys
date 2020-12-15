<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201214_201658_alter_table_acad_syllabus extends baseMigration
{
    const NAME_TABLE='{{%acad_syllabus}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'n_semanas'))
     $this->addColumn($table, 'n_semanas', $this->integer(3));  
 if(!$this->existsColumn($table,'formula_txt'))
     $this->addColumn($table, 'formula_txt', $this->text());     

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'n_semanas'))
           $this->dropColumn($table,'n_semanas');
      if($this->existsColumn($table,'formula_txt'))
           $this->dropColumn($table,'formula_txt');
      
    }
}
