<?php

use console\migrations\baseMigration;

/**
 * Class m200731_202151_create_table_person_trabajadores
 */
class m200731_202151_create_table_person_trabajadores extends baseMigration
{
    
    const NAME_TABLE='{{%trabajadores}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
         'id'=>$this->primaryKey(),
            //'coddepa' => $this->string(10)->append($this->collateColumn()),
            /******ROMPIENDO LA NORAMLIZAVCION, ESTO NOS AHORTRARA MUCHO TRABAJKOS
             * Y LA NORMALIZACION LAMANEJAREMOS A NIEL DE CODIGO
             * ESTOS CAMPSO SE REPITEN EN TODOS LAS IDENTIDADDES*************/
              'ap' => $this->string(40)->notNull()->append($this->collateColumn()), 
            'am'=>$this->string(40)->notNull()->append($this->collateColumn()), 
            'nombres'=>$this->string(40)->notNull()->append($this->collateColumn()),
            'numerodoc' => $this->string(20)->append($this->collateColumn()),
           'tipodoc' => $this->char(2)->append($this->collateColumn()),  
             /*******************/
            
            'fingreso' => $this->string(10)->append($this->collateColumn()),
            'detalles'=>$this->text()->append($this->collateColumn()),
            'correo' => $this->string(80)->append($this->collateColumn()),
            'codtra' => $this->string(10)->append($this->collateColumn()),
            'persona_id' => $this->integer(11),
            'codigoper' => $this->string(8)->append($this->collateColumn()),
            'codcargo' => $this->string(8)->append($this->collateColumn()),
            ], $this->collateTable());
      
       
   
  }
    
    
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        if (!$this->existsTable(static::NAME_TABLE)) {
            $this->dropTable(static::NAME_TABLE);
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
