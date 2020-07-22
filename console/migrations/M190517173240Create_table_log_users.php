<?php

//namespace console\migrations;

use yii\db\Migration;
use  console\migrations\baseMigration;
/**
 * Class M190517173240Create_table_log_users
 */
class M190517173240Create_table_log_users extends baseMigration
{

 const NAME_TABLE='{{%useraudit}}';
  const NAME_TABLE_USER='{{%user}}';
  // const NAME_TABLE_MAESTRO='{{%maestrocompo}}';
    public function safeUp()
    {
       
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
             'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(11),
            'when'=>$this->char(19)->append($this->collateColumn()),
            'ip'=>$this->string(19)->append($this->collateColumn()),
            'action'=>$this->string(6)->append($this->collateColumn()),
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'user_id', static::NAME_TABLE_USER,'id');
        
      
}
    
    }

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }

    }
}