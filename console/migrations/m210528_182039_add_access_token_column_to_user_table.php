<?php

use console\migrations\baseMigration;
use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210528_182039_add_access_token_column_to_user_table extends baseMigration
{
    const NAME_TABLE='{{%user}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'access_token'))
            $this->addColumn($table, 'access_token', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'access_token'))
            $this->dropColumn($table,'access_token');
    }
}
