<?php

use console\migrations\baseMigration;

/**
 * Class m201121_182245_create_table_asesores
 */
class m201121_182245_create_table_asesores extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const TABLE='{{%asesores_curso}}';

    public function safeUp()
    {
 $table=static::TABLE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'matricula_id' => $this->integer(11)->notNull(),
            'alumno_id' => $this->integer(11)->notNull(),
            'asesor_id' => $this->integer(11)->append($this->collateColumn()),
            'activo' => $this->char(1)->append($this->collateColumn())         
            ],
           $this->collateTable());
      
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
        echo "m201121_182245_create_table_asesores cannot be reverted.\n";

        return false;
    }
    */
}
