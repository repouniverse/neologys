<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200910_052138_create_table_entrevistas extends baseMigration
{
   const NAME_TABLE='{{%inter_etapas}}';
   const NAME_TABLE_MODOS='{{%inter_modos}}';
   //const NAME_TABLE_EVALUADORES='{{%inter_evaluadores}}';
   //const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
   //const NAME_TABLE_PERIODOS='{{%periodos}}';
   //const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
   //const NAME_TABLE_FACULTADES='{{%facultades}}';
   const NAME_TABLE_PROGRAMAS='{{%inter_programas}}';
   //const NAME_TABLE_CONVOCATORIAS='{{%inter_convocados}}';
   //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
   //const NAME_TABLE_ALUMNOS='{{%alumnos}}';
   //const NAME_TABLE_CONVOCADOS='{{%inter_convocados}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
         'id'=>$this->primaryKey(),
       // 'aluriesgo_id'=>$this->integer(11)->notNull(),
        'facultad_id'=>$this->integer(11)->notNull(),
         'universidad_id'=>$this->integer(11)->notNull(),//Rompiendo la normalizacion 
        'codperiodo'=>$this->string(19)->append($this->collateColumn()),
         'expediente_id'=>$this->integer(11)->notNull(),
        'convocado_id'=>$this->integer(11)->notNull(),
        'persona_id'=>$this->integer(11)->notNull(),
        
        'codigoper'=>$this->string(8)->notNull()->append($this->collateColumn()),
         
        'numero'=>$this->char(8)->append($this->collateColumn()),
        'finicio'=>$this->string(19)->append($this->collateColumn()),
        'asistio'=>$this->char(1)->append($this->collateColumn()),
         'ftermino'=>$this->string(19)->append($this->collateColumn()),
        'fingreso'=>$this->char(10)->append($this->collateColumn()),
        'detalles'=>$this->text()->append($this->collateColumn()),
        'detalles_secre'=>$this->text()->append($this->collateColumn()),
         'detalles_indicadores'=>$this->text()->append($this->collateColumn()),
         'detalles_tareas_pend'=>$this->text()->append($this->collateColumn()),
             'clase'=>$this->char(1)->notNull()->append($this->collateColumn()), //QUE CALSE DE TALLERS 
//'detalles_psico'=>$this->text()->append($this->collateColumn()),
         'codaula'=>$this->string(10)->append($this->collateColumn()),
        'activo'=>$this->char(1)->notNull()->append($this->collateColumn()),
        'masivo'=>$this->char(1)->notNull()->append($this->collateColumn()),
          'duracion'=>$this->integer(3)->notNull(),
          'codfac'=>$this->string(8)->notNull()->append($this->collateColumn()),
         'flujo_id'=>$this->integer(11)->notNull(),
        ],$this->collateTable());
  $this->addForeignKey($this->generateNameFk($table), $table,
              'codfac', static::NAME_TABLE_FACULTAD,'codfac');
            
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
     $this->addForeignKey($this->generateNameFk($table), $table,
              'talleres_id', static::NAME_TABLE_TALLERES,'id');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'talleresdet_id', static::NAME_TABLE_TALLERESDET,'id');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'codtra', static::NAME_TABLE_TRABAJADORES,'codigotra');
                /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codcar', static::NAME_TABLE_CARRERAS,'codcar');*/
            
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
        echo "m200815_203059_create_table_interopuniv cannot be reverted.\n";

        return false;
    }
    */
}
