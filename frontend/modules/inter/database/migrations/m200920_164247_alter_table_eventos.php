<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200920_164247_alter_table_eventos extends baseMigration
{
    const NAME_TABLE='{{%inter_eventos}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'carrera_id'))
     $this->addColumn($table, 'carrera_id', $this->integer(11)->notNull());  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'carrera_id'))
           $this->dropColumn($table,'carrera_id');
     
    }
}
