<?php


use console\migrations\baseMigration;
/**
 * Class m200820_150124_alter_table_auth_item
 */
class m200820_150124_alter_table_auth_item extends baseMigration
{
      const NAME_TABlE='{{%auth_item}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=self::NAME_TABlE;
     if(!$this->existsColumn($table,'grupopersonas'))
        $this->addColumn(self::NAME_TABlE, 'grupopersonas', $this->string(3)->append($this->collateColumn())->defaultValue(null));
         
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /* $table=static::NAME_TABlE;
     if($this->existsColumn($table,'transaccion'))
       $this->dropColumn(self::NAME_TABlE, 'transaccion');
      if($this->existsColumn($table,'esruta'))
        $this->dropColumn(self::NAME_TABlE, 'esruta');
       if($this->existsColumn($table,'grupo'))
         $this->dropColumn(self::NAME_TABlE, 'grupo');
        return true;*/
    }

 
}
