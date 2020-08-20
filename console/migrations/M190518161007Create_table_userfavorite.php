<?php



use  console\migrations\baseMigration;

/**
 * Class M190518161007Create_table_userfavorite
 */
class M190518161007Create_table_userfavorite extends baseMigration
{

 const NAME_TABLE='{{%userfavoritos}}';
 const NAME_TABLE_USER='{{%users}}';
    public function safeUp()
    {
       
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
             'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(11)->notNull(),
            'url' => $this->string(125)->append($this->collateColumn()),
            'alias' => $this->string(30)->append($this->collateColumn()),
            'ishome' => $this->char(1)->append($this->collateColumn()),
            'order'=> $this->integer(3),
             ],$this->collateTable());
        /* $this->addForeignKey('fk_usXEf_users5', static::NAME_TABLE,
              'user_id', static::NAME_TABLE_USER,'id');*/
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
