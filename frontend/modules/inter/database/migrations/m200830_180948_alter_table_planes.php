<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200830_180948_alter_table_planes extends baseMigration
{
    const NAME_TABLE='{{%inter_plan}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'ordenetapa'))
     $this->addColumn($table, 'ordenetapa', $this->integer(3));  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'ordenetapa'))
           $this->dropColumn($table,'ordenetapa');
     
    }
}
