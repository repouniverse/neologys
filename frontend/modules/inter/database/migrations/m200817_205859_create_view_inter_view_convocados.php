<?php

namespace frontend\modules\inter\database\migrations;
use console\migrations\viewMigration;
/**
 * Class m200817_205859_create_view_inter_view_convocados
 */
class m200817_205859_create_view_inter_view_convocados extends viewMigration
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
        'd.descripcion as desprograma'        
        ])
    ->from(['a'=>'{{%inter_convocados}}'])->
     innerJoin('{{%personas}} b', 'a.persona_id=b.id')->
     innerJoin('{{%inter_modos}} c', 'c.id=a.modo_id')->          
      innerJoin('{{%inter_programa}} d', 'd.id=a.programa_id')
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
