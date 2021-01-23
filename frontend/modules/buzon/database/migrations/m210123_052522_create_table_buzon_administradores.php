<?php

namespace frontend\modules\buzon\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210123_052522_create_table_buzon_administradores
 */
class m210123_052522_create_table_buzon_administradores extends baseMigration
{
    const NAME_TABLE='{{%buzon_administradores}}';
    const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
    const NAME_TABLE_PERSONAS = '{{%personas}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DE LA PERSONA
                'persona_id' => $this->integer(11)->notNull(),
                //DEPARTAMENTO AL CUAL PERTENECE EL ADMINISTRADOR
                'departamento_id' => $this->integer(11)->notNull(),
                //ACTIVO
                'activo' => $this->char(11)->notNull(),
                

            ], $this->collateTable());

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'persona_id',
                static::NAME_TABLE_PERSONAS,
                'id'
            );
            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'departamento_id',
                static::NAME_TABLE_DEPARTAMENTOS,
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
