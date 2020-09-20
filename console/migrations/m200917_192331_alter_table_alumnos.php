<?php
  use console\migrations\baseMigration;
class m200917_192331_alter_table_alumnos extends baseMigration
{
    const NAME_TABLE='{{%alumnos}}';
    const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'unidest_id'))
           $this->addColumn($table, 'unidest_id', $this->integer(11)->notNull()); 
       if(!$this->existsColumn($table,'facudest_id'))
           $this->addColumn($table, 'facudest_id',  $this->integer(11)->notNull()); 
       if(!$this->existsColumn($table,'carreradest_id'))
           $this->addColumn($table, 'carreradest_id',  $this->integer(11)->notNull()); 
      
       /*$this->addForeignKey($this->generateNameFk($table), $table,
              'unidest_id', self::NAME_TABLE_UNIVERSIDADES,'id'); 
        $this->addForeignKey($this->generateNameFk($table), $table,
              'facudest_id', self::NAME_TABLE_FACULTADES,'id'); */
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'unidest_id'))
           $this->dropColumn($table, 'unidest_id');
        if($this->existsColumn($table,'facudest_id'))
           $this->dropColumn($table, 'facudest_id');
        if($this->existsColumn($table,'carreradest_id'))
           $this->dropColumn($table, 'carreradest_id');
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
