<?php
use console\migrations\baseMigration;
class m201215_225314_create_table_areas_cursos extends baseMigration
{
   
    const TABLE='{{%curso_area}}';
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
            'codarea' =>  $this->char(3)->notNull()->append($this->collateColumn()),
            'nombre'=>$this->string(60)->notNull(),
            
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
