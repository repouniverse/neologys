<?php
use console\migrations\baseMigration;
use yii\db\Migration;

/**
 * Handles adding columns to table `{{%trabajadores}}`.
 */
class m210603_042434_add_carrera_id_column_to_trabajadores_table extends baseMigration
{
    const NAME_TABLE='{{%trabajadores}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'carrera_id'))
            $this->addColumn($table, 'carrera_id', $this->integer(1)->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'carrera_id'))
            $this->dropColumn($table,'carrera_id');
    }
}
