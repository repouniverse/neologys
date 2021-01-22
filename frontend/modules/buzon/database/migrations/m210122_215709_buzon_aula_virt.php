<?php

namespace frontend\modules\buzon\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210122_215709_buzon_aula_virt
 */
class m210122_215709_buzon_aula_virt extends baseMigration
{
    const NAME_TABLE='{{%buzon_aula_virt}}';
    const NAME_TABLE_BUZON='{{%buzon_mensajes}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DEL BUZON MENSAJE
                'bm_id' => $this->integer(11)->notNull(),
                //NOMBRE DOCENTE
                'docente' => $this->String(30)->notNull(),
                //NOMBRE DEL CURSO
                'curso' => $this->String(30)->notNull(),
                //SECCION EN LA QUE SE ENCUENTRA
                'seccion' => $this->String(30)->notNull(),
                //CILO EN EL QUE SE ENCUENTRA
                'ciclo' => $this->String(30)->notNull(),
                

            ], $this->collateTable());

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'bm_id',
                static::NAME_TABLE_BUZON,
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
