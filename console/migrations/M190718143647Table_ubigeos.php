<?php

use  console\migrations\baseMigration;
class M190718143647Table_ubigeos extends baseMigration
{

 const NAME_TABLE='{{%ubigeos}}';
 
            
    public function safeUp()
    {
       $table=static::NAME_TABLE;
if(!$this->existsTable($table)) {
    $this->createTable($table, [
             'id'=>$this->primaryKey(),
        'coddepa' => $this->char(3)->notNull()->append($this->collateColumn()),
         'codprov'=>$this->char(6)->notNull()->append($this->collateColumn()), 
           'coddist' => $this->char(9)->notNull()->append($this->collateColumn()),
             'departamento' => $this->string(35)->notNull()->append($this->collateColumn()),
        'provincia' => $this->string(35)->notNull()->append($this->collateColumn()),
        'distrito' => $this->string(35)->notNull()->append($this->collateColumn()),
       
             ],$this->collateTable());
        /* $this->addForeignKey($this->generateNameFk($table), $table,
              'codcen', static::NAME_TABLE_CENTROS,'codcen');
          $this->addForeignKey($this->generateNameFk($table), static::NAME_TABLE,
              'user_id', static::NAME_TABLE_USER,'id');*/
               }
}

public function safeDown()
    {
        $table=static::NAME_TABLE;
       if($this->existsTable($table)) { 
            $this->dropTable($table);
        }

    }

}