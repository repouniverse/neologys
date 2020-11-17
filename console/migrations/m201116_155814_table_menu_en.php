<?php

use yii\db\Migration;

/**
 * Class m201116_155814_table_menu_en
 */
class m201116_155814_table_menu_en extends baseMigration
{
    const NAME_TABLE='{{%menu_en}}';
    //const NAME_TABLE_GRUPO_PERSONAS='{{%grupo_personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsTable($table))
        {
            $this->createTable
                   (
                        $table,
                        [
                            'id'=>$this->primaryKey(),
                             'name'=>$this->string(128)->notNull()->append($this->collateColumn()), 
                           'parent' => $this->integer(11),
                            'route'=>$this->string(255)->append($this->collateColumn()), 
                           'order' => $this->integer(11),
                            'data' => $this->binary(),
                            'icon'=>$this->string(35)->append($this->collateColumn()), 
                            'language'=>$this->string(10)->append($this->collateColumn()), 
                            ], $this->collateTable()
                   );      
            
            //$this->fillData();
        }
    }

 
        
    public function safeDown()
    {        
        if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null)
        {
            $this->dropTable(static::NAME_TABLE);
        }
    }
}