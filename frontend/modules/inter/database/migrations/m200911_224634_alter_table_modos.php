<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200911_224634_alter_table_modos extends baseMigration
{
    const NAME_TABLE='{{%inter_modos}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'externalpeople'))
     $this->addColumn($table, 'externalpeople', $this->char(1)->append($this->collateColumn()));  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'externalpeople'))
           $this->dropColumn($table,'externalpeople');
     
    }
}
