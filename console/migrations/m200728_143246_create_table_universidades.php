<?php

use console\migrations\baseMigration;

/**
 * Class m200728_143246_create_table_universidades
 */
class m200728_143246_create_table_universidades extends baseMigration
{
    
    const NAME_TABLE='{{%universidades}}';
    //const NAME_TABLE_PERSONAS='{{%personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'codpais'=>$this->string(3)->append($this->collateColumn()),
            'nombre' => $this->string(60)->notNull()->append($this->collateColumn()),
            'acronimo' => $this->string(12)->notNull()->append($this->collateColumn()),
           'estado' => $this->string(20)->append($this->collateColumn()),
            'detalle'=>$this->text()->append($this->collateColumn())
            ], $this->collateTable());
      
    
   
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
