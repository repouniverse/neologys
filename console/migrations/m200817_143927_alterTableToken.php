<?php

use console\migrations\baseMigration;

/**
 * Class m200817_143927_alterTableToken
 */
class m200817_143927_alterTableToken extends baseMigration
{
    const NAME_TABLE='{{%tokens}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if($this->existsColumn($table,'expired_at'))
        $this->renameColumn( $table, 'expired_at', 'expire_at');    
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'mail'))
            $this->renameColumn( $table, 'expire_at', 'expired_at');    
   
           //$this->dropColumn($table,'mail');
      
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
