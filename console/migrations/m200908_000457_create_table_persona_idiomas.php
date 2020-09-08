<?php
  use console\migrations\baseMigration;
class m200908_000457_create_table_persona_idiomas extends baseMigration
{    
    const NAME_TABLE='{{%persona_idiomas}}';
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
                'codnivel'=>$this->string(1)->notNull()->append($this->collateColumn()),
             'idioma'=>$this->string(3)->notNull()->append($this->collateColumn()),
           
                'detalle'=>$this->text()->append($this->collateColumn()),
             'certificado'=>$this->string(1)->notNull()->append($this->collateColumn()),
          
            ], $this->collateTable());
            $this->addForeignKey($this->generateNameFk($table),
                    $table,'persona_id', static::NAME_TABLE_PERSONAS,'id');

            $this->putCombo($table,'codnivel', ['BASICO','INTERMEDIO','AVANZADO','NATIVO']);
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
