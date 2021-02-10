<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201208_210658_alter_table_acad_sylla_contenido  extends baseMigration
{
    const NAME_TABLE='{{%acad_contenido_syllabus}}';
   
    /** 
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'unidad_id'))
     $this->addColumn($table, 'unidad_id', $this->integer(11));  
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'unidad_id'))
           $this->dropColumn($table,'unidad_id');
      
    }
}
