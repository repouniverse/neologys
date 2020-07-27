<?php

use console\migrations\baseMigration;

/**
 * Class m200727_194426_create_table_documentos
 */
class m200727_194426_create_table_documentos extends baseMigration
{
   
 const NAME_TABLE='{{%documentos}}';
 
    public function safeUp()
    {
       
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
            'codocu' => $this->char(3)->append($this->collateColumn()),
            'desdocu' => $this->string(60)->notNull()->append($this->collateColumn()),
            'clase' => $this->char(1)->append($this->collateColumn()),
            'tipo' => $this->char(2)->append($this->collateColumn()),
            'tabla' => $this->string(60)->append($this->collateColumn()),
            'abreviatura'=>$this->string(5)->append($this->collateColumn()),
            'prefijo'=>$this->string(4)->append($this->collateColumn()),            
            'escomprobante'=>$this->char(1)->append($this->collateColumn()),
              'withaudit'=>$this->char(1)->append($this->collateColumn()),
             'idreportedefault'=>$this->integer(11),
             ], $this->collateTable());
       $this->addPrimaryKey('pk_docus45',static::NAME_TABLE, 'codocu');
       $comment="Define si es un comprobante ";
       $this->addCommentOnColumn(static::NAME_TABLE, 'escomprobante', $comment);
       $comment="Indica el id del reporte por defaul, sirve para visualizar un documento ";
       $this->addCommentOnColumn(static::NAME_TABLE, 'idreportedefault', $comment);
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_053758_create_table_documents cannot be reverted.\n";

        return false;
    }
    */
}
