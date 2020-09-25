<?php
namespace frontend\modules\report\database\migrations;
use console\migrations\baseMigration;

class m190519_025333_create_table_detalle_reports extends baseMigration
{

    const NAME_TABLE='{{%reportedetalle}}';
    const NAME_TABLE_REPORTE='{{%reportes}}';
     //const NAME_TABLE_DOCUMENTOS='{{%documentos}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
 
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null){
        $this->createTable(static::NAME_TABLE, [
            'id'=>$this->primaryKey(),
            // 'reporte_id'=>$this->integer(11),
             'codocu'=>$this->char(3)->notNull()->append($this->collateColumn()),
         'left'=>$this->string(10)->notNull()->append($this->collateColumn()),
          'top'=>$this->string(10)->notNull()->append($this->collateColumn()),
         'font_size'=>$this->string(10)->append($this->collateColumn()),
          'font_family'=>$this->string(18)->append($this->collateColumn()),
          'font_weight'=>$this->string(10)->append($this->collateColumn()),
          'font_color'=>$this->string(10)->append($this->collateColumn()),
         'nombre_campo'=>$this->string(60)->notNull()->append($this->collateColumn()),
          'lbl_left'=>$this->string(10)->append($this->collateColumn()),
          'lbl_top'=>$this->string(10)->append($this->collateColumn()),
         'lbl_font_size'=>$this->string(10)->append($this->collateColumn()),
          'lbl_font_weight'=>$this->string(10)->append($this->collateColumn()),
          'lbl_font_family'=>$this->string(35)->append($this->collateColumn()),
          'lbl_font_color'=>$this->string(35)->append($this->collateColumn()),
         'visiblelabel'=>$this->char(1)->append($this->collateColumn()),
         'visiblecampo'=>$this->char(1)->append($this->collateColumn()),
          'hidreporte'=>$this->integer(11)->notNull(),
         'aliascampo'=>$this->string(40)->append($this->collateColumn()),
          'longitudcampo'=>$this->integer(5),
            'orden'=>$this->integer(3),
             'tipodato'=>$this->string(30)->append($this->collateColumn()),
        'esdetalle'=>$this->char(2)->append($this->collateColumn()),
        'esatributo'=>$this->char(1)->append($this->collateColumn()),
         'hidcoordocs'=>$this->integer(11),
         'totalizable'=>$this->char(1)->append($this->collateColumn()),
          'esnumerico'=>$this->char(1)->append($this->collateColumn()),
          'adosaren'=>$this->string(15)->append($this->collateColumn()),	
            ], $this->collateTable());
        $this->addForeignKey($this->generateNameFk(static::NAME_TABLE), static::NAME_TABLE,
              'hidreporte', self::NAME_TABLE_REPORTE,'id');
      
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