<?php
  use console\migrations\baseMigration;
 
class m200911_230337_alter_table_profile extends baseMigration
{
    const NAME_TABLE='{{%profile}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'universidad_id'))
           $this->addColumn($table, 'universidad_id', $this->integer(11)->notNull()); 
       if(!$this->existsColumn($table,'multiple_universidad'))
           $this->addColumn($table, 'multiple_universidad', $this->char(1)->notNull()); 
       
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'universidad_id'))
           $this->dropColumn($table, 'universidad_id');
        if($this->existsColumn($table,'multiple_universidad'))
           $this->dropColumn($table, 'multiple_universidad');
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
