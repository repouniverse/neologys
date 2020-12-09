<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\viewMigration;
class m201208_130146_create_view_acad_planes_estudio extends viewMigration
{
  const NAME_VIEW='{{%acad_vw_planes_estudio}}';
 
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
         'b.codcurso','b.codcursocorto','b.creditos',  'b.ciclo',
        'b.id as plan_detalle_id','b.hteoria','b.hpractica','b.obligatoriedad','tipoproceso','codareaesp',
         'c.codesp','c.nombre','c.acronimo',
          'cu.codcur','cu.descripcion as nombrecurso','cu.ciclo as ciclocurso',
        ])
    ->from(['a'=>'{{%planes}}'])->
     innerJoin('{{%planes_estudio}} b', 'a.id=b.planes_id')->
     innerJoin('{{%carreras}} c', 'c.id=a.carrera_id')->          
      innerJoin('{{%cursos}} cu', 'cu.id=b.curso_id')
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
