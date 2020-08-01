<?php

use console\migrations\baseMigration;

/**
 * Class m200731_183919_alter_table_persona
 */
class m200731_183919_alter_table_persona extends baseMigration
{
    const NAME_TABLE='{{%personas}}';
    const NAME_TABLE_GRUPOS_PERSONAS='{{%grupo_personas}}';
     const NAME_COLUMN_CODIGO_GRUPO='codgrupo';
     const NAME_COLUMN_IDENTIDAD_ID='identidad_id';
    public function safeUp()
    {
        $table=self::NAME_TABLE;
    
        if(!$this->existsColumn($table,self::NAME_COLUMN_CODIGO_GRUPO)){
            $this->addColumn(self::NAME_TABLE,
                self::NAME_COLUMN_CODIGO_GRUPO,
                'string(3)');
                $this->addForeignKey(
                $this->generateNameFk(self::NAME_TABLE),
                self::NAME_TABLE,
                self::NAME_COLUMN_CODIGO_GRUPO, 
                static::NAME_TABLE_GRUPOS_PERSONAS,
                 self::NAME_COLUMN_CODIGO_GRUPO);
        }
        if(!$this->existsColumn($table,self::NAME_COLUMN_IDENTIDAD_ID)){
        $this->addColumn(self::NAME_TABLE,
                self::NAME_COLUMN_IDENTIDAD_ID,
                'integer(11)');
        }
        
         
    
       
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        if($this->existsColumn(self::NAME_TABLE,self::NAME_COLUMN_CODIGO_GRUPO)){
            $this->dropColumn(self::NAME_TABLE,self::NAME_COLUMN_CODIGO_GRUPO);
        }
        /*$this->dropColumn(self::NAME_TABLE,
            self::NAME_COLUMN_CODIGO_GRUPO);*/
        if($this->existsColumn(self::NAME_TABLE,self::NAME_COLUMN_IDENTIDAD_ID)){
        $this->dropColumn(self::NAME_TABLE,
                self::NAME_COLUMN_IDENTIDAD_ID);
        }
    }
    
}