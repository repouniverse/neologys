<?php
 use console\migrations\baseMigration;
class m200923_203430_alter_table_universidades extends baseMigration
{
    const NAME_TABLE='{{%universidades}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'latitud'))
           $this->addColumn($table, 'latitud', $this->decimal(8,3)); 
      if(!$this->existsColumn($table,'meridiano'))
           $this->addColumn($table, 'meridiano', $this->decimal(8,3)); 
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
        if($this->existsColumn($table,'latitud'))
           $this->dropColumn($table, 'latitud');
       if($this->existsColumn($table,'meridiano'))
           $this->dropColumn($table, 'meridiano');
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
