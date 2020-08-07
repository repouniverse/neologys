<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m200805_164239_create_convocatoria
 */
class m200805_164239_create_convocatoria extends baseMigration
{
    const NAME_TABLE='{{%inter_convocados}}';
   const NAME_TABLE_MODOS='{{%inter_modos}}';
       const NAME_TABLE_EVALUADORES='{{%inter_evaluadores}}';
   const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_PERIODOS='{{%periodos}}';
    const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    const NAME_TABLE_PROGRAMAS='{{%inter_programas}}';
        const NAME_TABLE_CONVOCATORIAS='{{%inter_convocatoria}}';
        const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
  const NAME_TABLE_ALUMNOS='{{%alumnos}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'universidad_id'=>$this->integer(11),
            'facultad_id'=>$this->integer(11),
            'depa_id'=>$this->integer(11),
            'modo_id'=>$this->integer(11),
            'codperiodo'=>$this->string(10),
             'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()),
           
            'programa_id'=>$this->integer(11),
            
            'clase'=>$this->char(1)->notNull()->append($this->collateColumn()),
             'status'=>$this->char(1)->notNull()->append($this->collateColumn()),
            
            
             'secuencia'=>$this->integer(2),
            /*CAMPOS QUE ROMPEN NORMALIZACION, NO NECESITAN LLAVE FORANEA */
            'alumno_id'=>$this->integer(11),
            'docente_id'=>$this->integer(11),
            'persona_id'=>$this->integer(11),
            'identidad_id'=>$this->integer(11),
            'codalu'=>$this->string(16)->append($this->collateColumn()),
            'codigo1'=>$this->string(16)->append($this->collateColumn()),
             'codigo2'=>$this->string(16)->append($this->collateColumn()),
            
            
            
            
            
           
            
            
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
           
           $this->addForeignKey($this->generateNameFk($table), $table,
              'depa_id', static::NAME_TABLE_DEPARTAMENTOS,'id');
           
            $this->addForeignKey($this->generateNameFk($table), $table,
              'modo_id', static::NAME_TABLE_MODOS,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'codperiodo', static::NAME_TABLE_PERIODOS,'codperiodo');
            $this->addForeignKey($this->generateNameFk($table), $table,
              'codocu', static::NAME_TABLE_DOCUMENTOS,'codocu');
             
            /*$this->addForeignKey($this->generateNameFk($table), $table,
              'programa_id', static::NAME_TABLE_PROGRAMAS,'id');
           */
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
