<?php

namespace frontend\modules\buzon\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210201_073142_buzon_mensaje_respuesta
 */
class m210201_073142_buzon_mensaje_respuesta extends baseMigration
{
    const NAME_TABLE='{{%buzon_mensaje_respuesta}}';
    const NAME_TABLE_BUZON_MENSAJE='{{%buzon_mensajes}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            //create table----------------------
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DEL USUARIO
                'bm_id' => $this->integer(11),                
                //EL MENSAJE ENVIADO POR EL USUARIO
                'mensaje_respuesta' => $this->text()->append($this->collateColumn()),                
                //FECHA EN QUE FUE ENVIADO
                'fecha_respuesta'=>$this->dateTime(),

            ], $this->collateTable());

            //foreignskeys-----------------
            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'bm_id',
                static::NAME_TABLE_BUZON_MENSAJE,
                'id'
            );
           
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
