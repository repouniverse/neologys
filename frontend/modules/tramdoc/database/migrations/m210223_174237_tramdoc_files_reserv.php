<?php
namespace frontend\modules\tramdoc\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m210223_174237_tramdoc_files_reserv
 */
class m210223_174237_tramdoc_files_reserv extends baseMigration
{
    const NAME_TABLE='{{%tramdoc_files_reserv}}';
    const NAME_TABLE_MATRICULA_REACT='{{%tramdoc_matricula_reserv}}';
    const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    
    
    public function safeUp()
    {
        $table = static::NAME_TABLE;
        if (!$this->existsTable($table)) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                //ID DE LA PERSONA
                'matr_reserv_id' => $this->integer(11)->notNull(),
                //TIPO DE DOCUMENTO
                'docu_id'=>$this->char(3)->append($this->collateColumn()),
                //SUBIDO
                'is_subido' => $this->char(1)->defaultValue(0),
                

            ], $this->collateTable());

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'matr_reserv_id',
                static::NAME_TABLE_MATRICULA_REACT,
                'id'
            );

            $this->addForeignKey(
                $this->generateNameFk($table),
                $table,
                'docu_id',
                static::NAME_TABLE_DOCUMENTOS,
                'codocu'
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
