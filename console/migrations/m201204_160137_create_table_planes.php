<?php
use console\migrations\baseMigration;
class m201204_160137_create_table_planes extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    const TABLE='{{%planes}}';
    const TABLE_PERIODOS='{{%periodos}}';
    const TABLE_CARRERAS='{{%carreras}}';
    //const TABLE_CURSOS='{{%cursos}}';
    public function safeUp()
    {
 $table=static::TABLE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'codperiodo' =>  $this->string(10)->notNull()->append($this->collateColumn()),           
            'descripcion' =>  $this->string(60)->notNull()->append($this->collateColumn()),           
            
           'carrera_id' => $this->integer(11)->notNull(),
            'activo' => $this->char(1)->append($this->collateColumn()),
            ],
           $this->collateTable());
       
       $this->addForeignKey($this->generateNameFk($table),
                    $table,'codperiodo', static::TABLE_PERIODOS,'codperiodo');
       $this->addForeignKey($this->generateNameFk($table),
                    $table,'carrera_id', static::TABLE_CARRERAS,'id'); 
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
