<?php

use console\migrations\baseMigration;
/**
 * Class m201121_173530_create_table_matsec
 */
class m201121_173530_create_table_matsec extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const TABLE='{{%matricula}}';
    
    public function safeUp()
    {
 $table=static::TABLE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'curso_id' => $this->integer(11)->notNull(),
            'alumno_id' => $this->integer(11)->notNull(),
            'seccion' => $this->string(12)->append($this->collateColumn()),
            'periodo' => $this->string(10)->notNull()->append($this->collateColumn()),
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
        echo "m201121_173530_create_table_matsec cannot be reverted.\n";

        return false;
    }
    */
}
