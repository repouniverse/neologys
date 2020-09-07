<?php
    use console\migrations\baseMigration;

class m200813_220212_add_columns_alumno extends baseMigration
{
    const NAME_TABLE='{{%alumnos}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'mail'))
            $this->addColumn($table, 'mail', $this->string(100));
        if(!$this->existsColumn($table,'motivo'))
            $this->addColumn($table, 'motivo', $this->string(100));
    }
    
    public function safeDown()
    {
        $table=static::NAME_TABLE; 
        if($this->existsColumn($table,'mail'))
            $this->dropColumn($table,'mail');
        if($this->existsColumn($table,'motivo'))
            $this->dropColumn($table,'motivo');
    }
}
