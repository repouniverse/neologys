<?php

namespace frontend\modules\import\database\migrations;

use console\migrations\baseMigration;

/**
 * Class m190719_142455_create_table_carga_user
 */
class m200728_162270_create_table_carga_user extends baseMigration
{
     const NAME_TABLE='{{%import_carga_user}}';
 
 const NAME_TABLE_CARGA='{{%import_cargamasiva}}';
    public function safeUp()
    {
        
    
        
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
                'id'=>$this->primaryKey(),
                'cargamasiva_id' => $this->integer(11)->notNull(),//
                'fechacarga'=>$this->string(18)->append($this->collateColumn()),//
                'user_id' => $this->integer(11),//
                'descripcion'=>$this->string(40)->notNull()->append($this->collateColumn()),
                'current_linea'=>$this->integer(11),//
        'current_linea_test'=>$this->integer(11),//
                'total_linea'=>$this->integer(11),//
         'estricto'=>$this->char(1)->append($this->collateColumn()),//Si carga con errores , ignora los erroes solo inserta los que pasan
         'activo'=>$this->char(2)->append($this->collateColumn()),
                'tienecabecera'=>$this->char(1)->append($this->collateColumn()),
                'duracion'=>$this->string(40)->append($this->collateColumn()),
        ],$this->collateTable());
             
               $this->addForeignKey($this->generateNameFk($table), $table,
              'cargamasiva_id', static::NAME_TABLE_CARGA,'id');
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
