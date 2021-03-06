<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\viewMigration;
class m200918_190002_create_view_convocados_extranjeros extends viewMigration
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
        'd.codoce as codigodocente',
        //'v.codesp','v.nombre'
        ])
    ->from(['a'=>'{{%inter_convocados}}'])->
     innerJoin('{{%personas}} b', 'a.persona_id=b.id')->
     innerJoin('{{%inter_modos}} c', 'c.id=a.modo_id')->          
      innerJoin('{{%docentes}} d', 'd.id=a.docente_id')/*->
     innerJoin('{{%carreras}} v', 'v.id=d.carrera_id')*/
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
