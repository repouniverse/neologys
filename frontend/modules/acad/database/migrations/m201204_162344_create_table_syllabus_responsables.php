<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201204_162344_create_table_syllabus_responsables extends baseMigration
{
   const NAME_TABLE='{{%acad_responsables_syllabus}}';
    const NAME_TABLE_DOCENTES='{{%docentes}}';
   const NAME_TABLE_PLANES_ESTUDIO='{{%planes_estudio}}';
       //const NAME_TABLE_DOCENTES='{{%docentes}}';
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
             //'syllabus_id'=>$this->integer(11)->notNull(),
            'docente_id'=>$this->integer(11)->notNull(),         
            'plan_estudio_id'=>$this->integer(11)->notNull(),
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'docente_id', static::NAME_TABLE_DOCENTES,'id');
          $this->addForeignKey($this->generateNameFk($table), $table,
              'plan_estudio_id', static::NAME_TABLE_PLANES_ESTUDIO,'id');
         
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
