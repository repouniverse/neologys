<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\viewMigration;
class m201208_211339_create_view_acad_syllabus_cursos_doce extends viewMigration
{
   const NAME_VIEW='{{%acad_vw_syllabus_curso_doce}}';
 
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
         'd.ap','d.am','d.nombres','d.tipodoc','d.numerodoc','d.codoce',
        'pd.codcursocorto','pd.carrera_id',
        'c.codcur','c.descripcion',
        'p.codperiodo','p.id as plan_id_padre',
        'cr.codesp','cr.nombre'
        ])
    ->from(['a'=>'{{%acad_responsables_syllabus}}'])->
     innerJoin('{{%docentes}} d', 'd.id=a.docente_id')->
     innerJoin('{{%planes_estudio}} pd', 'pd.id=a.plan_estudio_id')->  
     innerJoin('{{%cursos}} c', 'c.id=pd.curso_id')-> 
     innerJoin('{{%carreras}} cr', 'cr.id=pd.carrera_id')-> 
      innerJoin('{{%planes}} p', 'p.id=pd.planes_id')
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
