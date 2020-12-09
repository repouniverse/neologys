<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201209_220243_alter_table_Aacad_syllabus extends baseMigration
{
    const NAME_TABLE='{{%acad_syllabus}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'n_sesiones_semana'))
     $this->addColumn($table, 'n_sesiones_semana', $this->integer(3));  
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'n_sesiones_semana'))
           $this->dropColumn($table,'n_sesiones_semana');
      
    }
}
