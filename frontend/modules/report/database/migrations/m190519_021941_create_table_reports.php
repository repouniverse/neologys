<?php
namespace frontend\modules\report\database\migrations;
use console\migrations\baseMigration;

class m190519_021941_create_table_reports extends baseMigration
{

    const NAME_TABLE='{{%reportes}}';
    const NAME_TABLE_CENTROS='{{%centros}}';
     const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
 
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null){
        $this->createTable(static::NAME_TABLE, [
            'id'=>$this->primaryKey(),
            'xgeneral'=>$this->integer(5),
            'ygeneral'=>$this->integer(5),
             'type'=>$this->string(5)->notNull()->append($this->collateColumn()),///pfd, xls, cvs,
            'xlogo'=>$this->integer(5),
             'role'=>$this->string(64)->notNull()->append($this->collateColumn()),
            'ylogo'=>$this->integer(5),
             'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()),
           'codcen'=>$this->string(5)->notNull()->append($this->collateColumn()),
           'modelo'=>$this->string(60)->notNull()->append($this->collateColumn()),
           'nombrereporte'=>$this->string(60)->notNull()->append($this->collateColumn()),
           'detalle'=>$this->text()->append($this->collateColumn()),
	'campofiltro'=>$this->string(40)->notNull()->append($this->collateColumn()),
           'tamanopapel'=>$this->string(20)->notNull()->append($this->collateColumn()),
          'x_grilla'=>$this->integer(5),
            'y_grilla'=>$this->integer(5),
            'registrosporpagina'=>$this->integer(5),
	'tienepie'=>$this->char(1)->append($this->collateColumn()),
          'tienelogo'=>$this->char(1)->append($this->collateColumn()),  
	   'xresumen'=>$this->integer(5),
            'yresumen'=>$this->integer(5),
	'comercial'=>$this->char(1)->append($this->collateColumn()),
            'tienecabecera'=>$this->char(1)->append($this->collateColumn()),	
            ], $this->collateTable());
        $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codcen', self::NAME_TABLE_CENTROS,'codcen');
       $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'codocu', self::NAME_TABLE_DOCUMENTOS,'codocu');
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