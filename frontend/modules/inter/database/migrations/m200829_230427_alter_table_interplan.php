<?php

namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200829_230427_alter_table_interplan extends baseMigration
{
    const NAME_TABLE='{{%inter_plan}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'etapa_id'))
     $this->addColumn($table, 'etapa_id', $this->integer(11));  

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'etapa_id'))
           $this->dropColumn($table,'etapa_id');
      
      
    }
}
