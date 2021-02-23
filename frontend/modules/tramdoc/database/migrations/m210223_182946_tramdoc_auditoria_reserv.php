<?php

namespace frontend\modules\tramdoc\database\migrations;
use console\migrations\baseMigration;


/**
 * Class m210223_182946_tramdoc_auditoria_reserv
 */
class m210223_182946_tramdoc_auditoria_reserv extends baseMigration
{
    const NAME_TABLE='{{%tramdoc_auditoria_reserv}}';
    const NAME_TABLE_MATRICULA_RESERV='{{%tramdoc_matricula_reserv}}';
    
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DE LA PERSONA
                'matr_reserv_id' => $this->integer(11)->notNull(),
                //persona
                'persona_id' => $this->integer(11),
                //campo
                'campo_modificado' => $this->string(),
                //valor
                'valor_modificado' => $this->string(),
                //fecha
                'fecha_modif' => $this->dateTime(),

            ], $this->collateTable());

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'matr_reserv_id',
                static::NAME_TABLE_MATRICULA_RESERV,
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
}
