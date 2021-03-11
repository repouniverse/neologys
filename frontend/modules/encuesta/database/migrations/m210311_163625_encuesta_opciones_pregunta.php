<?php

namespace frontend\modules\encuesta\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210311_163625_encuesta_opciones_pregunta
 */
class m210311_163625_encuesta_opciones_pregunta extends baseMigration
{
    const NAME_TABLE='{{%encuesta_opciones_pregunta}}';
    const NAME_TABLE_PREGUNTA='{{%encuesta_pregunta_encuesta}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                'id_pregunta' => $this->integer(11)->notNull(),
                'valor' => $this->String(30)->notNull(),
                'descripcion' => $this->String(30)->notNull(),

            ], $this->collateTable());

        }

        $this->addForeignKey(
            $this->generateNameFk($table),
            $table,
            'id_pregunta',
            static::NAME_TABLE_PREGUNTA,
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
        echo "m210311_163625_encuesta_opciones_pregunta cannot be reverted.\n";

        return false;
    }
    */
}
