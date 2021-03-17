<?php

use console\migrations\baseMigration;

/**
 * Class m210315_165158_alter_table_alumnos
 */
class m210315_165158_alter_table_alumnos extends Migration
{
    const NAME_TABLE='{{%alumnos}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'financiamientobeca'))
            $this->addColumn($table, 'financiamientobeca', $this->string(255)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'financiamientoprestamo'))
            $this->addColumn($table, 'financiamientoprestamo', $this->string(255)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'financiamientopropio'))
            $this->addColumn($table, 'financiamientopropio', $this->string(255)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'financiamientootro'))
            $this->addColumn($table, 'financiamientootro', $this->string(255)->append($this->collateColumn()));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'financiamientobeca'))
            $this->dropColumn($table, 'financiamientobeca');
        if($this->existsColumn($table,'financiamientoprestamo'))
            $this->dropColumn($table, 'financiamientoprestamo');
        if($this->existsColumn($table,'financiamientobeca'))
            $this->dropColumn($table, 'financiamientobeca');
        if($this->existsColumn($table,'financiamientopropio'))
            $this->dropColumn($table, 'financiamientootro');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210315_165158_alter_table_alumnos cannot be reverted.\n";

        return false;
    }
    */
}
