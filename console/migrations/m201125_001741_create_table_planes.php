<?php

use console\migrations\baseMigration;

/**
 * Class m201125_001741_create_table_planes
 */
class m201125_001741_create_table_planes  extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const TABLE='{{%planes_estudio}}';
    const TABLE_CARRERAS='{{%carreras}}';
    const TABLE_FACULTADES='{{%facultades}}';
    const TABLE_CURSOS='{{%cursos}}';
    public function safeUp()
    {
 $table=static::TABLE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'curso_id' => $this->integer(11)->notNull(),
            'codcursocorto' => $this->string(10)->notNull(),
            'codcurso' => $this->string(18)->notNull(),
            'facultad_id' => $this->integer(11)->notNull(),
            'carrera_id' => $this->integer(11)->notNull(),
            'creditos' =>$this->integer(3)->notNull(),
           'ciclo' =>$this->string(3)->notNull(),
            'hteoria' =>$this->integer(2),
            'hpractica' =>$this->integer(2),
           'obligatoriedad' =>$this->char(1)->append($this->collateColumn()),
           'tipoproceso'=>$this->char(3)->append($this->collateColumn()),
           'codareaesp'=>$this->string(6)->append($this->collateColumn()),
               
            ],
           $this->collateTable());
       
       $this->addForeignKey($this->generateNameFk($table),
                    $table,'facultad_id', static::TABLE_FACULTADES,'id');
       $this->addForeignKey($this->generateNameFk($table),
                    $table,'carrera_id', static::TABLE_CARRERAS,'id');       
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
