<?php

use console\migrations\baseMigration;

/**
 * Class m200728_162253_add_columns_to_tables
 */
class m200728_162253_add_columns_to_tables extends baseMigration
{
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_ALUMNOS='{{%alumnos}}';
     const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
    const NAME_COLUMN_UNIVERSIDAD_ID='universidad_id';
     const NAME_COLUMN_CODIGO_FAC='codfac';
    public function safeUp()
    {
        $this->addColumn(self::NAME_TABLE_FACULTADES,
                self::NAME_COLUMN_UNIVERSIDAD_ID,
                'integer(11)');
        
         $this->addForeignKey(
            $this->generateNameFk(self::NAME_TABLE_FACULTADES),
            self::NAME_TABLE_FACULTADES,
            self::NAME_COLUMN_UNIVERSIDAD_ID, 
            static::NAME_TABLE_UNIVERSIDADES,'id');
    
        $this->addColumn(self::NAME_TABLE_ALUMNOS, 
                self::NAME_COLUMN_UNIVERSIDAD_ID,
                'integer(11)');
        
         $this->addForeignKey(
            $this->generateNameFk(self::NAME_TABLE_FACULTADES),
            self::NAME_TABLE_FACULTADES,
            self::NAME_COLUMN_UNIVERSIDAD_ID, 
            static::NAME_TABLE_UNIVERSIDADES,'id');
        
        $this->addColumn(self::NAME_TABLE_DEPARTAMENTOS, 
                self::NAME_COLUMN_UNIVERSIDAD_ID,
                'integer(11)');
        
        
        
        $this->addColumn(self::NAME_TABLE_DEPARTAMENTOS, 
                self::NAME_COLUMN_CODIGO_FAC,
                'string(10)');
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(self::NAME_TABLE, self::NAME_COLUMN, $this->string(6));
   
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200727_173302_alter_table_profile cannot be reverted.\n";

        return false;
    }
    */
}
