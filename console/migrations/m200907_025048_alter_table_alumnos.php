<?php

    use console\migrations\baseMigration;

/**
 * Class m200907_025048_alter_table_alumnos
 */
class m200907_025048_alter_table_alumnos extends baseMigration
{
      const NAME_TABlE='{{%alumnos}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=self::NAME_TABlE;
     if(!$this->existsColumn($table,'hasuser'))
        $this->addColumn(self::NAME_TABlE, 'hasuser', $this->char(1)->append($this->collateColumn())->defaultValue(null));
         
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $table=static::NAME_TABlE;
     if($this->existsColumn($table,'hasuser'))
       $this->dropColumn(self::NAME_TABlE, 'hasuser');
     
        return true;
    }

 
}
