<?php
 use console\migrations\baseMigration;
class m200925_150449_create_table_tenores extends baseMigration
{

 const NAME_TABLE='{{%tenores}}';
 const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
  const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
   const NAME_TABLE_FACULTADES='{{%facultades}}';
    public function safeUp()
    {
       
 $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
             'universidad_id'=>$this->integer(11)->notNull(),
         'facultad_id'=>$this->integer(11)->notNull(),
            'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()),
            'activo' =>$this->char(1)->append($this->collateColumn()),
         'idioma'=>$this->string(2)->append($this->collateColumn()),
        'posic' =>$this->char(1)->append($this->collateColumn()),//a, b, c, d cebcera, centro pie
            'texto' => $this->text()->append($this->collateColumn()),
            //'ishome' => $this->char(1)->append($this->collateColumn()),
            'order'=> $this->integer(3),
             ],$this->collateTable());
         $this->addForeignKey($this->generateNameFk($table), $table,
              'codocu', static::NAME_TABLE_DOCUMENTOS,'codocu');
         
         $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
           
         $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
           }
    
    }

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE; 
       if ($this->existsTable($table)){
            $this->dropTable($table);
        }

    }
}