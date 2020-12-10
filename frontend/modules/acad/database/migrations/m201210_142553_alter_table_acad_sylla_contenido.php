<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201210_142553_alter_table_acad_sylla_contenido extends baseMigration
{
    const NAME_TABLE='{{%acad_contenido_syllabus}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'n_horas_cumplimiento'))
     $this->addColumn($table, 'n_horas_cumplimiento', $this->integer(3));  
    
if(!$this->existsColumn($table,'n_horas_trabajo_indep'))
     $this->addColumn($table, 'n_horas_trabajo_indep', $this->integer(3)); 

if(!$this->existsColumn($table,'n_sesion'))
     $this->addColumn($table, 'n_sesion', $this->integer(3)); 


    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'n_horas_cumplimiento'))
           $this->dropColumn($table,'n_horas_cumplimiento');
       if($this->existsColumn($table,'n_horas_trabajo_indep'))
           $this->dropColumn($table,'n_horas_trabajo_indep');
      if($this->existsColumn($table,'n_sesion'))
           $this->dropColumn($table,'n_sesion');
    }
}
