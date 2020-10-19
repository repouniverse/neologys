<?php 
use console\migrations\baseMigration;
class m201019_141905_alter_table_universidades extends baseMigration
{
    const NAME_TABLE='{{%universidades}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'web'))
           $this->addColumn($table, 'web', $this->string(100)->append($this->collateColumn())); 
     
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'web'))
           $this->dropColumn($table, 'web');
     
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
