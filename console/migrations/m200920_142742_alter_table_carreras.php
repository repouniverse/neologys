<?php
 use console\migrations\baseMigration;
class m200920_142742_alter_table_carreras extends baseMigration
{
    const NAME_TABLE='{{%carreras}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'esbase'))
           $this->addColumn($table, 'esbase', $this->char(1)->notNull()); 
      
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
        if($this->existsColumn($table,'esbase'))
           $this->dropColumn($table, 'esbase');
       
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
