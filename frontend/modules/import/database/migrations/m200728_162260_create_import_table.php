<?php
namespace frontend\modules\import\database\migrations;

use console\migrations\baseMigration;
class m200728_162260_create_import_table extends baseMigration
{
     const NAME_TABLE='{{%import_cargamasiva}}';
 
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
        
    
        
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),//id padre
               'insercion' => $this->char(1)->notNull()->append($this->collateColumn()),//codigo activo
         'tienecabecera' => $this->char(1)->notNull()->append($this->collateColumn()),//codigo activo
         ///'' => $this->char(1)->notNull()->append($this->collateColumn()),//codigo activo
        'escenario'=>$this->string(40)->notNull()->append($this->collateColumn()),
        'lastimport'=>$this->string(18)->append($this->collateColumn()),//ultimo fecha de importacion 
                'descripcion'=>$this->string(40)->notNull()->append($this->collateColumn()),
          'format'=>$this->char(3)->notNull()->append($this->collateColumn()),//formato de archi csv, xls
        'modelo'=>$this->string(150)->notNull()->append($this->collateColumn()),//formato de archi csv, xls
        
        ],$this->collateTable());
             
              
            }
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }

}
