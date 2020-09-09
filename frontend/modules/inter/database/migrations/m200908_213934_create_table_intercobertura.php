<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200908_213934_create_table_intercobertura extends baseMigration
{
   const NAME_TABLE='{{%inter_beneficios}}';
   //const NAME_TABLE_MODOS='{{%inter_modos}}';
   //const NAME_TABLE_EVALUADORES='{{%inter_evaluadores}}';
   //const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
   //const NAME_TABLE_PERIODOS='{{%periodos}}';
   //const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
   //const NAME_TABLE_FACULTADES='{{%facultades}}';
   //const NAME_TABLE_PROGRAMAS='{{%inter_programas}}';
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
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
           // 'programa_id'=>$this->integer(11),
           // 'modo_id'=>$this->integer(11),
            'descripcion'=>$this->string(30)->notNull()->append($this->collateColumn()),
             'activo'=>$this->char(1)->append($this->collateColumn()),
           'comentarios'=>$this->text()->append($this->collateColumn()),            
            ], $this->collateTable());
      
        /* $this->addForeignKey($this->generateNameFk($table), $table,
              'programa_id', static::NAME_TABLE_PROGRAMAS,'id');*/
           
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
