<?php

namespace frontend\modules\buzon\database\migrations;
use console\migrations\viewMigration;
/**
 * Class m210120_175918_create_view_buzon_mensajes
 */
class m210120_175918_create_view_buzon_mensajes extends viewMigration
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
         'bm.id','bm.user_id','bm.departamento_id','a.nombres',
         'a.ap','a.am','c.codesp','a.numerodoc','u.email',
         'd.nombredepa', 'bm.mensaje', 'bm.estado', 'bm.fecha_registro',
         'bm.prioridad',
        ])
        ->from(['bm'=>'{{%buzon_mensajes}}'])->
         innerJoin('{{%departamentos}} d', 'd.id = bm.departamento_id')-> 
         innerJoin('{{%user}} u', 'u.id = bm.user_id')->  
         innerJoin('{{%profile}} p', 'p.user_id = u.id')-> 
         innerJoin('{{%personas}} pa', 'pa.id = p.persona_id')->
         innerJoin('{{%alumnos}} a', 'a.persona_id = pa.id')->
         innerJoin('{{%carreras}} c', 'a.carrera_id = c.id')         
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
