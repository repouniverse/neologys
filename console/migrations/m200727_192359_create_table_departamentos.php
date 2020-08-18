<?php

use console\migrations\baseMigration;

/**
 * Class m200727_192359_create_table_departamentos
 */
class m200727_192359_create_table_departamentos extends baseMigration
{
    
    const NAME_TABLE='{{%departamentos}}';
  
    const NAME_TABLE_FACULTADES='{{%facultades}}';
    const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
    const NAME_TABLE_CARRERAS='{{%carreras}}';
    const NAME_TABLE_PERSONAS='{{%personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
             'universidad_id'=>$this->integer(11),
            'facultad_id'=>$this->integer(11),
            'coddepa' => $this->string(10)->append($this->collateColumn()),
            'nombredepa' => $this->string(40)->notNull()->append($this->collateColumn()),
            'detalles'=>$this->text()->append($this->collateColumn()),
            'correodepa' => $this->string(80)->append($this->collateColumn()),
            'webdepa' => $this->string(100)->append($this->collateColumn()),
            'codigoper' => $this->string(8)->append($this->collateColumn()),
            ], $this->collateTable());
      
        $this->createIndex($this->generateNameFk($table),$table, 'coddepa');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'codigoper', static::NAME_TABLE_PERSONAS,'codigoper');
               $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', static::NAME_TABLE_FACULTADES,'id');
           $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', static::NAME_TABLE_UNIVERSIDADES,'id');
   $this->fillData();
           
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

  public function fillData(){
       \Yii::$app->db->createCommand()->
             batchInsert(static::NAME_TABLE,
             ['universidad_id','facultad_id','nombredepa','codigoper'], $this->getData())->execute();
   
 }  
    
    
 private function getFacultades(){
    return \Yii::$app->db->createCommand()->setSql("select *from {{%facultades}}")->queryAll();
    
    
 }   
 
 
 private function getData(){
  $facultades=$this->getFacultades();
  $departamentos=[];
  $registro=[];
   $personas=\Yii::$app->db->createCommand()->setSql("select *from {{%personas}}")->queryAll();
   
   foreach($facultades as $facultad){
       for( $i= 1 ; $i <= 3 ; $i++ ) {
         $registro=[$facultad->universidad->id,$facultad->id,'DEPARTAMENTO '.$i,$personas[0]['codigoper']];
         $departamentos[]=$registro;             
       }
   }
   return  $departamentos;
 }  
    
    
    
    
}
