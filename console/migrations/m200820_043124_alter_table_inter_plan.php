<?php

use console\migrations\baseMigration;

/**
 * Class m200820_043124_alter_table_inter_plan
 */
class m200820_043124_alter_table_inter_plan extends baseMigration
{
    const NAME_TABLE='{{%inter_plan}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
            if(!$this->existsColumn($table,'etapa'))
                    $this->addColumn($table, 'etapa', $this->char(1)->append($this->collateColumn()));
           
      $this->putCombo($table, 'etapa', ['DOCUMENTACION','ENTREVISTAS','SEGUIMIENTO','CIERRE']);
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'etapa'))
                    $this->dropColumn($table, 'etapa');
           
    }

}
