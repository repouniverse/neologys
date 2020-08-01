<?php
//namespace frontend\modules\import\database\migrations;

use console\migrations\baseMigration;
class m200728_162265_create_import_detalle_table  extends baseMigration
{
     const NAME_TABLE='{{%import_cargamasivadet}}';
     const NAME_TABLE_PARENT='{{%import_cargamasiva}}';
 //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    public function safeUp()
    {
       
        
       $table=static::NAME_TABLE;
      
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'cargamasiva_id' => $this->integer(11)->notNull(),//id padre
               'nombrecampo' => $this->string(60)->notNull()->append($this->collateColumn()),//codigo activo
        'aliascampo'=>$this->string(60)->notNull()->append($this->collateColumn()),
        'sizecampo'=>$this->integer(4)->notNull(),
        'activa'=>$this->char(1)->append($this->collateColumn()),
         'requerida'=>$this->char(1)->append($this->collateColumn()),
        'tipo'=>$this->string(20)->append($this->collateColumn()),
        'esclave'=>$this->char(1)->append($this->collateColumn()),
        'detalle'=>$this->text()->append($this->collateColumn()),
         'esforeign'=>$this->char(1)->append($this->collateColumn()),
        'parent_id'=>$this->integer(11),
        'orden'=>$this->integer(3),
         'modelo'=>$this->string(60)->append($this->collateColumn()),
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
