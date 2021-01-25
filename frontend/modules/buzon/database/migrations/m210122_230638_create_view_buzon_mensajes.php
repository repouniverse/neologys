<?php

namespace frontend\modules\buzon\database\migrations;
use console\migrations\viewMigration;
/**
 * Class m210120_175918_create_view_buzon_mensajes
 */
class m210122_230638_create_view_buzon_mensajes extends viewMigration
{   
    const NAME_VIEW='{{%buzon_vw_mensajes}}'; 
    const NAME_TABLE_SYLLABUS_APROBE='{{%buzon_mensajes}}'; 
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
         'bm.id as buzon_mensaje_id','bm.user_id as user_id','bm.departamento_id','a.nombres as alumno_nombres',
         'a.ap as alumno_ap','a.am as alumno_am','c.codesp','c.id as carrera_id','a.numerodoc','a.mail',
         'd.nombredepa', 'bm.mensaje', 'bm.estado', 'bm.fecha_registro',
         'bm.prioridad','t.id as trabajador_id','t.nombres as trabajador_nombres',
         't.ap as trabajador_ap','t.am as trabajador_am'
        ])
        ->from(['bm'=>'{{%buzon_mensajes}}'])->
         innerJoin('{{%departamentos}} d', 'd.id = bm.departamento_id')-> 
         innerJoin('{{%user}} u', 'u.id = bm.user_id')->  
         innerJoin('{{%profile}} p', 'p.user_id = u.id')-> 
         innerJoin('{{%personas}} pa', 'pa.id = p.persona_id')->
         innerJoin('{{%alumnos}} a', 'a.persona_id = pa.id')->
         innerJoin('{{%carreras}} c', 'a.carrera_id = c.id')->
         innerJoin('{{%personas}} t', 't.id = bm.trabajador_id')->
         union((new \yii\db\Query())
         ->select([
          'bm.id as buzon_mensaje_id','u.id as user_id','bm.departamento_id','u.nombres as alumno_nombres',
          'u.ap as alumno_ap','u.am as alumno_am','c.codesp','c.id as carrera_id','u.numerodoc','u.email',
          'd.nombredepa', 'bm.mensaje', 'bm.estado', 'bm.fecha_registro',
          'bm.prioridad','t.id as trabajador_id','t.nombres as trabajador_nombres',
          't.ap as trabajador_ap','t.am as trabajador_am'
         ])
         ->from(['bm'=>'{{%buzon_mensajes}}'])->
          innerJoin('{{%departamentos}} d', 'd.id = bm.departamento_id')-> 
          innerJoin('{{%buzon_user_noreg}} u', 'u.bm_id = bm.id')->  
          innerJoin('{{%carreras}} c', 'u.esc_id = c.id')->
          innerJoin('{{%personas}} t', 't.id = bm.trabajador_id')
          )
          )->execute();
       
   }
public function safeDown()
    {
         $vista=static::NAME_VIEW;
        if($this->existsTable($vista)) {
        $this->dropView($vista);
        }
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function safeUp()
    // {

    // }
    // /**
    //  * {@inheritdoc}
    //  */
    // public function safeDown()
    // {
    //     echo "m210120_175918_create_view_buzon_mensajes cannot be reverted.\n";

    //     return false;
    // }

    // /*
    // // Use up()/down() to run migration code without a transaction.
    // public function up()
    // {

    // }

    // public function down()
    // {
    //     echo "m210120_175918_create_view_buzon_mensajes cannot be reverted.\n";

    //     return false;
    // }
    // */
}
