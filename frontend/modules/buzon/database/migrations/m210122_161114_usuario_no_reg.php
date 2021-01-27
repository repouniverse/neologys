<?php
namespace frontend\modules\buzon\database\migrations;
use console\migrations\baseMigration;


/**
 * Class m210122_161114_usuario_no_reg
 */
class m210122_161114_usuario_no_reg extends baseMigration
{
    const NAME_TABLE='{{%user_no_reg}}';
 
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DEL USUARIO NO REGISTRADO
                'nombre' => $this->String(30)->notNull(),
                //NOMBRE DEL USUARIO NO REGISTRADO
                'ap' => $this->String(30)->notNull(),
                //APELLIDO PATERNO
                'am' => $this->String(30)->notNull(),
                //APELLIDO MATERNO
                'dni' => $this->String(30)->notNull(),
                //DNI DE LA PERSONA NO REGISTRADA
                'email'=>$this->String(30)->notNull(), 
                //EMAIL DE LA PERSONA NO REGISTRADA
                'celular'=>$this->String(30)
                

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
        echo "m210119_162146_create_table_buzon_mensaje cannot be reverted.\n";

        return false;
    }
    */
}
