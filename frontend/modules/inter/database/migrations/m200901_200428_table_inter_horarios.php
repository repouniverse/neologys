<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200901_200428_table_inter_horarios extends baseMigration
{
    const NAME_TABLE='{{%inter_horarios}}';
   const NAME_TABLE_ETAPAS='{{%inter_etapas}}';
   const NAME_TABLE_MODOS='{{%inter_modos}}';
   const NAME_TABLE_PLANES='{{%inter_plan}}';
   //const NAME_TABLE_EVALUADORES='{{%inter_evaluadores}}';
   //const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
   //const NAME_TABLE_PERIODOS='{{%periodos}}';
   //const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
   const NAME_TABLE_FACULTADES='{{%facultades}}';
   const NAME_TABLE_PROGRAMAS='{{%inter_programas}}';
   //const NAME_TABLE_CONVOCATORIAS='{{%inter_convocados}}';
   //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
   //const NAME_TABLE_ALUMNOS='{{%alumnos}}';
   //const NAME_TABLE_CONVOCADOS='{{%inter_convocados}}';
    public function safeUp()
    {
 
    $table=static::NAME_TABLE;
        if(!$this->existsTable($table)) {
             $this->createTable($table,  [
         'id'=>$this->primaryKey(),
       // 'aluriesgo_id'=>$this->integer(11)->notNull(),
        'plan_id'=>$this->integer(11)->notNull(),
        'programa_id'=>$this->integer(11)->notNull(),
         'facultad_id'=>$this->integer(11)->notNull(),
         'etapa_id'=>$this->integer(11)->notNull(),
                 
        'dia'=>$this->integer(1)->notNull(),
         //'codfac'=>$this->string(8)->notNull()->append($this->collateColumn()),
        'hinicio'=>$this->char(5)->notNull()->append($this->collateColumn()),
        'hfin'=>$this->char(5)->notNull()->append($this->collateColumn()),
        'tolerancia'=>$this->decimal(4,1)->notNull(),
       'activo'=>$this->char(1)->notNull()->append($this->collateColumn()),
       'codtra'=>$this->string(6)->append($this->collateColumn()),
        'nombredia'=>$this->string(16)->append($this->collateColumn()),
        
                 'clase'=>$this->char(1)->notNull()->append($this->collateColumn()),
       'skipferiado'=>$this->char(1)->notNull()->append($this->collateColumn()),
        ],$this->collateTable());
  
    /*$this->addForeignKey($this->generateNameFk($table), $table,
              'programa_id', static::NAME_TABLE_PROGRAMAS,'id');*/
    $this->addForeignKey($this->generateNameFk($table), $table,
              'plan_id', static::NAME_TABLE_PLANES,'id');
     $this->addForeignKey($this->generateNameFk($table), $table,
              'etapa_id', static::NAME_TABLE_ETAPAS,'id');
    
    
    /*$this->addForeignKey($this->generateNameFk($table), $table,
              'codtra', static::NAME_TABLE_TRABAJADORES,'codigotra');
                /*  $this->addForeignKey($this->generateNameFk($table), $table,
              'codcar', static::NAME_TABLE_CARRERAS,'codcar');*/
         $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
            
            } 
 
    }
public function safeDown()
    {
     $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }

}