<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201210_152215_alter_table_acad_sylla_unidades extends baseMigration
{
    const NAME_TABLE='{{%acad_syllabus_unidades}}';
    const NAME_TABLE_ALTERNA='{{%acad_contenido_syllabus}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp() 
    {

$table=static::NAME_TABLE;
$tableAlterna=static::NAME_TABLE_ALTERNA;
if(!$this->existsColumn($table,'n_semana'))
     $this->addColumn($table, 'n_semana', $this->integer(3));  
  if(!$this->existsColumn($table,'numero_semanas'))
     $this->addColumn($table, 'numero_semanas', $this->integer(3));  
   
    if(!$this->existsColumn($table,'n_sesiones_semana'))
     $this->addColumn($table, 'n_sesiones_semana', $this->integer(3)); 
    
   
   if($this->existsColumn($tableAlterna,'n_horas_cumplimiento'))
     $this->alterColumn ($tableAlterna,'n_horas_cumplimiento',$this->decimal(5,2));
   if($this->existsColumn($tableAlterna,'n_horas_trabajo_indep'))
     $this->alterColumn ($tableAlterna,'n_horas_trabajo_indep',$this->decimal(5,2));
    
   }
   
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'n_semana'))
           $this->dropColumn($table,'n_semana');
      if($this->existsColumn($table,'numero_semanas'))
           $this->dropColumn($table,'numero_semanas');
      if($this->existsColumn($table,'n_sesiones_semana'))
           $this->dropColumn($table,'n_sesiones_semana');
      
      
      
    }
}
