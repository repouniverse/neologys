<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\viewMigration;
class m200921_202326_rebuild_view_convocadosdocentes extends viewMigration
{
  const NAME_VIEW='{{%inter_vw_convocados_docentes}}';
 
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
         'b.am','b.ap','b.nombres',  'b.codigoper','b.tipodoc','b.numerodoc','codgrupo',
         'c.acronimo','c.descripcion',
        'd.codoce as codigodocente','d.carrera_base','d.unidest_id','d.facudest_id','d.carreradest_id',
        'v.codesp','v.nombre'
        ])
    ->from(['a'=>'{{%inter_convocados}}'])->
     innerJoin('{{%personas}} b', 'a.persona_id=b.id')->
     innerJoin('{{%inter_modos}} c', 'c.id=a.modo_id')->          
      innerJoin('{{%docentes}} d', 'd.id=a.docente_id')->
     innerJoin('{{%carreras}} v', 'v.id=d.carreradest_id')
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
