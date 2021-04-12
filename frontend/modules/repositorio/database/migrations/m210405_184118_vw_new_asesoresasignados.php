<?php

namespace frontend\modules\repositorio\database\migrations;

use yii\db\Migration;
use console\migrations\viewMigration;

/**
 * Class m210405_184118_vw_new_asesoresasignados
 */
class m210405_184118_vw_new_asesoresasignados extends viewMigration
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
        'f.id as docente_id', 'f.ap as apasesor','f.am as amasesor','f.nombres as nombresasesor','f.numerodoc as numdocasesor','f.tipodoc as tipodocasesor',
        'b.seccion','b.curso_id','b.alumno_id','b.activo',
        'a.id','a.asesor_id','a.matricula_id',
        'e.orcid',
        'h.nombre','h.codesp','b.periodo'
        
        ])
    ->from(['a'=>'{{%asesores_curso}}'])->
     innerJoin('{{%matricula}} b', 'a.matricula_id=b.id')->
     innerJoin('{{%alumnos}} x', 'x.id=a.alumno_id')-> 
     innerJoin('{{%carreras}} h', 'h.id=x.carrera_id')-> 
     innerJoin('{{%cursos}} c', 'b.curso_id=c.id')->           
    // innerJoin('{{%alumnos}} d', 'd.id=b.alumno_id')-> 
       innerJoin('{{%asesores}} e', 'a.asesor_id=e.id')-> 
        innerJoin('{{%docentes}} f', 'f.id=e.docente_id')
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
