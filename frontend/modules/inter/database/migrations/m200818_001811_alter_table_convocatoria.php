<?php

namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200818_001811_alter_table_convocatoria extends baseMigration
{
    const NAME_TABLE='{{%inter_convocados}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'estado'))
     $this->addColumn($table, 'estado', $this->char(1));  
if(!$this->existsColumn($table,'motivos'))
     $this->addColumn($table, 'motivos', $this->text());   
    
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'estado'))
           $this->dropColumn($table,'estado');
      if($this->existsColumn($table,'motivos'))
    $this->dropColumn($table,'motivos');
      
    }
}
