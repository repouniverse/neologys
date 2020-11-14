<?php
namespace frontend\modules\regacad\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m201112_222502_create_table_docureg
 */
class m201112_222502_create_table_docureg extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    CONST TABLE_NAME='{{%docureg}}';
    public function safeUp()
    {
      $table=static::TABLE_NAME;
        if(!$this->existsTable($table)){
            $this->createTable($table, [
            'id'=>$this->primaryKey(),           
            'descripcion'=>$this->string(30)->notNull()->append($this->collateColumn()),
            'activo'=>$this->char(1)->append($this->collateColumn()),
           'comentarios'=>$this->text()->append($this->collateColumn()),            
            ], $this->collateTable());
       }    
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $table=static::TABLE_NAME;
         if ($this->existsTable($table)) {
            $this->dropTable($table);
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201112_222502_create_table_docureg cannot be reverted.\n";

        return false;
    }
    */
}
