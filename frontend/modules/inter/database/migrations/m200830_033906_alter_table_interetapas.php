<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200830_033906_alter_table_interetapas extends baseMigration
{
    const NAME_TABLE='{{%inter_etapas}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'awe'))
     $this->addColumn($table, 'awe', $this->string(60)->append($this->collateColumn()));  
if(!$this->existsColumn($table,'orden'))
     $this->addColumn($table, 'orden', $this->integer(3));  

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'awe'))
           $this->dropColumn($table,'awe');
       if($this->existsColumn($table,'orden'))
           $this->dropColumn($table,'orden');
      
    }
}
