<?php

namespace frontend\modules\encuesta\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210311_163646_encuesta_persona_encuesta
 */
class m210311_163646_encuesta_persona_encuesta extends baseMigration
{
    const NAME_TABLE='{{%encuesta_persona_encuesta}}';
    const NAME_TABLE_ENCUESTA='{{%encuesta_encuesta_general}}';
    const NAME_TABLE_PERSONA='{{%personas}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                'id_encuesta' => $this->integer(11)->notNull(),
                'id_persona' => $this->integer(11)->notNull(),
                'fecha' => $this->String(30)->notNull(),

            ], $this->collateTable());

        }

        $this->addForeignKey(
            $this->generateNameFk($table),
            $table,
            'id_encuesta',
            static::NAME_TABLE_ENCUESTA,
            'id'
        );

        $this->addForeignKey(
            $this->generateNameFk($table),
            $table,
            'id_persona',
            static::NAME_TABLE_PERSONA,
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
        echo "m210311_163658_encuesta_persona_encuesta cannot be reverted.\n";

        return false;
    }
    */
}
