<?php

use console\migrations\baseMigration;

/**
 * Class m200807_185437_create_table_preguntas_autenticacion
 */
class m200807_185437_create_table_preguntas_autenticacion extends baseMigration
{
    
    const NAME_TABLE='{{%preguntas_aut}}';
    const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;

    
if(!$this->existsTable($table)){
        $this->createTable($table, [
         'id'=>$this->primaryKey(),
          'lang'=>$this->string(8)->notNull()->append($this->collateColumn()), 
          'pregunta'=>$this->text()->notNull()->append($this->collateColumn()),
          'respuesta'=>$this->string(20)->append($this->collateColumn()),
            'activequerystring'=>$this->text()->notNull()->append($this->collateColumn()),
            'modo_id'=>$this->integer(11),
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

   
}
