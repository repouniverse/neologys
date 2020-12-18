<?php
namespace frontend\modules\repositorio\database\migrations;
use console\migrations\baseMigration;
class m201218_041533_alter_table_repositorio_asesores_curso extends baseMigration
{
    const NAME_TABLE='{{%repositorio_asesores_curso_docs}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'publico'))
     $this->addColumn($table, 'publico', $this->char(1));  
    

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'publico'))
           $this->dropColumn($table,'publico');
     
      
    }
}
