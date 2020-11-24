<?php
namespace frontend\modules\repositorio\database\migrations; 
use console\migrations\viewMigration;

/**
 * Class m201124_171125_view_asesoresasignados
 */
class m201124_174753_vw_asesores extends viewMigration
{
    const NAME_VIEW='{{%repositorio_vw_asesores_asignados}}';
 
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
        'x.ap','x.am','x.carrera_id','x.nombres','x.numerodoc','x.tipodoc','x.codalu','x.carrera_id',
         'c.codcur','c.descripcion',
         'f.ap as apasesor','f.am as amasesor','f.nombres as nombresasesor','f.numerodoc as numdocasesor','f.tipodoc as tipodocasesor',
        'b.seccion','b.curso_id','b.alumno_id','b.activo',
        'a.asesor_id','a.matricula_id',
        'e.orcid',
        'h.nombre','h.codesp'
        
        ])
    ->from(['a'=>'{{%asesores_curso}}'])->
     innerJoin('{{%matricula}} b', 'a.matricula_id=b.id')->
     innerJoin('{{%alumnos}} x', 'x.id=a.alumno_id')-> 
     innerJoin('{{%carreras}} h', 'h.id=x.carrera_id')-> 
     innerJoin('{{%cursos}} c', 'b.curso_id=c.id')->           
    // innerJoin('{{%alumnos}} d', 'd.id=b.alumno_id')-> 
       innerJoin('{{%asesores}} e', 'a.asesor_id=e.id')-> 
        innerJoin('{{%personas}} f', 'f.id=e.persona_id')
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
