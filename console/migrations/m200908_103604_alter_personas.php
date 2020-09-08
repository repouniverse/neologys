<?php

use console\migrations\baseMigration;

/**
 * Class m200908_103604_alter_personas
 */
class m200908_103604_alter_personas extends baseMigration
{
    const NAME_TABLE='{{%personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'domiciliopaisorigen'))
            $this->addColumn($table, 'domiciliopaisorigen', $this->string(200)->append($this->collateColumn()));
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'domiciliopaisorigen'))
           $this->dropColumn($table, 'domiciliopaisorigen');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200908_103604_alter_personas cannot be reverted.\n";

        return false;
    }
    */
}
