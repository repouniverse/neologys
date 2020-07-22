<?php

use yii\db\Migration;

/**
 * Class m200716_223320_alter_table_auth_item
 */
class m200716_223320_alter_table_auth_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%auth_item}}', 'transaccion', $this->string(6)->defaultValue(null));
        $this->addColumn('{{%auth_item}}', 'esruta', $this->char(1)->defaultValue(null));
        $this->addColumn('{{%auth_item}}', 'grupo', $this->string(3)->defaultValue(null));
    
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('{{%auth_item}}', 'transaccion');
        $this->dropColumn('{{%auth_item}}', 'esruta');
         $this->dropColumn('{{%auth_item}}', 'grupo');
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
