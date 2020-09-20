<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200919_142429_create_table_vacantes extends baseMigration
{
   const NAME_TABLE='{{%inter_vacantes}}';
   //const NAME_TABLE_MODOS='{{%inter_modos}}';
  // const NAME_TABLE_EXPEDIENTES='{{%inter_expedientes}}';
   //const NAME_TABLE_ETAPAS='{{%inter_etapas}}';
   const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
   //const NAME_TABLE_PERIODOS='{{%periodos}}';
   //const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
   const NAME_TABLE_FACULTADES='{{%facultades}}';
  const NAME_TABLE_PROGRAMAS='{{%inter_programas}}';
   //const NAME_TABLE_PLANES='{{%inter_plan}}';
   //const NAME_TABLE_CONVOCATORIAS='{{%inter_convocados}}';
   const NAME_TABLE_CARRERAS='{{%carreras}}';
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
        'carrera_id'=>$this->integer(11)->notNull(),
       'nvacantes'=>$this->integer(4)->notNull(),
         'programa_id'=>$this->integer(11)->notNull(),
         'universidad_id'=>$this->integer(11)->notNull(),//Rompiendo la normalizacion 
        'detalles'=>$this->text()->append($this->collateColumn()),
        
        ],$this->collateTable());
  
  /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codalu', static::NAME_TABLE_ALUMNO,'codalu');*/
     $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
    /*$this->addForeignKey($this->generateNameFk($table), $table,
              'programa_id', static::NAME_TABLE_PROGRAMAS,'id');/*
    $this->addForeignKey($this->generateNameFk($table), $table,
              'modo_id', static::NAME_TABLE_MODOS,'id');
     $this->addForeignKey($this->generateNameFk($table), $table,
              'expediente_id', static::NAME_TABLE_EXPEDIENTES,'id');*/
     $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
      $this->addForeignKey($this->generateNameFk($table), $table,
              'carrera_id', static::NAME_TABLE_CARRERAS,'id');     
     
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
