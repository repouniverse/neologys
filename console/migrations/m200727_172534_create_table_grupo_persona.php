<?php

use console\migrations\baseMigration;


/**
 * Class m200731_183904_create_table_grupo_persona
 */
class m200727_172534_create_table_grupo_persona extends baseMigration
{
    
    const NAME_TABLE='{{%grupo_personas}}';
    //const NAME_TABLE_PERSONAS='{{%personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            //'id'=>$this->primaryKey(),
            'codgrupo'=>$this->string(3)->notNull()->append($this->collateColumn()),
            'desgrupo' => $this->string(60)->notNull()->append($this->collateColumn()),
            'modelo' => $this->string(100)->notNull()->append($this->collateColumn()),
           //'detalle' => $this->string(20)->append($this->collateColumn()),
            'detalle'=>$this->text()->append($this->collateColumn())
            ], $this->collateTable());      
    $this->addPrimaryKey($this->generateNameFk($table),static::NAME_TABLE, 'codgrupo');
   
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
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
