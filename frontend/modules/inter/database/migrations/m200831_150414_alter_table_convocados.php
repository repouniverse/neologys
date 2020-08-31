<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200831_150414_alter_table_convocados extends baseMigration
{
    const NAME_TABLE='{{%inter_convocados}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'current_etapa'))
     $this->addColumn($table, 'current_etapa', $this->integer(3));  

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'current_etapa'))
           $this->dropColumn($table,'current_etapa');
      
    }
}