<?php
  use console\migrations\baseMigration;
class m200918_183737_alter_table_alumno extends baseMigration
{
    const NAME_TABLE='{{%alumnos}}';
    const NAME_TABLE_PERSONAS='{{%personas}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'am'))
           $this->alterColumn($table, 'am', $this->string(40)); 
        
        $tableP=static::NAME_TABLE_PERSONAS;
        if($this->existsColumn($tableP,'am'))
           $this->alterColumn($tableP, 'am', $this->string(40)); 
       
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
      return true;
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
