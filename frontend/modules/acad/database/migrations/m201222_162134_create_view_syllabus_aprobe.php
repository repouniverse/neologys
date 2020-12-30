<?php
namespace frontend\modules\acad\database\migrations;
use console\migrations\viewMigration;
class m201222_162134_create_view_syllabus_aprobe extends viewMigration
{
   const NAME_VIEW='{{%acad_vw_syllabus}}'; 
   const NAME_TABLE_SYLLABUS_APROBE='{{%acad_tramite_syllabus}}'; 
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
          'c.codcur','c.descripcion',
          'pd.codcursocorto','pd.carrera_id',
         'cr.codesp','cr.nombre',
         'd.ap','d.am','d.nombres','d.tipodoc','d.numerodoc','d.codoce',
        ])
    ->from(['a'=>'{{%acad_syllabus}}'])->
      innerJoin('{{%cursos}} c', 'c.id=a.curso_id')-> 
      innerJoin('{{%planes_estudio}} pd', 'pd.id=a.plan_id')->  
       innerJoin('{{%carreras}} cr', 'cr.id=pd.carrera_id')-> 
     innerJoin('{{%docentes}} d', 'd.id=a.docente_owner_id')         
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
