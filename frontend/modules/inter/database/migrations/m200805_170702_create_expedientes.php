<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m200805_170702_create_expedientes
 */
class m200805_170702_create_expedientes extends baseMigration
{
    const NAME_TABLE='{{%inter_expedientes}}';
   const NAME_TABLE_MODOS='{{%inter_modos}}';
       const NAME_TABLE_EVALUADORES='{{%inter_evaluadores}}';
   const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_PERIODOS='{{%periodos}}';
    const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    const NAME_TABLE_PROGRAMAS='{{%inter_programas}}';
        const NAME_TABLE_CONVOCATORIAS='{{%inter_convocados}}';
        const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
  const NAME_TABLE_ALUMNOS='{{%alumnos}}';
   const NAME_TABLE_CONVOCADOS='{{%inter_convocados}}';
    /**
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
            'programa_id'=>$this->integer(11),
            'modo_id'=>$this->integer(11),
            
            'convocado_id'=>$this->integer(11),
            //'codperiodo'=>$this->string(10),
            
            'clase'=>$this->char(1)->notNull()->append($this->collateColumn()),
             'status'=>$this->char(1)->notNull()->append($this->collateColumn()),
             'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()),
           
             'fpresenta'=>$this->char(10)->append($this->collateColumn()),
            'fdocu'=>$this->char(10)->append($this->collateColumn()),
            
            'detalles'=>$this->text()->append($this->collateColumn()),
            'textointerno'=>$this->text()->append($this->collateColumn()),
            'estado'=>$this->char(1)->notNull()->append($this->collateColumn()),
            'requerido'=>$this->char(1)->notNull()->append($this->collateColumn()),
            
           
            
            
            
            
            
           
            
            
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
              'codocu', static::NAME_TABLE_DOCUMENTOS,'codocu');
            $this->addForeignKey($this->generateNameFk($table), $table,
              'convocado_id', static::NAME_TABLE_CONVOCADOS,'id');
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
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
