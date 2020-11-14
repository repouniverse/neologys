<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m201027_234030_alter_table_programas extends baseMigration
{
    const NAME_TABLE='{{%inter_programa}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'numero'))
     $this->addColumn($table, 'numero', $this->string(10)->notNull()->append($this->collateColumn()));  
 if(!$this->existsColumn($table,'carrera_id'))
     $this->addColumn($table, 'carrera_id', $this->string(10)->notNull()->append($this->collateColumn()));  
   
  
    }
 
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'numero'))
           $this->dropColumn($table,'numero');
   
    }
}
