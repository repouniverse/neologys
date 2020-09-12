<?php
  use console\migrations\baseMigration;
class m200911_225512_users_universities extends baseMigration
{
    
    const NAME_TABLE='{{%users_universities}}';
    //const NAME_TABLE_FACULTADES='{{%facultades}}';
    const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_USERS='{{%user}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsTable($table))
        {
            $this->createTable($table, 
            [
                'id'=>$this->primaryKey(),
                //'facultad_id'=>$this->integer(11),
                //'universidad_id'=>$this->integer(11),
                'universidad_id'=>$this->integer(11)->notNull(),
                'user_id'=>$this->integer(11)->notNull(),
                'activo'=>$this->char(1)->notNull()->append($this->collateColumn()),
                
            ], $this->collateTable());
            $this->addForeignKey($this->generateNameFk($table),
                    $table,'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
            $this->addForeignKey($this->generateNameFk($table),
                    $table,'user_id', static::NAME_TABLE_USERS,'id');
            }
    }
     public function safeDown()
    {
        if ($this->existsTable(static::NAME_TABLE)) {
            $this->dropTable(static::NAME_TABLE);
        }
    }
    /**
     * {@inheritdoc}
     */
  
}
