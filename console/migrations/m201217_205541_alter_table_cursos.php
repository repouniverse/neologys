<?php
use console\migrations\baseMigration;
class m201217_205541_alter_table_cursos  extends baseMigration
{
    const NAME_TABLE='{{%cursos}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

          $table=static::NAME_TABLE;
       if(!$this->existsColumn($table,'area_id'))
          $this->addColumn($table, 'area_id', $this->integer(11));

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
        if($this->existsColumn($table,'area_id'))
           $this->dropColumn($table,'area_id');
      
    }
}
