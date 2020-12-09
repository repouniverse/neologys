<?php

use console\migrations\baseMigration;
class m201204_160200_alter_table_planes_estudio extends baseMigration
{
    const NAME_TABLE='{{%planes_estudio}}';
    public function safeUp()
    {

$table=static::NAME_TABLE;
   if(!$this->existsColumn($table,'planes_id'))
     $this->addColumn($table, 'planes_id', $this->integer(11));

   /*$this->addForeignKey($this->generateNameFk($table),
                    $table,'codperiodo', static::TABLE_PLANE,'codperiodo');
      
*/

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'planes_id'))
           $this->dropColumn($table,'planes_id');
      
    }
}
