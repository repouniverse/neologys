<?php

use yii\db\Migration;
use console\migrations\baseMigration;
/**
 * Class m200727_162103_create_table_periodos
 */
class m200727_162103_create_table_periodos extends baseMigration
{
    
     const NAME_TABLE='{{%periodos}}';
   
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table,  [
               'codperiodo'=>$this->string(10)->append($this->collateColumn()),
               'periodo'=>$this->string(40)->append($this->collateColumn()),
             'activa'=>$this->char(1)->append($this->collateColumn()),
        'tolerancia'=>$this->integer(2),
       
        ],$this->collateTable());
   $this->addPrimaryKey('pk_codpe534r',$table, 'codperiodo');
            }
 }

public function safeDown()
    {
     $table=static::NAME_TABLE;
       if($this->existsTable($table)) {
            $this->dropTable($table);
        }

    }
    
  public function fillData()
    {
            \Yii::$app->db->createCommand()->
             batchInsert(static::NAME_TABLE,
             ['codperiodo','periodo'], $this->getData())->execute();
    }

  
     private static function  getData(){             
              return [
 ['2019-III','PERIODO ACADEMICO 2020-I',''],
 ['2020-I','PERIODO ACADEMICO 2020-I',''],
['2020-II','PERIODO ACADEMICO 2020-II','1'],
           ];      
    }   
    
    
    
    

}