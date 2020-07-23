<?php

use yii\db\Migration;

/**
 * Class m200716_223320_alter_table_auth_item
 */
class m200716_223320_alter_table_auth_item extends Migration
{
      const NAME_TABlE='{{%auth_item}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::NAME_TABlE, 'transaccion', $this->string(6)->defaultValue(null));
        $this->addColumn(self::NAME_TABlE, 'esruta', $this->char(1)->defaultValue(null));
        $this->addColumn(self::NAME_TABlE, 'grupo', $this->string(3)->defaultValue(null));
    
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn(self::NAME_TABlE, 'transaccion');
        $this->dropColumn(self::NAME_TABlE, 'esruta');
         $this->dropColumn(self::NAME_TABlE, 'grupo');
        return true;
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
