<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200910_052138_create_table_entrevistas extends baseMigration
{
   const NAME_TABLE='{{%inter_entrevistas}}';
   const NAME_TABLE_MODOS='{{%inter_modos}}';
   const NAME_TABLE_EXPEDIENTES='{{%inter_expedientes}}';
   const NAME_TABLE_ETAPAS='{{%inter_etapas}}';
   const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
   //const NAME_TABLE_PERIODOS='{{%periodos}}';
   //const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
   const NAME_TABLE_FACULTADES='{{%facultades}}';
   const NAME_TABLE_PROGRAMAS='{{%inter_programas}}';
   const NAME_TABLE_PLANES='{{%inter_plan}}';
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
         'etapa_id'=>$this->integer(11)->notNull(),
         'plan_id'=>$this->integer(11)->notNull(),
         'universidad_id'=>$this->integer(11)->notNull(),//Rompiendo la normalizacion 
         'modo_id'=>$this->integer(11)->notNull(),//Rompiendo la normalizacion 
        'codperiodo'=>$this->string(19)->append($this->collateColumn()),
         'expediente_id'=>$this->integer(11)->notNull(),
        'convocado_id'=>$this->integer(11)->notNull(),
        'persona_id'=>$this->integer(11)->notNull(),
        'fechaprog'=>$this->string(19)->append($this->collateColumn()),
         
         'finicio'=>$this->string(19)->append($this->collateColumn()),
         'numero'=>$this->char(8)->append($this->collateColumn()),
        'ftermino'=>$this->string(19)->append($this->collateColumn()),
        'asistio'=>$this->char(1)->append($this->collateColumn()),
         'detalles'=>$this->text()->append($this->collateColumn()),
        'detalles_secre'=>$this->text()->append($this->collateColumn()),
         'activo'=>$this->char(1)->notNull()->append($this->collateColumn()),
        'masivo'=>$this->char(1)->notNull()->append($this->collateColumn()),
          'duracion'=>$this->integer(3)->notNull(),
          'codfac'=>$this->string(8)->notNull()->append($this->collateColumn()),
         'flujo_id'=>$this->integer(11)->notNull(),
        ],$this->collateTable());
  
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
     $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'etapa_id', static::NAME_TABLE_ETAPAS,'id');
    $this->addForeignKey($this->generateNameFk($table), $table,
              'modo_id', static::NAME_TABLE_MODOS,'id');
     $this->addForeignKey($this->generateNameFk($table), $table,
              'expediente_id', static::NAME_TABLE_EXPEDIENTES,'id');
     $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
       $this->addForeignKey($this->generateNameFk($table), $table,
              'plan_id', static::NAME_TABLE_PLANES,'id');      
     
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
