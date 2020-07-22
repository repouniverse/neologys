<?php
use yii\db\Migration;
use  console\migrations\baseMigration;
class m130524_201499Create_table_config extends  baseMigration
{
    /**
     * {@inheritdoc}
     */
    const NAME_TABlE='{{%config}}';
    //const NAME_TABlE_USER='{{%user}}';
    public function safeUp()
    {
        //var_dump(static::NAME_TABlE);die();
   if(!$this->existsTable(static::NAME_TABlE)) {
       $this->createTable(static::NAME_TABlE, [
            'id'=>$this->primaryKey(),
             'parametro'=>$this->string(40)->unique()->notNull()->append($this->collateColumn()),
              'clavecentro'=>$this->char(1)->append($this->collateColumn()),
            //'descripcion'=>$this->string(60)->append($this->collateColumn()),  
              'nombreModelo'=>$this->string(80)->append($this->collateColumn()),
              'nombreCampo'=>$this->string(40)->append($this->collateColumn()),
            ],
           $this->collateTable());
       $this->createIndex(
            'idx_clave_condif',
            static::NAME_TABlE,
            'parametro'
        );
       
        }
        
         
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
   if ($this->db->schema->getTableSchema(static::NAME_TABlE, true) !== null) {
            $this->dropTable(static::NAME_TABlE);
        }
    }

   
}
