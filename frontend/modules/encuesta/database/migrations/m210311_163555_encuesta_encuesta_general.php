<?php

namespace frontend\modules\encuesta\database\migrations;
use console\migrations\baseMigration;


/**
 * Class m210311_163555_encuesta_encuesta_general
 */
class m210311_163555_encuesta_encuesta_general extends baseMigration
{

    const NAME_TABLE='{{%encuesta_encuesta_general}}';
    const NAME_TABLE_DEPARTAMENTOS='{{%departamentos}}';
    const NAME_TABLE_USUARIO='{{%grupo_personas}}';
    const NAME_TABLE_ENCUESTA='{{%encuesta_tipo_encuesta}}';


    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),                
                'titulo_encuesta' => $this->String(30)->notNull(),
                'id_tipo_usuario' => $this->String(3)->notNull(),
                'id_tipo_encuesta' => $this->integer(11)->notNull(),
                'descripcion' => $this->String(30)->notNull(),
                'numero_preguntas' => $this->String(30)->notNull(),
                'id_dep_encargado' => $this->integer(11)->notNull(),       

            ], $this->collateTable());

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'id_dep_encargado',
                static::NAME_TABLE_DEPARTAMENTOS,
                'id'
            );

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'id_tipo_encuesta',
                static::NAME_TABLE_ENCUESTA,
                'id'
            );

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'id_tipo_usuario',
                static::NAME_TABLE_USUARIO,
                'codgrupo'
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
        echo "m210311_163515_encuesta_encuesta_general cannot be reverted.\n";

        return false;
    }
    */
}
