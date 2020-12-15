<?php
namespace frontend\modules\repositorio\database\migrations;
use console\migrations\baseMigration;
class m201211_165237_create_table_doc_asesores_curso  extends baseMigration
{
    /**
     * {@inheritdoc}
     */

    const TABLE='{{%repositorio_asesores_curso_docs}}';
    const TABLE_ASESORES_CURSO='{{%asesores_curso}}';
    const TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
$table=static::TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
           // 'programa_id'=>$this->integer(11),
           // 'modo_id'=>$this->integer(11),
            'asesores_curso_id'=>$this->integer(11)->notNull(),
            'codocu'=>$this->char(3)->append($this->collateColumn()),
             'activo'=>$this->char(1)->append($this->collateColumn()),
            'fpresentacion'=>$this->string(10)->append($this->collateColumn()),
            'orcid'=>$this->string(250)->append($this->collateColumn()),
            'comentarios'=>$this->text()->append($this->collateColumn()), 
            
            ], $this->collateTable());
      
         $this->addForeignKey($this->generateNameFk($table), $table,
              'asesores_curso_id', static::TABLE_ASESORES_CURSO,'id');
          $this->addForeignKey($this->generateNameFk($table), $table,
              'codocu', static::TABLE_DOCUMENTOS,'codocu');
           
       }     

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if ($this->existsTable(static::TABLE)) {
            $this->dropTable(static::TABLE);
        }

    }
}


