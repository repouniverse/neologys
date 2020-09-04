<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200901_220112_alter_table_planes extends baseMigration
{
    const NAME_TABLE='{{%inter_plan}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'finicio'))
     $this->addColumn($table, 'finicio', $this->string(10)->append($this->collateColumn()));  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'finicio'))
           $this->dropColumn($table,'finicio');
     
    }
}
