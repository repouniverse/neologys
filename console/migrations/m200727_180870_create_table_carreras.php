<?php

use console\migrations\baseMigration;

/**
 * Class m200804_200039_create_table_carreras
 */
class m200727_180870_create_table_carreras extends baseMigration
{
     const NAME_TABLE='{{%carreras}}';
      const NAME_TABLE_UNIVERSIDADES='{{%universidades}}';
      const NAME_TABLE_FACULTADES='{{%facultades}}';
      
    public function safeUp()
    {
                $table=static::NAME_TABLE;
            if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'universidad_id'=>$this->integer(11),
              'facultad_id'=>$this->integer(11),
            'codesp'=>$this->string(8)->append($this->collateColumn()),
            'nombre' => $this->string(60)->notNull()->append($this->collateColumn()),
            'acronimo' => $this->string(12)->notNull()->append($this->collateColumn()),
           'ciclo' => $this->integer(2),
            'detalle'=>$this->text()->append($this->collateColumn())
            ], $this->collateTable());
        
        $this->addForeignKey($this->generateNameFk($table), $table,
              'universidad_id', self::NAME_TABLE_UNIVERSIDADES,'id'); 
        $this->addForeignKey($this->generateNameFk($table), $table,
              'facultad_id', self::NAME_TABLE_FACULTADES,'id'); 
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if ($this->existsTable(static::NAME_TABLE)) {
            $this->dropTable(static::NAME_TABLE);
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200804_200039_create_table_carreras cannot be reverted.\n";

        return false;
    }
    */
}
