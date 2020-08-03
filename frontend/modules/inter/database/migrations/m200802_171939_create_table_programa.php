<?php

use console\migrations\baseMigration;

/**
 * Class m200802_171940_create_table_convocatoria
 */
class m200802_171939_create_table_programa extends baseMigration
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
            'codfac'=>$this->string(10)->notNull()->append($this->collateColumn()),
            'codperiodo'=>$this->string(10)->notNull()->append($this->collateColumn()),
            'coddepa' => $this->string(10)->notNull()->append($this->collateColumn()),
             'clase' => $this->char(1)->append($this->collateColumn()),
            /*FIN DE LOS CAMPOS SCOPE*/
            
            'numero' => $this->string(8)->append($this->collateColumn()),
            'fopen' => $this->char(10)->notNull()->append($this->collateColumn()),
            'fclose'=>$this->char(10)->append($this->collateColumn()),
            'descripcion' => $this->string(40)->notNull()->append($this->collateColumn()),
            'codigoper'=>$this->string(8)->notNull()->append($this->collateColumn()),
            'detalles'=>$this->textg()->append($this->collateColumn()),
           
            'correo' => $this->string(60)->append($this->collateColumn()),
            'web' => $this->string(100)->append($this->collateColumn()),
           
            ], $this->collateTable());
      
       $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'codfac', static::NAME_TABLE_FACULTADES,'codfac');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'codperiodo', static::NAME_TABLE_PERIODOS,'codperiodo');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'coddepa', static::NAME_TABLE_DEPARTAMENTOS,'coddepa');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'codigoper', static::NAME_TABLE_PERSONAS,'codigoper');
   
   }
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        if (!$this->existsTable(static::NAME_TABLE)) {
            $this->dropTable(static::NAME_TABLE);
        }
    }

  
}
