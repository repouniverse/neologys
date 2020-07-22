<?php
//namespace console\migrations;
use console\migrations\baseMigration;


/**
 * Class m190107_163228_create_table_activerecordlog
 */
class m190107_163228_create_table_activerecordlog extends baseMigration
{

 const NAME_TABLE='{{%activerecordlog}}';
 
    public function safeUp()
    {
       
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
             'id'=>$this->primaryKey(20),
            'model' => $this->string(45)->append($this->collateColumn()),
            'field' => $this->string(45)->append($this->collateColumn()),
            'ip' => $this->string(18)->append($this->collateColumn()),
            'creationdate' => $this->string(20)->append($this->collateColumn()),
            'controlador' => $this->string(60)->append($this->collateColumn()),
            'description'=>$this->string(105)->append($this->collateColumn()),
            'nombrecampo'=> $this->string(45)->append($this->collateColumn()),            
            'oldvalue'=>$this->string(80)->append($this->collateColumn()),
            'newvalue'=>$this->string(80)->append($this->collateColumn()),
             'username'=>$this->string(30)->append($this->collateColumn()),
            'metodo'=>$this->char(7)->append($this->collateColumn()),
             'action'=>$this->char(10)->append($this->collateColumn()),
              'clave'=>$this->text()->append($this->collateColumn()),
             ],$this->collateTable());
        $this->createIndex('k_model_loagatvierecor', static::NAME_TABLE, 'model');
       //$this->addPrimaryKey('pk_'.static::NAME_TABLE.'45',static::NAME_TABLE, 'id');
      $this->alterColumn(static::NAME_TABLE, 'id', $this->bigInteger(20).' NOT NULL AUTO_INCREMENT');
      
      
      
// $comment="Define si es un comprobante ";
       //$this->addCommentOnColumn(static::NAME_TABLE, 'escomprobante', $comment);
       //$comment="Indica el id del reporte por defaul, sirve para visualizar un documento ";
       //$this->addCommentOnColumn(static::NAME_TABLE, 'idreportedefault', $comment);
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
