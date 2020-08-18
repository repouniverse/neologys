<?php

use console\migrations\baseMigration;

/**
 * Class m200716_223320_alter_table_auth_item
 */
class m200716_223320_alter_table_auth_item extends baseMigration
{
      const NAME_TABlE='{{%auth_item}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=self::NAME_TABlE;
     if(!$this->existsColumn($table,'transaccion'))
        $this->addColumn(self::NAME_TABlE, 'transaccion', $this->string(6)->defaultValue(null));
         if(!$this->existsColumn($table,'esruta'))
     $this->addColumn(self::NAME_TABlE, 'esruta', $this->char(1)->defaultValue(null));
        if(!$this->existsColumn($table,'grupo'))
         $this->addColumn(self::NAME_TABlE, 'grupo', $this->string(3)->defaultValue(null));
    
        
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200716_223320_alter_table_auth_item cannot be reverted.\n";

        return false;
    }
    */
}
