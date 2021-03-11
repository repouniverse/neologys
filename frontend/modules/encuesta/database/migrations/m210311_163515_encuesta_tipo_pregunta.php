<?php

namespace frontend\modules\encuesta\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210311_163515_encuesta_tipo_pregunta
 */
class m210311_163515_encuesta_tipo_pregunta extends baseMigration
{
    const NAME_TABLE='{{%encuesta_tipo_pregunta}}';
    
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DEL USUARIO NO REGISTRADO
                'nombre_tipo' => $this->String(30)->notNull(),
                

            ], $this->collateTable());

            

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
        echo "m210311_163612_encuesta_tipo_pregunta cannot be reverted.\n";

        return false;
    }
    */
}
