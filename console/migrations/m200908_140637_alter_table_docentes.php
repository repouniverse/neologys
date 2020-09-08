<?php
use console\migrations\baseMigration;
class m200908_140637_alter_table_docentes extends baseMigration
{
    const NAME_TABLE='{{%docentes}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'mail'))
            $this->addColumn($table, 'mail', $this->string(100)->append($this->collateColumn()));
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'mail'))
           $this->dropColumn($table, 'mail');
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
