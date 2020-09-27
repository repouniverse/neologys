<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200927_014250_alter_table_entrevistas extends baseMigration
{
    const NAME_TABLE='{{%inter_entrevistas}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'codigo'))
     $this->addColumn($table, 'codigo', $this->string(16)->notNull()->append($this->collateColumn()));  
 if(!$this->existsColumn($table,'user_id'))
     $this->addColumn($table, 'user_id', $this->integer(11)->notNull());  
  
    }
 
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'codigo'))
           $this->dropColumn($table,'codigo');
     if($this->existsColumn($table,'user_id'))
           $this->dropColumn($table,'user_id');
    }
}
