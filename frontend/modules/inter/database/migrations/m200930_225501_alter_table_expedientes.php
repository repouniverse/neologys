<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200930_225501_alter_table_expedientes extends baseMigration
{
    const NAME_TABLE='{{%inter_expedientes}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'iscurrent'))
     $this->addColumn($table, 'iscurrent', $this->char(1)->notNull()->append($this->collateColumn()));  
 
  
    }
 
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'iscurrent'))
           $this->dropColumn($table,'iscurrent');
   
    }
}
