<?php

namespace frontend\modules\encuesta\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210326_160706_alter_encuesta_permisos
 */
class m210326_160706_alter_encuesta_permisos extends baseMigration
{
    const NAME_TABLE='{{%encuesta_encuesta_general}}';
   
    /** 
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'codescuesla'))
             $this->addColumn($table, 'codescuesla', $this->char(20));  

        if(!$this->existsColumn($table,'codciclo'))
             $this->addColumn($table, 'codciclo', $this->char(20));
           
        if(!$this->existsColumn($table,'codcurso'))
             $this->addColumn($table, 'codcurso', $this->char(20));
        
        if(!$this->existsColumn($table,'estado'))
             $this->addColumn($table, 'estado', $this->char(20)->defaultValue('activo'));
        
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $table=static::NAME_TABLE; 

      if($this->existsColumn($table,'codescuesla'))
           $this->dropColumn($table,'codescuesla');
    
      if($this->existsColumn($table,'codciclo'))
           $this->dropColumn($table,'codciclo');

      if($this->existsColumn($table,'codcurso'))
           $this->dropColumn($table,'codcurso');
        
      if($this->existsColumn($table,'codcurso'))
           $this->dropColumn($table,'codcurso');
      
    }
}
