<?php

namespace frontend\modules\buzon\database\migrations;
use console\migrations\baseMigration;
/**
 * Class m210122_174620_buzon_user_noreg
 */
class m210122_174620_buzon_user_noreg extends baseMigration
{
    const NAME_TABLE='{{%buzon_user_noreg}}';
    const NAME_TABLE_BUZON='{{%buzon_mensajes}}';
    const NAME_TABLE_CARRERA='{{%carreras}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DEL USUARIO NO REGISTRADO
                'nombres' => $this->String(30)->notNull(),
                //referencia de buzon
                'bm_id' => $this->integer(11)->notNull(),
                //ESCUELA QUE DIRIGE LA CONSULTA
                'esc_id' => $this->integer(11)->notNull(),
                //NOMBRE DEL USUARIO NO REGISTRADO
                'ap' => $this->String(30)->notNull(),
                //APELLIDO PATERNO
                'am' => $this->String(30)->notNull(),
                //APELLIDO MATERNO
                'numerodoc' => $this->String(30)->notNull(),
                //DNI DE LA PERSONA NO REGISTRADA
                'email'=>$this->String(30)->notNull(), 
                //EMAIL DE LA PERSONA NO REGISTRADA
                'celular'=>$this->String(30)
                

            ], $this->collateTable());

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'bm_id',
                static::NAME_TABLE_BUZON,
                'id'
            );
            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'esc_id',
                static::NAME_TABLE_CARRERA,
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
