<?php
use console\migrations\baseMigration;

class m201214_162018_create_table_planes_prerequisitos extends baseMigration
{
    const NAME_TABLE='{{%planes_prerequisito}}';
    const NAME_TABLE_PLANES='{{%planes_estudio}}';
   public function safeUp()
    {
       $table=static::NAME_TABLE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'plan_id' =>  $this->integer(11)->notNull(),           
            'codcursocorto' =>  $this->string(25)->notNull()->append($this->collateColumn()),           
            'activo' => $this->char(1)->append($this->collateColumn()),
            ],
           $this->collateTable());
       
       $this->addForeignKey($this->generateNameFk($table),
                    $table,'plan_id', static::NAME_TABLE_PLANES,'id');
       
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
