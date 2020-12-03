<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m201203_172331_create_table_syllabus
 */
class m201203_172331_create_table_syllabus extends  baseMigration
{
    const NAME_TABLE='{{%acad_syllabus}}';
    const NAME_TABLE_PLANES='{{%planes_estudio}}';
    const NAME_TABLE_CURSOS='{{%cursos}}';
       const NAME_TABLE_DOCENTES='{{%docentes}}';
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
             'plan_id'=>$this->integer(11)->notNull(),
            'codperiodo'=>$this->string(10)->notNull()->append($this->collateColumn()),
             'curso_id'=>$this->integer(11)->notNull(),
            'n_horasindep'=>$this->integer(3),
            'docente_owner_id'=>$this->integer(11)->notNull(),
            'datos_generales'=>$this->text()->append($this->collateColumn()),
            /*Capitulo II*/
            'sumilla'=>$this->text()->append($this->collateColumn()),
              /*Capitulo III*/
            'competencias'=>$this->text()->append($this->collateColumn()),
            /*Capitulo IV*/
            'prog_contenidos'=>$this->text()->append($this->collateColumn()),
             /*Capitulo V*/
            'estrat_metod'=>$this->text()->append($this->collateColumn()),
               /*Capitulo VI*/
             'recursos_didac'=>$this->text()->append($this->collateColumn()),
            /*Capitulo VII*/
             'formula_id'=>$this->integer(11)->notNull(),
            /*Capitulo VIII FUETNES DE INFORMACION*/
             'fuentes_info'=>$this->text()->append($this->collateColumn()),            
             /*RESERVA DE COMPOS*/
             'reserva1'=>$this->text()->append($this->collateColumn()),           
             'reserva2'=>$this->text()->append($this->collateColumn()),           
            
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'plan_id', static::NAME_TABLE_PLANES,'id');
         
          $this->addForeignKey($this->generateNameFk($table), $table,
              'curso_id', static::NAME_TABLE_CURSOS,'id');
          
          $this->addForeignKey($this->generateNameFk($table), $table,
              'docente_owner_id', static::NAME_TABLE_DOCENTES,'id');
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
