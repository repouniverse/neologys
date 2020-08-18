<?php

use console\migrations\baseMigration;

/**
 * Class m200723_172319_modify_table_auth_item_new_column_isauditable
 */
class m200723_172319_modify_table_auth_item_new_column_isauditable extends baseMigration
{
    const NAME_TABlE='{{%auth_item}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $table=self::NAME_TABlE;
     if(!$this->existsColumn($table,'isauditable'))
        $this->addColumn(self::NAME_TABlE, 'isauditable', $this->char(1)->defaultValue(null));
        //$this->addColumn(self::NAME_TABlE, 'esruta', $this->char(1)->defaultValue(null));
        //$this->addColumn(self::NAME_TABlE, 'grupo', $this->string(3)->defaultValue(null));
    
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=self::NAME_TABlE;
     if($this->existsColumn($table,'isauditable'))
       $this->dropColumn(self::NAME_TABlE, 'isauditable');
        //$this->dropColumn(self::NAME_TABlE, 'esruta');
        // $this->dropColumn(self::NAME_TABlE, 'grupo');
        return true;
    }

}
