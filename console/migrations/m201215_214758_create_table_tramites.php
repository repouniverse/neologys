<?php
use console\migrations\baseMigration;
class m201215_214758_create_table_tramites extends baseMigration
{
   
    const TABLE='{{%acad_tramite_syllabus}}';
    //const TABLE_PERIODOS='{{%periodos}}';
    //const TABLE_CARRERAS='{{%carreras}}';
    //const TABLE_CURSOS='{{%cursos}}';
    public function safeUp()
    {
        $table=static::TABLE;
        //var_dump(static::NAME_TABlE);die();
        if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'codocu' =>  $this->char(3)->notNull()->append($this->collateColumn()),
            'docu_id'=>$this->integer(3)->notNull(),
            'user_id'=>$this->integer(11)->notNull(),
           'orden'=>$this->integer(3)->notNull(),
           'descripcion'=>$this->string(40)->notNull(),
           'aprobado'=>$this->char(1)->notNull(),
            'motivo'=>$this->text(),
           'fecha_recibido'=>$this->string(19)->append($this->collateColumn()),
           'fecha_aprobacion'=>$this->string(19)->append($this->collateColumn()),
            ],
           $this->collateTable());      
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
