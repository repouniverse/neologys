<?php
use console\migrations\baseMigration;
class m201218_155114_create_table_formatos_docs extends baseMigration
{
    const NAME_TABLE='{{%formato_docs}}';
    const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
   public function safeUp()
    {
       $table=static::NAME_TABLE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'codocu' => $this->char(3)->append($this->collateColumn()),  
            'descripcion' =>  $this->string(40)->notNull()->append($this->collateColumn()),           
            'comentario' =>  $this->text()->append($this->collateColumn()), 
             ],
           $this->collateTable());
       
      /* $this->addForeignKey($this->generateNameFk($table),
                    $table,'codocu', static::NAME_TABLE_DOCUMENTOS,'id');*/
       
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

    
}
