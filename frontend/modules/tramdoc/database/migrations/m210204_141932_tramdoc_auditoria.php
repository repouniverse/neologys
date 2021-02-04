<?php

namespace frontend\modules\tramdoc\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210204_141932_tramdoc_auditoria
 */
class m210204_141932_tramdoc_auditoria extends baseMigration
{
    const NAME_TABLE='{{%tramdoc_auditoria}}';
    const NAME_TABLE_MATRICULA_REACT='{{%tramdoc_matricula_reacts}}';
    
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DE LA PERSONA
                'matr_id' => $this->integer(11)->notNull(),
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
                'matr_id',
                static::NAME_TABLE_MATRICULA_REACT,
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
