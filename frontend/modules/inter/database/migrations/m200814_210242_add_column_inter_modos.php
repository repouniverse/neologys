<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m200814_210242_add_column_inter_modos
 */
class m200814_210242_add_column_inter_modos extends baseMigration
{
    const NAME_TABLE='{{%inter_modos}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'modelofuente'))
     $this->addColumn($table, 'modelofuente', $this->string(120));  
 
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'modelofuente'))
           $this->dropColumn($table,'modelofuente');
      
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
