<?php

use console\migrations\baseMigration;
class m201021_210606_alter_table_alumnos extends baseMigration
{
    const NAME_TABLE='{{%alumnos}}';
    public function safeUp()
    {
        $table=static::NAME_TABLE; 
        if($this->existsColumn($table,'facudest_id')){
            $this->dropColumn ($table, 'facudest_id');
             $this->addColumn ($table, 'facudest_id',$this->integer(11));
        }
         if($this->existsColumn($table,'carreradest_id')){
            $this->dropColumn ($table, 'carreradest_id');
             $this->addColumn ($table, 'carreradest_id',$this->integer(11));
        }
         if($this->existsColumn($table,'unidest_id')){
            $this->dropColumn ($table, 'unidest_id');
             $this->addColumn ($table, 'unidest_id',$this->integer(11));
        }
           
     
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
     
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200908_234434_alter_personas cannot be reverted.\n";

        return false;
    }
    */
}