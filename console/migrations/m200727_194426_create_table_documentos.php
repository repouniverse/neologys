<?php

use console\migrations\baseMigration;
use common\models\masters\Documentos;
/**
 * Class m200727_194426_create_table_documentos
 */
class m200727_194426_create_table_documentos extends baseMigration
{
   
 const NAME_TABLE='{{%documentos}}';
 
    public function safeUp()
    {
       
if ($this->db->schema->getTableSchema(static::NAME_TABLE, true) === null) {
        $this->createTable(static::NAME_TABLE, [
            'codocu' => $this->char(3)->append($this->collateColumn()),
            'desdocu' => $this->string(60)->notNull()->append($this->collateColumn()),
            'clase' => $this->char(1)->append($this->collateColumn()),
            'tipo' => $this->char(2)->append($this->collateColumn()),
            'tabla' => $this->string(60)->append($this->collateColumn()),
            'abreviatura'=>$this->string(5)->append($this->collateColumn()),
            'prefijo'=>$this->string(4)->append($this->collateColumn()),            
            'escomprobante'=>$this->char(1)->append($this->collateColumn()),
              'withaudit'=>$this->char(1)->append($this->collateColumn()),
             'idreportedefault'=>$this->integer(11),
             ], $this->collateTable());
       $this->addPrimaryKey('pk_docus45',static::NAME_TABLE, 'codocu');
       $comment="Define si es un comprobante ";
       $this->addCommentOnColumn(static::NAME_TABLE, 'escomprobante', $comment);
       $comment="Indica el id del reporte por defaul, sirve para visualizar un documento ";
       $this->addCommentOnColumn(static::NAME_TABLE, 'idreportedefault', $comment);
    }
    
    
     $model=New Documentos();
            static::setData($model);
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

     private static function  getData(){
        //$campos=['codocu','codocupadre','desdocu','clase','tipo','abreviatura'];
        return [
            ['100', 'FICHA MATRÍCULA' ,'D','10','GRE'],
            ['101', 'CURRICULUM VITAE' ,'D','10','DGR'],
            ['102', 'DNI' ,'D','10','FAC'],
            ['103', 'DECLARACION JURADA' ,'D','10','DFA'],
            ['104', 'CERT ANTECEDENTES POLICIALES' ,'D','10','VAL'],
            ['105', 'ORDEN DE COMPRA ' ,'D','10','DVA'],
            ['106', 'NORMAS DE CONVIVENCIA' ,'D','10','OCO'], 
            ['107', 'ACTA DE ASISTENCIA' ,'D','10','OCO'], 
            ['108', 'MEMORANDUM' ,'D','10','DFA'],
            ['109', 'REGLAMENTO INTERNO' ,'D','10','VAL'],
            ['110', 'PARTIDA REGISTRAL' ,'D','10','DVA'],
            ['111', 'CERT ANTECEDENTES JUDICI' ,'D','10','OCO'], 
            ['112', 'CERT MEDICO' ,'D','10','OCO'], 
            ['113', 'CONTRATO ALQUILER' ,'D','10','OCO'], 
            ['114', 'RECIBO' ,'D','10','DFA'],
            ['115', 'REGISTRO DE CONVOCATORIA' ,'D','10','VAL'],
            ['116', 'ACTA DE CONFORMIDAD' ,'D','10','DVA'],
            ['117', 'ORDEN DE TRABAJO' ,'D','10','OCO'], 
            ['118', 'RESERVA DE AACC' ,'D','10','OCO'], 
            ['119', 'CONTRATO DE SERVICIOS' ,'D','10','OCO'], 
            ['120', 'VALE DE MOVILIDAD' ,'D','10','OCO'], 
            ['121', 'RECIBO DE HONORARIOS PROF' ,'D','10','OCO'], 
            ['122', 'INFORME DE SERVICIOS' ,'D','10','DFA'],
            ['123', 'COMUNICADO' ,'D','10','VAL'],
            ['124', 'NOTA DE INGRESO' ,'D','10','DVA'],            
            ];
    }
    
    private static function  setData($model){
        $campos=['codocu','desdocu','clase','tipo','abreviatura'];
        foreach(static::getData() as $clave=>$valorfila){
           
           echo (($model->firstOrCreate(array_combine($campos,$valorfila))))?'Ok: Insert':'Error\n';
        }
    }
    
    
}
