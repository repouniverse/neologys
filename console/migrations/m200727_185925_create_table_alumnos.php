<?php


use console\migrations\baseMigration;
/**
 * Class m200727_172535_create_table_trabajadores*/
class m200727_185925_create_table_alumnos extends baseMigration
{
    
    const NAME_TABLE='{{%alumnos}}';
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'codalu' => $this->string(16)->notNull()->append($this->collateColumn()),
            'codalu1' => $this->string(16)->append($this->collateColumn()),
            'codalu2' => $this->string(16)->append($this->collateColumn()),
            'codper'=>$this->string(8)->append($this->collateColumn()),
            'ap'=>$this->string(40)->append($this->collateColumn()),
            'am'=>$this->string(40)->append($this->collateColumn()),
            'nombres'=>$this->string(40)->append($this->collateColumn()),
           'codpering'=>$this->string(10)->notNull()->append($this->collateColumn()),
             'codfac'=>$this->string(10)->notNull()->append($this->collateColumn()),
              'codesp'=>$this->string(8)->append($this->collateColumn()),
            
            ], $this->collateTable());
      
         $this->createIndex(uniqid('k_ap'), static::NAME_TABLE, 'ap');
        $this->createIndex(uniqid('k_am'), static::NAME_TABLE, 'am');
        $this->createIndex(uniqid('k_nombres'), static::NAME_TABLE, 'nombres');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'codfac', static::NAME_TABLE_FACULTADES,'codfac');
   
       
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
