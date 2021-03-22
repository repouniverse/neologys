<?php

namespace frontend\modules\encuesta\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210311_163612_encuesta_pregunta_encuesta
 */
class m210311_163612_encuesta_pregunta_encuesta extends baseMigration
{
    const NAME_TABLE='{{%encuesta_pregunta_encuesta}}';
    const NAME_TABLE_TIPO_PREGUNTA='{{%encuesta_tipo_pregunta}}';
    const NAME_TABLE_ENCUESTA='{{%encuesta_encuesta_general}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),                
                'id_encuesta' => $this->integer(11)->notNull(),
                'id_tipo_pregunta' => $this->integer(11)->notNull(),
<<<<<<< HEAD
                'pregunta' => $this->String(300)->notNull(),                
=======
                'pregunta' => $this->String(120)->notNull(),                
>>>>>>> 066132325083732b259b8bb15492721b69cc606d

            ], $this->collateTable());

            

        }
        
        $this->addForeignKey(
            $this->generateNameFk($table),
            $table,
            'id_tipo_pregunta',
            static::NAME_TABLE_TIPO_PREGUNTA,
            'id'
        );

        $this->addForeignKey(
            $this->generateNameFk($table),
            $table,
            'id_encuesta',
            static::NAME_TABLE_ENCUESTA,
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
        echo "m210311_163555_encuesta_pregunta_encuesta cannot be reverted.\n";

        return false;
    }
    */
}
