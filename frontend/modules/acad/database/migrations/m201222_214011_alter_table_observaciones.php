<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201222_214011_alter_table_observaciones extends baseMigration
{
     const NAME_TABLE='{{%acad_observaciones_syllabus}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'activo'))
     $this->addColumn($table, 'activo', $this->char(1));  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'activo'))
           $this->dropColumn($table,'activo');
    }
}
