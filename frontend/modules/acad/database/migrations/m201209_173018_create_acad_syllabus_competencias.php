<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201209_173018_create_acad_syllabus_competencias extends baseMigration
{
   const NAME_TABLE='{{%acad_syllabus_competencias}}';
    const NAME_TABLE_SYLLABUS='{{%acad_syllabus}}';
   
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
           'syllabus_id'=>$this->integer(11)->notNull(),
            'activo'=>$this->char(1)->append($this->collateColumn())->comment('Flag de activo  o inactivo'),
            'bloque_padre'=>$this->string(40)->append($this->collateColumn())->comment('TITULO DEL BLOQUE PADRE'),
            /*TITULO DEL BLOQUE COMPETENCIAS*/
            'bloque'=>$this->string(60)->append($this->collateColumn())->comment('TITULO DEL BLOQUE COMPETENCIAS'),
             /*marcador del TITULO DEL BLOQUE COMPETENCIAS ejem 3.1 3.2 3.3 */
            'item_bloque'=>$this->string(6)->notNull()->append($this->collateColumn()),
            'contenido_bloque'=>$this->text()->append($this->collateColumn()),
            
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'syllabus_id', static::NAME_TABLE_SYLLABUS,'id');
          /*$this->addForeignKey($this->generateNameFk($table), $table,
              'plan_estudio_id', static::NAME_TABLE_PLANES_ESTUDIO,'id');*/
         
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
