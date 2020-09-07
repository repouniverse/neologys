<?php


use console\migrations\baseMigration;
/**
 * Class m200727_172535_create_table_trabajadores
 */
class m200727_172535_create_table_personas extends baseMigration
{

    const NAME_TABLE='{{%personas}}';
    const NAME_TABLE_GRUPO_PERSONAS='{{%grupo_personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsTable($table))
        {
            $this->createTable
                   (
                        $table,
                        [
                            'id'=>$this->primaryKey(),
                            'codigoper' => $this->string(8)->notNull()->append($this->collateColumn()),
                            'user_id' => $this->integer(11), 
                            'identidad_id' => $this->integer(11), 
                            'tipodoc' => $this->char(2)->append($this->collateColumn()),  
                            'ap' => $this->string(40)->notNull()->append($this->collateColumn()), 
                            'am'=>$this->string(40)->notNull()->append($this->collateColumn()), 
                            'nombres'=>$this->string(40)->notNull()->append($this->collateColumn()),
                            'numerodoc' => $this->string(20)->append($this->collateColumn()),            
                            'cumple'=>$this->char(10)->notNull()->append($this->collateColumn()),
                            'fecingreso'=>$this->char(10)->append($this->collateColumn()),
                            'domicilio'=>$this->string(73)->append($this->collateColumn()),
                            'telfijo'=>$this->string(13)->append($this->collateColumn()),
                            'telmoviles'=>$this->string(30)->append($this->collateColumn()),
                            'referencia'=>$this->string(30)->append($this->collateColumn()),
                            'codgrupo'=>$this->string(3)->notNull()->append($this->collateColumn()),
                            
                            'sexo'=>$this->string(2)->append($this->collateColumn()),
                            'pais'=>$this->string(3)->append($this->collateColumn()),
                            'estcivil'=>$this->string(1)->append($this->collateColumn()),
                            'depnac'=>$this->string(4)->append($this->collateColumn()),
                            'provnac'=>$this->string(8)->append($this->collateColumn()),
                            'distnac'=>$this->string(12)->append($this->collateColumn()),
                            'depdir'=>$this->string(4)->append($this->collateColumn()),
                            'provdir'=>$this->string(8)->append($this->collateColumn()),
                            'distdir'=>$this->string(12)->append($this->collateColumn()),
                            'alergias'=>$this->string(100)->append($this->collateColumn()),
                            'gruposangu'=>$this->string(10)->append($this->collateColumn()),
                            'usoregulmedic'=>$this->string(30)->append($this->collateColumn()),
                        ], $this->collateTable()
                   );      
            $this->createIndex(uniqid('k_codigoper'), static::NAME_TABLE, 'codigoper',true);
            $this->createIndex(uniqid('k_ap'), static::NAME_TABLE, 'ap');
            $this->createIndex(uniqid('identidad_'), static::NAME_TABLE, 'identidad_id');
            $this->createIndex(uniqid('k_am'), static::NAME_TABLE, 'am');
            $this->createIndex(uniqid('k_nombres'), static::NAME_TABLE, 'nombres');
            $this->createIndex(uniqid('k_nombrescompletos'), static::NAME_TABLE, ['nombres','ap','am']);
            $this->addForeignKey($this->generateNameFk($table), $table, 'codgrupo', static::NAME_TABLE_GRUPO_PERSONAS,'codgrupo');
            $this->putCombo
                   (
                        $table, 'tipodoc',
                        [
                            'DNI',
                            'PASAPORTE',
                            'PPT',
                            'BREVETE',
                        ]
                   ); 
            $this->fillData();
        }
    }

    public function fillData()
    {
        \Yii::$app->db->createCommand()->batchInsert(static::NAME_TABLE,
        ['codigoper','tipodoc','ap','am','nombres','numerodoc','codgrupo'], $this->getData())->execute();
    }
  
    
    
    private static function getData()
    {  
        $grupos=\Yii::$app->db->createCommand()->setSql("select *from {{%grupo_personas}}")->queryAll();
        return 
        [
            ['76000001','10','RAMIREZ','TENORIO','JULIAN','10201403',$grupos[0]['codgrupo']], 
            ['76000002','10','BARRIENTOS','MARCA','LUIS','10201409',$grupos[0]['codgrupo']],
        ];
    }
        
    public function safeDown()
    {        
        if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) !== null)
        {
            $this->dropTable(static::NAME_TABLE);
        }
    }
}
