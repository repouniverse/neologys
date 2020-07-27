<?php

use console\migrations\baseMigration;

/**
 * Class m200727_192359_create_table_departamentos
 */
class m200727_192359_create_table_departamentos extends baseMigration
{
    
    const NAME_TABLE='{{%departamentos}}';
    const NAME_TABLE_PERSONAS='{{%personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'coddepa' => $this->string(10)->append($this->collateColumn()),
            'nombredepa' => $this->string(40)->notNull()->append($this->collateColumn()),
            'detalles'=>$this->text()->append($this->collateColumn()),
            'correodepa' => $this->string(80)->append($this->collateColumn()),
            'webdepa' => $this->string(100)->append($this->collateColumn()),
            'codigoper' => $this->string(8)->append($this->collateColumn()),
            ], $this->collateTable());
      
        $this->addPrimaryKey('pk_facu',$table, 'coddepa');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'codigoper', static::NAME_TABLE_PERSONAS,'codigoper');
   
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
