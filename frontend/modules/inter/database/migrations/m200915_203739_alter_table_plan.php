<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200915_203739_alter_table_plan extends baseMigration
{
    const NAME_TABLE='{{%inter_plan}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'notificamail'))
     $this->addColumn($table, 'notificamail', $this->char(1)->append($this->collateColumn()));  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'notificamail'))
           $this->dropColumn($table,'notificamail');
     
    }
}
