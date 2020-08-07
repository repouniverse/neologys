<?php


use console\migrations\baseMigration;
/**
 * Class m200727_172535_create_table_trabajadores
 */
class m200727_172535_create_table_personas extends baseMigration
{

    const NAME_TABLE='{{%personas}}';
    const NAME_TABLE_GRUPO_PERSONAS='{{%grupo_personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
             'id'=>$this->primaryKey(),
            'codigoper' => $this->string(8)->notNull()->append($this->collateColumn()),
            'user_id' => $this->integer(11), 
             'identidad_id' => $this->integer(11), 
             'tipodoc' => $this->char(2)->append($this->collateColumn()),  
            'ap' => $this->string(40)->notNull()->append($this->collateColumn()), 
            'am'=>$this->string(40)->notNull()->append($this->collateColumn()), 
            'nombres'=>$this->string(40)->notNull()->append($this->collateColumn()),
            'numerodoc' => $this->string(20)->append($this->collateColumn()),
            // 'ppt' => $this->string(10)->append($this->collateColumn()),
              //'pasaporte' => $this->string(10)->append($this->collateColumn()),
           //'codpuesto'=>$this->string(3)->notNull()->append($this->collateColumn()),
            'cumple'=>$this->char(10)->notNull()->append($this->collateColumn()),
            'fecingreso'=>$this->char(10)->append($this->collateColumn()),
            'domicilio'=>$this->string(73)->append($this->collateColumn()),
             'telfijo'=>$this->string(13)->append($this->collateColumn()),
            'telmoviles'=>$this->string(30)->append($this->collateColumn()),
            'referencia'=>$this->string(30)->append($this->collateColumn()),
              'codgrupo'=>$this->string(3)->notNull()->append($this->collateColumn()),
            ], $this->collateTable());
      
         $this->createIndex(uniqid('k_codigoper'), static::NAME_TABLE, 'codigoper',true);
       // $this->createIndex(uniqid('k_dni'), static::NAME_TABLE, 'dni');
        $this->createIndex(uniqid('k_ap'), static::NAME_TABLE, 'ap');
        $this->createIndex(uniqid('identidad_'), static::NAME_TABLE, 'identidad_id');
        $this->createIndex(uniqid('k_am'), static::NAME_TABLE, 'am');
        $this->createIndex(uniqid('k_nombres'), static::NAME_TABLE, 'nombres');
          $this->createIndex(uniqid('k_nombrescompletos'), static::NAME_TABLE, ['nombres','ap','am']);
               $this->addForeignKey($this->generateNameFk($table), $table,
              'codgrupo', static::NAME_TABLE_GRUPO_PERSONAS,'codgrupo');
    $this->putCombo($table, 'tipodoc',
            [
                'DNI',
                 'PASAPORTE',
                'PPT',
                'BREVETE',
               // 'GERENTE GENERAL'
                ]);     
  }
    
    
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
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
