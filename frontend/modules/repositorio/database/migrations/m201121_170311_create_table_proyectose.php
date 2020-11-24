<?php
namespace frontend\modules\repositorio\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m201121_170311_create_table_proyectose
 */
class m201121_170311_create_table_proyectose extends baseMigration
{
    const TABLE='{{%repositorio_proyectose}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       return true;
      
        /* $this->addForeignKey($this->generateNameFk($table), $table,
              'programa_id', static::NAME_TABLE_PROGRAMAS,'id');*/
           
         


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201121_170311_create_table_proyectose cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201121_170311_create_table_proyectose cannot be reverted.\n";

        return false;
    }
    */
}
