<?php
use console\migrations\baseMigration;
/**
 * Class m201124_203822_create_table_docente_curso_seccion
 */
class m201124_203822_create_table_docente_curso_seccion extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const TABLE='{{%docente_curso_seccion}}';
    const TABLE_DOCENTES='{{%docentes}}';
    const TABLE_CURSOS='{{%cursos}}';
    public function safeUp()
    {
 $table=static::TABLE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'curso_id' => $this->integer(11)->notNull(),
            'docente_id' => $this->integer(11)->notNull(),
            'seccion' => $this->string(12)->append($this->collateColumn()),
            //'periodo' => $this->string(10)->notNull()->append($this->collateColumn()),
            'activo' => $this->char(1)->append($this->collateColumn())          
            ],
           $this->collateTable());
       $this->addForeignKey($this->generateNameFk($table),
                    $table,'docente_id', static::TABLE_DOCENTES,'id');
       $this->addForeignKey($this->generateNameFk($table),
                    $table,'curso_id', static::TABLE_CURSOS,'id');
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
if ($this->existsTable(static::TABLE)) {
            $this->dropTable(static::TABLE);
        }
    }

    
}
