<?php

use console\migrations\baseMigration;

/**
 * Class m200907_140325_alter_persona
 */
class m200907_140325_alter_persona extends baseMigration
{
    const NAME_TABLE='{{%personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'alergias'))
            $this->addColumn($table, 'alergias', $this->string(100)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'gruposangu'))
            $this->addColumn($table, 'gruposangu', $this->string(10)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'usoregulmedic'))
            $this->addColumn($table, 'usoregulmedic', $this->string(30)->append($this->collateColumn()));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'alergias'))
            $this->dropColumn($table, 'alergias');
        if($this->existsColumn($table,'gruposangu'))
            $this->dropColumn($table, 'gruposangu');
        if($this->existsColumn($table,'usoregulmedic'))
            $this->dropColumn($table, 'usoregulmedic');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200907_140325_alter_persona cannot be reverted.\n";

        return false;
    }
    */
}
