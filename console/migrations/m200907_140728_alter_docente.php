<?php

use console\migrations\baseMigration;

/**
 * Class m200907_140728_alter_docente
 */
class m200907_140728_alter_docente extends baseMigration
{
    const NAME_TABLE='{{%docentes}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'correo'))
            $this->addColumn($table, 'correo', $this->string(100)->append($this->collateColumn()));
        
        $this->putCombo($table,'categoria', ['PRINCIPAL','ASOCIADO','AUXILIAR']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if($this->existsColumn($table,'correo'))
            $this->dropColumn($table, 'correo'); 
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200907_140728_alter_docente cannot be reverted.\n";

        return false;
    }
    */
}
