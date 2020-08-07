<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200803_202012_create_table_programa extends baseMigration
{
     const NAME_TABLE='{{%inter_programa}}';
    const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_PERIODOS='{{%periodos}}';
    const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    const NAME_TABLE_PERSONAS='{{%personas}}';
   
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
           
   
    
$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
            
            /*CAMPOS SCOPE*/
            'universidad_id'=>$this->integer(11),            
            'facultad_id'=>$this->integer(11),
            'codperiodo'=>$this->string(10)->notNull()->append($this->collateColumn()),
            'depa_id' => $this->integer(11),
            
            'clase'=>$this->char(1)->notNull()->append($this->collateColumn()),
             'status'=>$this->char(1)->notNull()->append($this->collateColumn()),
             'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()),
           
            /*FIN DE LOS CAMPOS SCOPE*/
            
             'codigoper' => $this->string(8)->notNull()->append($this->collateColumn()),
           
            
            'programa_id'=>$this->integer(11),
            'fopen' => $this->char(10)->notNull()->append($this->collateColumn()),
            'descripcion' => $this->string(40)->notNull()->append($this->collateColumn()),
            'detalles'=>$this->text()->append($this->collateColumn()),
           
            ], $this->collateTable());
      
       $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'codperiodo', static::NAME_TABLE_PERIODOS,'codperiodo');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'depa_id', static::NAME_TABLE_DEPARTAMENTOS,'id');
          $this->addForeignKey($this->generateNameFk($table), $table,
              'codigoper', static::NAME_TABLE_PERSONAS,'codigoper');
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
        echo "m200803_202012_create_table_programa cannot be reverted.\n";

        return false;
    }
    */
}
