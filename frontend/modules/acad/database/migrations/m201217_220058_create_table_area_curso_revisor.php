<?php
use yii\db\Migration;
namespace frontend\modules\acad\database\migrations;
use console\migrations\baseMigration;
class m201217_220058_create_table_area_curso_revisor extends baseMigration
{
   const NAME_TABLE='{{%acad_curso_area_revisor}}';
    const NAME_TABLE_CURSO_AREA='{{%curso_area}}';   
    const NAME_TABLE_DOCENTES='{{%docentes}}'; 
     const NAME_TABLE_PERSONAS='{{%personas}}'; 
     
      const NAME_TABLE_PLANES='{{%planes}}'; 
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
                'id'=>$this->primaryKey(),           
                'curso_area_id'=>$this->integer(11)->notNull(),
                'docente_revisor_id'=>$this->integer(11)->notNull(),
                'docente_responsable_id'=>$this->integer(11)->notNull(),
                'persona_asesor_ugai_id'=>$this->integer(11)->notNull(), 
                'persona_corrector_id'=>$this->integer(11)->notNull(), 
                'persona_director_escuela_id'=>$this->integer(11)->notNull(),
                'plan_id'=>$this->integer(11)->notNull(),
               // 'persona_corrector_id'=>$this->integer(11)->notNull(),
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'curso_area_id', static::NAME_TABLE_CURSO_AREA,'id');
         
          $this->addForeignKey($this->generateNameFk($table), $table,
              'docente_revisor_id', static::NAME_TABLE_DOCENTES,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'docente_responsable_id', static::NAME_TABLE_DOCENTES,'id');
           
           $this->addForeignKey($this->generateNameFk($table), $table,
              'persona_corrector_id', static::NAME_TABLE_PERSONAS,'id');
           
           $this->addForeignKey($this->generateNameFk($table), $table,
              'persona_asesor_ugai_id', static::NAME_TABLE_PERSONAS,'id');
           
           $this->addForeignKey($this->generateNameFk($table), $table,
              'plan_id', static::NAME_TABLE_PLANES,'id');
           
           
           $this->addForeignKey($this->generateNameFk($table), $table,
              'persona_director_escuela_id', static::NAME_TABLE_PERSONAS,'id');
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

  

