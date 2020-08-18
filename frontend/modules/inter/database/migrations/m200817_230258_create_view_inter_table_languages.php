<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;
class m200817_230258_create_view_inter_table_languages extends  baseMigration
{
    const NAME_TABLE='{{%inter_idiomasalu}}';
   const NAME_TABLE_MODOS='{{%inter_modos}}';
    const NAME_TABLE_PROGRAMAS='{{%inter_programa}}';
        const NAME_TABLE_CONVOCATORIAS='{{%inter_convocados}}';
        
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsTable($table)){
        $this->createTable($table, [
            'id'=>$this->primaryKey(),
            'convocatoria_id'=>$this->integer(11),
            'programa_id'=>$this->integer(11),
            'modo_id'=>$this->integer(11),
            'idioma'=>$this->string(3)->notNull()->append($this->collateColumn()),
            'codnivel'=>$this->string(1)->notNull()->append($this->collateColumn()),
             'detalle'=>$this->text()->append($this->collateColumn()),
             'certificado'=>$this->string(1)->notNull()->append($this->collateColumn()),
          
            ], $this->collateTable());
      
       
           $this->addForeignKey($this->generateNameFk($table), $table,
              'programa_id', static::NAME_TABLE_PROGRAMAS,'id');
           
           $this->addForeignKey($this->generateNameFk($table), $table,
              'modo_id', static::NAME_TABLE_MODOS,'id');
           
              $this->addForeignKey($this->generateNameFk($table), $table,
              'convocatoria_id', static::NAME_TABLE_CONVOCATORIAS,'id');
             
            /*$this->addForeignKey($this->generateNameFk($table), $table,
              'programa_id', static::NAME_TABLE_PROGRAMAS,'id');
           */
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

    
}
