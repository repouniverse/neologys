<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\viewMigration;
class m200913_160939_rebuild_view_convocados extends viewMigration
{
  const NAME_VIEW='{{%inter_vw_convocados}}';
 
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
        'd.codalu as codigoalumno','d.codalu1','d.codalu2','carrera_id'  ,
        'v.codesp','v.nombre'
        ])
    ->from(['a'=>'{{%inter_convocados}}'])->
     innerJoin('{{%personas}} b', 'a.persona_id=b.id')->
     innerJoin('{{%inter_modos}} c', 'c.id=a.modo_id')->          
      innerJoin('{{%alumnos}} d', 'd.id=a.alumno_id')->
     innerJoin('{{%carreras}} v', 'v.id=d.carrera_id')
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
