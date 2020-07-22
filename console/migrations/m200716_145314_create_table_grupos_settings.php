<?php

use yii\db\Migration;
use  console\migrations\baseMigration;
class m200716_145314_create_table_grupos_settings extends  baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABlE='{{%grupo_parametros}}';
    //const NAME_TABlE_USER='{{%user}}';
    public function safeUp()
    {
        $table=static::NAME_TABlE;
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable($table)) {
       $this->createTable($table, [
            'id'=>$this->primaryKey(),
             'codgrupo' => $this->string(3)->append($this->collateColumn()),
            'descripcion' => $this->string(40)->append($this->collateColumn()),
            'detalle' => $this->text()->append($this->collateColumn()),
            
            ],
           $this->collateTable());
      
        }
        
         
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
   if ($this->db->schema->getTableSchema(static::NAME_TABlE, true) !== null) {
            $this->dropTable(static::NAME_TABlE);
        }
    }

   
}
