<?php
  use console\migrations\baseMigration;
class m200912_191937_create_table_cargos extends baseMigration
{    
    const NAME_TABLE='{{%cargos}}';
    //const NAME_TABLE_FACULTADES='{{%facultades}}';
    //const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_DEPAS='{{%departamentos}}';
    
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
                'depa_id'=>$this->integer(11)->notNull(),
                'descargo'=>$this->string(40)->notNull()->append($this->collateColumn()),
              'detalle'=>$this->text()->append($this->collateColumn()),
            
            ], $this->collateTable());
            $this->addForeignKey($this->generateNameFk($table),
                    $table,'depa_id', static::NAME_TABLE_DEPAS,'id');

           // $this->putCombo($table,'codnivel', ['BASICO','INTERMEDIO','AVANZADO','NATIVO']);
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
