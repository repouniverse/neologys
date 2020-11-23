<?php

use console\migrations\baseMigration;

/**
 * Class m201121_171330_create_table_asesores
 */
class m201121_171330_create_table_asesores extends Migration
{
    /**
     * {@inheritdoc}
     */

    const TABLE='{{%repositorio_asesores}}'
    public function safeUp()
    {
$table=static::TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
           // 'programa_id'=>$this->integer(11),
           // 'modo_id'=>$this->integer(11),
            'persona_id'=>$this->integer(11)->notNull(),
            'curso_id'=>$this->integer(11)->notNull(),
            'orcid'=>$this->string(250)->append($this->collateColumn()),
            'comentarios'=>$this->text()->append($this->collateColumn()),            
            ], $this->collateTable());
      
        /* $this->addForeignKey($this->generateNameFk($table), $table,
              'programa_id', static::NAME_TABLE_PROGRAMAS,'id');*/
           
       }     

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if ($this->existsTable(static::TABLE)) {
            $this->dropTable(static::TABLE);
        }

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201121_171330_create_table_asesores cannot be reverted.\n";

        return false;
    }
    */
}
