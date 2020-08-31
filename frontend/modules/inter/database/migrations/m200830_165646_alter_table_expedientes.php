<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200830_165646_alter_table_expedientes extends baseMigration
{
    const NAME_TABLE='{{%inter_expedientes}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'plan_id'))
     $this->addColumn($table, 'plan_id', $this->integer(11));  
if(!$this->existsColumn($table,'orden'))
     $this->addColumn($table, 'orden', $this->integer(2));  
if(!$this->existsColumn($table,'etapa_id'))
     $this->addColumn($table, 'etapa_id', $this->integer(2));  
if(!$this->existsColumn($table,'secuencia'))
     $this->addColumn($table, 'secuencia', $this->integer(2));  
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'plan_id'))
           $this->dropColumn($table,'plan_id');
      if($this->existsColumn($table,'orden'))
           $this->dropColumn($table,'orden');
      if($this->existsColumn($table,'etapa_id'))
           $this->dropColumn($table,'etapa_id');
      if($this->existsColumn($table,'secuencia'))
           $this->dropColumn($table,'secuencia');
      
    }
}
