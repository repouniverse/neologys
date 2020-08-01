<?php
namespace frontend\modules\import\database\migrations;

use console\migrations\baseMigration;
/**
 * Class m190716_143038_create_table_logimport
 */
class m200728_162280_create_table_logimport extends baseMigration
{
     const NAME_TABLE='{{%import_logcargamasiva}}';
     const NAME_TABLE_PARENT='{{%import_carga_user}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       $table=static::NAME_TABLE;
      
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'cargamasiva_id' => $this->integer(11)->notNull(),//id padre
               'nombrecampo' => $this->string(60)->notNull()->append($this->collateColumn()),//codigo activo
        'mensaje'=>$this->string(180)->notNull()->append($this->collateColumn()),
        'level'=>$this->char(1)->append($this->collateColumn()),
        'fecha'=>$this->string(20)->append($this->collateColumn()),
         'user_id'=>$this->integer(4)->notNull(),
        'numerolinea'=>$this->integer(4)->notNull()
          ],$this->collateTable());
              $this->addForeignKey($this->generateNameFk($table), $table,
              'cargamasiva_id', static::NAME_TABLE_PARENT,'id');
                 
              
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
