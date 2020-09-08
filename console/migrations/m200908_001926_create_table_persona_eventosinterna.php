<?php
  use console\migrations\baseMigration;
class m200908_001926_create_table_persona_eventosinterna extends baseMigration
{    
    const NAME_TABLE='{{%persona_eventosinter}}';
    //const NAME_TABLE_FACULTADES='{{%facultades}}';
    //const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_PERSONAS='{{%personas}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsTable($table))
        {
            $this->createTable($table, 
            [
                'id'=>$this->primaryKey(),
                //'facultad_id'=>$this->integer(11),
                //'universidad_id'=>$this->integer(11),
                'persona_id'=>$this->integer(11),
                'nombre'=>$this->string(60)->notNull()->append($this->collateColumn()),
                'web'=>$this->string(100)->append($this->collateColumn()),
                'finicio'=>$this->char(10)->append($this->collateColumn()),
                'duracion'=>$this->integer(3),
                'ciudad'=>$this->string(30)->append($this->collateColumn()),
               'pais'=>$this->string(3)->append($this->collateColumn()),
                'detalle'=>$this->text()->append($this->collateColumn()),
                 'objetivosacad'=>$this->text()->append($this->collateColumn()),
                 'obetivosinter'=>$this->text()->append($this->collateColumn()),
                 'tipoexpo'=>$this->char(1)->notNull()->append($this->collateColumn()),
                
          
            ], $this->collateTable());
            $this->addForeignKey($this->generateNameFk($table),
                    $table,'persona_id', static::NAME_TABLE_PERSONAS,'id');

            $this->putCombo($table,'tipoexpo', ['EXPOSITOR PPAL','EXPOSITOR MESA REDONDA']);
           // $this->putCombo($table,'dispo', ['TIEMPO COMPLETO','TIEMPO PARCIAL']);
            //$this->putCombo($table,'categoria', ['PRINCIPAL','ASOCIADO','AUXILIAR']);
        }
    }
    
    public function safeDown()
    {        
        if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) 
        {
            $this->dropTable(static::NAME_TABLE);
        }
    }

}
