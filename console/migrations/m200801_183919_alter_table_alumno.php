<?php

use console\migrations\baseMigration;

/**
 * Class m200731_183919_alter_table_persona
 */
class m200801_183919_alter_table_alumno extends baseMigration
{
    const NAME_TABLE='{{%alumnos}}';
    //const NAME_TABLE_GRUPOS_PERSONAS='{{%grupo_personas}}';
     const NAME_COLUMN_TIPODOC='tipodoc';
     const NAME_COLUMN_NUMERODOC='numerodoc';
     const NAME_COLUMN_PERSONAID='persona_id';
    public function safeUp()
    {
        $table=self::NAME_TABLE;
    
        if(!$this->existsColumn($table,self::NAME_COLUMN_TIPODOC)){
            $this->addColumn(self::NAME_TABLE,
                self::NAME_COLUMN_TIPODOC,
                'CHAR(2)');
                
        }
        if(!$this->existsColumn($table,self::NAME_COLUMN_NUMERODOC)){
        $this->addColumn(self::NAME_TABLE,
                self::NAME_COLUMN_NUMERODOC,
                'varchar(20)');
        }
        if(!$this->existsColumn($table,self::NAME_COLUMN_PERSONAID)){
            $this->addColumn(self::NAME_TABLE,
                self::NAME_COLUMN_PERSONAID,
                'integer(11)');
                
        }
         
    
       
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=self::NAME_TABLE;
       if($this->existsColumn($table,self::NAME_COLUMN_TIPODOC)){
            $this->dropColumn(self::NAME_TABLE,
                self::NAME_COLUMN_TIPODOC);
                
        }
        if($this->existsColumn($table,self::NAME_COLUMN_NUMERODOC)){
        $this->dropColumn(self::NAME_TABLE,
                self::NAME_COLUMN_NUMERODOC);
        }
         if($this->existsColumn($table,self::NAME_COLUMN_PERSONAID)){
            $this->dropColumn(self::NAME_TABLE,
                self::NAME_COLUMN_PERSONAID);
                
        }
    }
    
}