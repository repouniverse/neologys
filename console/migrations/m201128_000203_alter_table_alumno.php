<?php

use yii\db\Migration;
use console\migrations\baseMigration;

/**
 * Class m201128_000203_alter_table_alumno
 */
class m201128_000203_alter_table_alumno extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABLE='{{%alumnos}}';
    public function safeUp()
    {
        $table=static::NAME_TABLE; 
        if(!$this->existsColumn($table,'seming')){
           $this->addColumn ($table, 'seming',$this->string(11));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE; 
        if($this->existsColumn($table,'seming')){
           $this->dropColumn ($table, 'seming');
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201128_000203_alter_table_alumno cannot be reverted.\n";

        return false;
    }
    */
}
