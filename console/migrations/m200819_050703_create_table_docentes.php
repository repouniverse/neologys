<?php

use console\migrations\baseMigration;
class m200819_050703_create_table_docentes extends baseMigration
{
    
    const NAME_TABLE='{{%docentes}}';
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
   // const NAME_TABLE_CARRERAS='{{%carreras}}';
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
            'facultad_id'=>$this->integer(11),
            'universidad_id'=>$this->integer(11),
            'persona_id'=>$this->integer(11),
            
           // 'carrera_id'=>$this->integer(11),
            'codoce' => $this->string(16)->notNull()->append($this->collateColumn()),
            'codoce1' => $this->string(16)->append($this->collateColumn()),
            'codoce2' => $this->string(16)->append($this->collateColumn()),
            'codigoper'=>$this->string(8)->append($this->collateColumn()),
            'ap'=>$this->string(40)->append($this->collateColumn()),
            'am'=>$this->string(40)->append($this->collateColumn()),
            'nombres'=>$this->string(40)->append($this->collateColumn()),
           'codpering'=>$this->string(10)->notNull()->append($this->collateColumn()),
             'codfac'=>$this->string(10)->notNull()->append($this->collateColumn()),
             // 'codesp'=>$this->string(8)->append($this->collateColumn()),
            'numerodoc' => $this->string(20)->append($this->collateColumn()),
           'tipodoc' => $this->char(2)->append($this->collateColumn()), 
            'categoria' => $this->string(2)->append($this->collateColumn()), 
             'dispo' => $this->string(2)->append($this->collateColumn()),
           
            ], $this->collateTable());
       $this->createIndex(uniqid('codalu'), static::NAME_TABLE, 'codoce');
         $this->createIndex(uniqid('k_ap'), static::NAME_TABLE, 'ap');
        $this->createIndex(uniqid('k_am'), static::NAME_TABLE, 'am');
        $this->createIndex(uniqid('k_nombres'), static::NAME_TABLE, 'nombres');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');                
             $this->addForeignKey($this->generateNameFk($table), $table,
              'codigoper', static::NAME_TABLE_PERSONAS,'codigoper');
             
            $this->putCombo($table,'categoria', ['NOMBRADO','CONTRATADO']);
            $this->putCombo($table,'dispo', ['TIEMPO COMPLETO','TIEMPO PARCIAL']);
       
  }
    
    
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }
    }

}
