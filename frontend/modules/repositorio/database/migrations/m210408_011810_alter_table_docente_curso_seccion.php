<?php
namespace frontend\modules\repositorio\database\migrations;
use console\migrations\baseMigration;
class m210408_011810_alter_table_docente_curso_seccion extends baseMigration
{
    const NAME_TABLE = '{{%docente_curso_seccion}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $table = static::NAME_TABLE;
        if (!$this->existsColumn($table, 'periodo'))
            $this->addColumn($table, 'periodo', $this->char(10));
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
        /* $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'publico'))
           $this->dropColumn($table,'publico');*/
    }
}
