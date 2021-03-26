<?php

namespace frontend\modules\encuesta\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210311_163658_encuesta_respuesta_encuesta
 */
class m210311_163658_encuesta_respuesta_encuesta extends baseMigration
{
    const NAME_TABLE='{{%encuesta_respuesta_encuesta}}';
    const NAME_TABLE_PREGUNTA='{{%encuesta_pregunta_encuesta}}';
    const NAME_TABLE_PERSONA_ENCUESTA='{{%encuesta_persona_encuesta}}';

    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                'id_pregunta' => $this->integer(11)->notNull(),
                'id_persona_encuesta' => $this->integer(11)->notNull(),
                'respuesta' => $this->String(250)->notNull(),

            ], $this->collateTable());

        }

        $this->addForeignKey(
            $this->generateNameFk($table),
            $table,
            'id_pregunta',
            static::NAME_TABLE_PREGUNTA,
            'id'
        );

        $this->addForeignKey(
            $this->generateNameFk($table),
            $table,
            'id_persona_encuesta',
            static::NAME_TABLE_PERSONA_ENCUESTA,
            'id'
        );
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
        echo "m210311_163646_encuesta_respuesta_encuesta cannot be reverted.\n";

        return false;
    }
    */
}
