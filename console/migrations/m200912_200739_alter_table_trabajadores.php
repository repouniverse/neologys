<?php
  use console\migrations\baseMigration;
class m200912_200739_alter_table_trabajadores extends baseMigration
{
    const NAME_TABLE='{{%trabajadores}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'universidad_id'))
           $this->addColumn($table, 'universidad_id', $this->integer(11)->notNull()); 
       if(!$this->existsColumn($table,'facultad_id'))
           $this->addColumn($table, 'facultad_id',  $this->integer(11)->notNull()); 
       if(!$this->existsColumn($table,'depa_id'))
           $this->addColumn($table, 'depa_id',  $this->integer(11)->notNull()); 
        if(!$this->existsColumn($table,'cargo_id'))
           $this->addColumn($table, 'cargo_id',  $this->integer(11)->notNull()); 
       
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'universidad_id'))
           $this->dropColumn($table, 'universidad_id');
        if($this->existsColumn($table,'facultad_id'))
           $this->dropColumn($table, 'facultad_id');
         if($this->existsColumn($table,'depa_id'))
           $this->dropColumn($table, 'depa_id');
         if($this->existsColumn($table,'cargo_id'))
           $this->dropColumn($table, 'cargo_id');
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
