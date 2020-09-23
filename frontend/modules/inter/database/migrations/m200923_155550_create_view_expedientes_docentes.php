<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\viewMigration;
class m200923_155550_create_view_expedientes_docentes extends viewMigration
{
  const NAME_VIEW='{{%inter_vw_expedientes_docentes}}';
 
    public function safeUp()
    {
         $vista=static::NAME_VIEW;
        if($this->existsTable($vista)) {
        $this->dropView($vista);
        }
        $comando= $this->db->createCommand(); 
        
        $comando->createView($vista,
                (new \yii\db\Query())
    ->select([
         'a.*',
         'b.am','b.ap','b.nombres',  'b.codigoper','b.tipodoc','b.numerodoc','b.codgrupo',
         'c.acronimo','c.descripcion',
        'd.codoce as codigodocente','d.codoce1','d.codoce2','d.unidest_id','d.facudest_id','d.carreradest_id',
        'v.codesp','v.nombre',
        'x.id as id_expediente','x.plan_id', 'x.estado as estadoexp','x.requerido','x.orden','x.etapa_id'  ,
         'z.desdocu',
        'p.acronimo as acronimoplan','p.descripcion as decriplan',
       // 'p.acronimo as acronimoexp','p.descripcion as descriexpediente',
        'e.id as id_eval', 'e.acronimo as acronimoeval','e.descripcion as descrieval',
         'w.ap as apeval','w.am as ameval','w.nombres as nombreseval'
        ])
    ->from(['a'=>'{{%inter_convocados}}'])->
     innerJoin('{{%personas}} b', 'a.persona_id=b.id')->
     innerJoin('{{%inter_modos}} c', 'c.id=a.modo_id')->          
      innerJoin('{{%docentes}} d', 'd.id=a.docente_id')->
     innerJoin('{{%carreras}} v', 'v.id=d.carrera_base')-> 
    innerJoin('{{%inter_expedientes}} x', 'x.convocado_id=a.id')->
   innerJoin('{{%inter_plan}} p', 'p.id=x.plan_id')->
  innerJoin('{{%inter_evaluadores}} e', 'e.id=p.eval_id')->
  innerJoin('{{%trabajadores}} w', 'w.id=e.trabajador_id')->
   innerJoin('{{%documentos}} z', 'z.codocu=x.codocu')
                )->execute();
       
   }
public function safeDown()
    {
     
    $vista=static::NAME_VIEW;
        if($this->existsTable($vista)) {
        $this->dropView($vista);
        }
    }
    
}
