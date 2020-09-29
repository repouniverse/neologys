<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\viewMigration;
class m200929_173857_view_inter_planes extends viewMigration
{
  const NAME_VIEW='{{%inter_vw_planes}}';
 
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
         'b.acronimo as acromodo','b.descripcion as descrimodo',
         'c.acronimo as acroeval','c.descripcion as descrieval',
         'p.codperiodo',
        'e.descripcion as descrietapa',
       // 'v.codesp','v.nombre',
        't.ap','t.am','t.nombres',
        'd.nombredepa',
        'x.id as carrera_id','x.codesp','x.nombre as nombrecarrera',
        's.desdocu'
        ])
    ->from(['a'=>'{{%inter_plan}}'])->
     innerJoin('{{%inter_modos}} b', 'a.modo_id=b.id')->
     innerJoin('{{%documentos}} s', 'a.codocu=s.codocu')->            
     innerJoin('{{%inter_evaluadores}} c', 'c.id=a.eval_id')-> 
                 innerJoin('{{%inter_programa}} p', 'p.id=a.programa_id')-> 
      innerJoin('{{%departamentos}} d', 'd.id=a.depa_id')->
     innerJoin('{{%inter_etapas}} e', 'e.id=a.etapa_id')-> 
    innerJoin('{{%trabajadores}} t', 'c.trabajador_id=t.id')->  
     innerJoin('{{%carreras}} x', 'x.id=c.carrera_id')           
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
