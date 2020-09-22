<?php
 use console\migrations\baseMigration;
class m200920_150308_alter_table_docentes extends baseMigration
{
    const NAME_TABLE='{{%docentes}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'carrera_base'))
           $this->addColumn($table, 'carrera_base', $this->integer(11)); 
      
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
        if($this->existsColumn($table,'carrera_base'))
           $this->dropColumn($table, 'carrera_base');
       
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
