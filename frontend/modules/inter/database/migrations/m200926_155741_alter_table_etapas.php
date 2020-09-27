<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200926_155741_alter_table_etapas extends baseMigration
{
    const NAME_TABLE='{{%inter_etapas}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'esfinal'))
     $this->addColumn($table, 'esfinal', $this->char(1)->notNull());  
 
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'esfinal'))
           $this->dropColumn($table,'esfinal');
     
    }
}
