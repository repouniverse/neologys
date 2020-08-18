<?php
namespace console\migrations;
use console\migrations\baseMigration;


class viewMigration extends baseMigration
{
    const _AND=' and ';
   /* genera una cadena con las tablas del from */
    public function prepareTables($tablas){
        $comTablas="";
      foreach($tablas as $key=>$tabla){
           $comTablas.=",".$tabla;
        }
       return  substr($comTablas,1);   
   }   
       
    
   public function createView($vista,$Fields,$Tables,$Where,$groups=null){
       //$this->dropView($vista);
       $comando= $this->db->createCommand(); 
        $q=new \yii\db\Query();
        $q->select($Fields)
                ->from($Tables)
                ->andWhere($Where);
        if(!is_null($groups)){
            $q->groupBy($groups);
        }
        $comando->createView($vista, $q)->execute();
   }
   
   public function dropView($vista){
       $comando= $this->db->createCommand();         
        $comando->dropView($vista)->execute();
   }
   
  
   
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

