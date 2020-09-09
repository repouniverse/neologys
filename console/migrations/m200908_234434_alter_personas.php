<?php

use console\migrations\baseMigration;

/**
 * Class m200908_234434_alter_personas
 */
class m200908_234434_alter_personas extends baseMigration
{
    const NAME_TABLE='{{%personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'parentcontpaisresid'))
        {
            $this->addColumn($table, 'parentcontpaisresid', $this->string(200)->append($this->collateColumn())); 
        }
        else
        {
            $this->dropColumn($table, 'parentcontpaisresid');
            $this->addColumn($table, 'parentcontpaisresid', $this->string(200)->append($this->collateColumn())); 
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'parentcontpaisresid'))
           $this->dropColumn($table, 'parentcontpaisresid');
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
