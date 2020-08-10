<?php

use console\migrations\baseMigration;

/**
 * Class m200810_143136_create_table_token
 */
class m200810_143136_create_table_token extends baseMigration
{
    const NAME_TABLE='{{%tokens}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsTable($table)){
        $this->createTable($table, [
         'id'=>$this->primaryKey(),
          'type'=>$this->string(255)->append($this->collateColumn()), 
          'name'=>$this->string(255)->append($this->collateColumn()),
          'token'=>$this->string(32)->append($this->collateColumn()),
          'created_at'=>$this->dateTime(),
             'expired_at'=>$this->dateTime(),
            ], $this->collateTable());
     
            }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         if ($this->existsTable(static::NAME_TABLE)) {
            $this->dropTable(static::NAME_TABLE);
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200810_143136_create_table_token cannot be reverted.\n";

        return false;
    }
    */
}
