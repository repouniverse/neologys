<?php

use console\migrations\baseMigration;

/**
 * Class m200821_145450_alter_table_grupopersonas
 */
class m200821_145450_alter_table_grupopersonas extends baseMigration
{
      const NAME_TABlE='{{%grupo_personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=self::NAME_TABlE;
     if(!$this->existsColumn($table,'layout'))
        $this->addColumn(self::NAME_TABlE, 'layout', $this->string(100)->append($this->collateColumn())->defaultValue(null));
         
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $table=static::NAME_TABlE;
     if($this->existsColumn($table,'layout'))
       $this->dropColumn(self::NAME_TABlE, 'layout');
     
        return true;
    }

 
}
