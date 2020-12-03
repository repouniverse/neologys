<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201203_180000_create_table_syllabus_contenido extends baseMigration
{
    const NAME_TABLE='{{%acad_contenido_syllabus}}';
    const NAME_TABLE_SYLLABUS='{{%acad_syllabus}}';
    //const NAME_TABLE_CURSOS='{{%cursos}}';
      // const NAME_TABLE_DOCENTES='{{%docentes}}';
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
            
             'syllabus_id'=>$this->integer(11)->notNull(),
             'n_semana'=>$this->integer(3)->notNull(),
            'bloque1'=>$this->text()->append($this->collateColumn()),
             'bloque2'=>$this->text()->append($this->collateColumn()),
            'bloque3'=>$this->text()->append($this->collateColumn()),
            'bloque4'=>$this->text()->append($this->collateColumn()),
             'bloque5'=>$this->text()->append($this->collateColumn()),
            'bloque6'=>$this->text()->append($this->collateColumn()),
            'bloque7'=>$this->text()->append($this->collateColumn()),
             'bloque8'=>$this->text()->append($this->collateColumn()),
            'bloque9'=>$this->text()->append($this->collateColumn()),
                      
            
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'syllabus_id', static::NAME_TABLE_SYLLABUS,'id');
         
          
       }
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
       if ($this->existsTable(static::NAME_TABLE)) {
            $this->dropTable(static::NAME_TABLE);
        }
    }

}
