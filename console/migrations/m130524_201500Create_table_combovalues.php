<?php


use console\migrations\baseMigration;
use yii\db\Migration;

/**
 * Class M190513032529Create_table_combovalues
 */
class m130524_201500Create_table_combovalues extends baseMigration
{

 const NAME_TABLE='{{%combovalores}}';
 //const NAME_TABLE_CENTROS='{{%centros}}';
    public function safeUp()
    {
       
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
             'id'=>$this->primaryKey(),
            'nombretabla'=>$this->string(120)->append($this->collateColumn()), //define si es venta o compra
            'codcen' => $this->string(5)->append($this->collateColumn()),
            'codigo' => $this->string(6)->append($this->collateColumn()),
            'valor' => $this->string(60)->append($this->collateColumn()), 
            'valor1' => $this->string(3)->append($this->collateColumn()), 
            'valor2' => $this->string(3)->append($this->collateColumn()), 
             ],$this->collateTable());
         /*$this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codcen', static::NAME_TABLE_CENTROS,'codcen');
           }*/
    $this->createIndex(
            'idx_comnoe_cond34f',
            static::NAME_TABLE,
            'nombretabla'
        );
    }
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null) {
            $this->dropTable(static::NAME_TABLE);
        }

    }
}
