<?php

use console\migrations\baseMigration;

/**
 * Class m201121_173500_create_table_cursos
 */
class m201121_173500_create_table_cursos extends baseMigration
{
    /**
     * {@inheritdoc}
     */

    const TABLE='{{%cursos}}';
    public function safeUp()
    {
         $table=static::TABLE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'codcur' => $this->string(18)->append($this->collateColumn()),
            'descripcion' => $this->string(40)->append($this->collateColumn()),
            'ciclo' => $this->string(2)->append($this->collateColumn()),
            'activo' => $this->char(1)->append($this->collateColumn()),
            'plan_id' => $this->integer(11)            
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
        echo "m201121_173500_create_table_cursos cannot be reverted.\n";

        return false;
    }
    */
}
