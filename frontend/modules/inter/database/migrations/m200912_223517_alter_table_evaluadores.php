<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200912_223517_alter_table_evaluadores extends baseMigration
{
    const NAME_TABLE='{{%inter_evaluadores}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'trabajador_id'))
     $this->addColumn($table, 'trabajador_id', $this->integer(11)->notNull());  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'trabajador_id'))
           $this->dropColumn($table,'trabajador_id');
     
    }
}
