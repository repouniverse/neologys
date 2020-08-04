<?php
namespace common\actions;
use common\helpers\h;
use yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionSearchSelect extends \yii\base\Action
{
	
	public function run()
	{
	if(h::request()->isAjax){
         //VAR_DUMP(h::request()->post('searchTerm'));DIE();
           //h::response()->format = \yii\web\Response::FORMAT_JSON;
         $filter= h::request()->post('searchTerm');
         $modelo= h::request()->post('model');
         // VAR_DUMP($modelo);
         $firstField=h::request()->post('firstField');
         $secondField=h::request()->post('secondField');
         $adicionales=h::request()->post('thirdField');
         //var_dump($adiconales);die();
         $modelo=str_replace('_','\\',$modelo);
         if(is_null($filter) or empty($filter) or trim($filter)=="") 
              $resultados=[];
           else{
               $query=$modelo::find()->where(['like',$secondField,$filter]);
               $camposegundo="";
              if(is_array($adicionales) && count($adicionales)){   
                 /* if(!isset($adicionales[$secondField]))
                   array_unshift($adicionales,$secondField);
                  if(!isset($adicionales[$firstField]))
                   array_unshift($adicionales,$firstField);*/
                  
                  foreach($adicionales as $clave=>$valor){   
                      $camposegundo.=",'-',".$valor;
                      $query=$query->orFilterWhere(['like',$valor,$filter]);
                  }
                  //$camposegundo=$firstField.$camposegundo;
                  $camposegundo=substr($camposegundo,5);
                  $expresion=new \yii\db\Expression('CONCAT('.$camposegundo.')');
                  $query=$query->select([$firstField." as id",$expresion.' as text']);
              }else{
                  $query=$query->select([$firstField." as id",$secondField.' as text'])->where(['like',$secondField,$filter]);
              }
              yii::error($query->createCommand()->getRawSql());
             $resultados= $query->asArray()->all();            
         }         
           return  \yii\helpers\Json::encode($resultados);
           //ECHO \yii\helpers\Json::encode([['id'=>'001','text'=>'PRIMERO'],['id'=>'002','text'=>'SEGUNDO']]);
        }
          }
}