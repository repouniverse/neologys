<?php
  use console\migrations\baseMigration;
class m200912_054959_alter_table_menu extends baseMigration
{
    
    /**
     * {@inheritdoc}
     */
    const NAME_TABLE='{{%menu}}';
    public function safeUp()
    {
         /** Agregando una columna a la tabla Direcciones
         * con su respectiva llave foranes
         */
        $table=static::NAME_TABLE;
        //var_dump($table);die();
      if($this->existsTable($table)) {
          if(!$this->existsColumn($table,'icon')){         
            $this->addColumn($table,
                 'icon', 
                 $this->string(35)->append($this->collateColumn())
                 );
        }
        (new \yii\db\Query)
    ->createCommand()->update($table, ['icon' => 'circle'],'id >0')->execute();
   
      }
        
            
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE;
        if($this->existsColumn($table,'icon')){ 
            $this->dropColumn($table,'icon');
        }
       
       
    }
}