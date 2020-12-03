<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201203_180552_create_table_syllabus_unidades extends  baseMigration
{
    const NAME_TABLE='{{%acad_syllabus_unidades}}';
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
             'descripcion'=>$this->string(80)->append($this->collateColumn()), 
            'capacidad'=>$this->text()->append($this->collateColumn()), 
             'comentarios'=>$this->text()->append($this->collateColumn()),           
             //'reserva2'=>$this->text()->append($this->collateColumn()),           
            
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
