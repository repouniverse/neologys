<?php

use console\migrations\baseMigration;
class m130524_201442_init extends baseMigration
{ 
 const NAME_TABLE='{{%user}}';
 public function up()
    {
        
       // var_dump($this->existsTable(static::NAME_TABLE));die();
if(!$this->existsTable(static::NAME_TABLE)) {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->append($this->collateColumn()),
            'auth_key' => $this->string(32)->notNull()->append($this->collateColumn()),
            'password_hash' => $this->string()->notNull()->append($this->collateColumn()),
            'password_reset_token' => $this->string()->unique()->append($this->collateColumn()),
            'email' => $this->string()->notNull()->unique()->append($this->collateColumn()),
           'password_reset_token' => $this->string()->unique()->append($this->collateColumn()),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $this->collateTable());
    }
    }
    public function down()
    {
      // $this->dropTable(static::NAME_TABLE);
    }
}
