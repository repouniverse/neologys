<?php

namespace frontend\modules\buzon\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210119_162146_create_table_buzon_mensaje
 */
class m210119_162146_create_table_buzon_mensaje extends baseMigration
{
    const NAME_TABLE='{{%buzon_mensajes}}';
    const NAME_TABLE_USER='{{%user}}';
    const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
    const NAME_TABLE_TRABAJADORES='{{%trabajadores}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DEL USUARIO
                'user_id' => $this->integer(11)->notNull(),
                //ID DEL DEPARTAMENTO
                'departamento_id' => $this->integer(11)->notNull(),
                //ID TRABAJADOR
                'trabajador_id' => $this->integer(11),
                //EL MENSAJE ENVIADO POR EL USUARIO
                'mensaje' => $this->text()->append($this->collateColumn()),
                //EL ESTADO DEL MENSAJE
                'estado'=>$this->char(20), 
                //LA PRIORIDAD DEL MENSAJE
                'prioridad'=>$this->char(20),
                //FECHA EN QUE FUE ENVIADO
                'fecha_registro'=>$this->dateTime(),

            ], $this->collateTable());

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'user_id',
                static::NAME_TABLE_USER,
                'id'
            );

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'departamento_id',
                static::NAME_TABLE_DEPARTAMENTOS,
                'id'
            );
            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'trabajador_id',
                static::NAME_TABLE_TRABAJADORES,
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210119_162146_create_table_buzon_mensaje cannot be reverted.\n";

        return false;
    }
    */
}
