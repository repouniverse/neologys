<?php
use yii\db\Migration;
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201222_201844_table_observaciones_syllabus extends baseMigration
{
   const NAME_TABLE='{{%acad_observaciones_syllabus}}';
    const NAME_TABLE_SYLLABUS='{{%acad_syllabus}}'; 
    const NAME_TABLE_FLUJO='{{%acad_tramite_syllabus}}';
   // const NAME_TABLE_DOCENTES='{{%docentes}}'; 
    // const NAME_TABLE_PERSONAS='{{%personas}}'; 
     
     // const NAME_TABLE_PLANES='{{%planes_estudio}}'; 
    public function safeUp()
    {
$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
                'id'=>$this->primaryKey(),           
                'flujo_syllabus_id'=>$this->integer(11)->notNull(),
                'syllabus_id'=>$this->integer(11)->notNull(),//redundancia 
             'seccion'=>$this->string(40)->append($this->collateColumn()), 
             'observacion'=>$this->text()->append($this->collateColumn()), 
               'fecha'=>$this->string(19)->append($this->collateColumn()),
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'syllabus_id', static::NAME_TABLE_SYLLABUS,'id');
         
         /* $this->addForeignKey($this->generateNameFk($table), $table,
              'docente_revisor_id', static::NAME_TABLE_DOCENTES,'id');
          */ $this->addForeignKey($this->generateNameFk($table), $table,
              'flujo_syllabus_id', static::NAME_TABLE_FLUJO,'id');
          
         
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

  

