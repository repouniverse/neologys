<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m200815_203059_create_table_interopuniv
 */
class m200815_203059_create_table_interopuniv extends baseMigration
{
   const NAME_TABLE='{{%inter_opuniv}}';
   //const NAME_TABLE_MODOS='{{%inter_modos}}';
   //const NAME_TABLE_EVALUADORES='{{%inter_evaluadores}}';
   const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
   //const NAME_TABLE_PERIODOS='{{%periodos}}';
   //const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
   const NAME_TABLE_FACULTADES='{{%facultades}}';
   //const NAME_TABLE_PROGRAMAS='{{%inter_programas}}';
   const NAME_TABLE_CONVOCATORIAS='{{%inter_convocados}}';
   //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
   //const NAME_TABLE_ALUMNOS='{{%alumnos}}';
   //const NAME_TABLE_CONVOCADOS='{{%inter_convocados}}';
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
            'convocatoria_id'=>$this->integer(11),
            'univop_id'=>$this->integer(11),
            'prioridad'=>$this->integer(2),
            'comentarios'=>$this->text()->append($this->collateColumn()),            
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
           
           $this->addForeignKey($this->generateNameFk($table), $table,
              'convocatoria_id', static::NAME_TABLE_CONVOCATORIAS,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'univop_id', static::NAME_TABLE_UNIVERSIDADES,'id');
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
