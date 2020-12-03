<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201203_181225_create_table_syllabus_docentes extends  baseMigration
{
    const NAME_TABLE='{{%acad_syllabus_docentes}}';
    //const NAME_TABLE_PLANES='{{%planes_estudio}}';
    const NAME_TABLE_SYLLABUS='{{%acad_syllabus}}';
       //const NAME_TABLE_DOCENTES='{{%docentes}}';
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
             'syllabus_id'=>$this->integer(11)->notNull(),
            'docente_id'=>$this->integer(11)->notNull(),         
            'activo'=>$this->char(1),    
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
