<?php

use console\migrations\baseMigration;

/**
 * Class m200907_135440_alter_alumnos
 */
class m200907_135440_alter_alumnos extends baseMigration
{
    const NAME_TABLE='{{%alumnos}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'mail'))
            $this->addColumn($table, 'mail', $this->string(100)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'motivo'))
            $this->addColumn($table, 'motivo', $this->string(100)->append($this->collateColumn()));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE; 
        if($this->existsColumn($table,'mail'))
            $this->dropColumn($table, 'mail');
        if($this->existsColumn($table,'motivo'))
            $this->dropColumn($table, 'motivo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200907_135440_alter_alumnos cannot be reverted.\n";

        return false;
    }
    */
}
