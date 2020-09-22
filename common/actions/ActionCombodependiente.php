<?php
namespace common\actions;
use common\helpers\h;
use common\helpers\ComboHelper;
USE yii\helpers\Html;
use yii;
/* 
 *
 */

class ActionCombodependiente extends \yii\base\Action
{	
	public function run(){
	//Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          // yii::error('inicinaod');
            /*$modelo= h::request()->post('clase');*/
            $valorfiltro=h::request()->post('filtro');
            /*$campoclave=h::request()->post('campoclave');
            $camporef=h::request()->post('camporef');*/
           $isremote=h::request()->post('isremotesource');
           $source=h::request()->post('source');
           
           if($isremote=='yes'){
             $modelo=array_keys($source)[0];
             $clase= new $modelo;
            // var_dump($clase instanceof ComboHelper);die();
             if($clase instanceof ComboHelper){
                 $funcion=$source[$modelo]['campofiltro'];
                $datos=$modelo::{$funcion}($valorfiltro);
             }else{
                 $query=$modelo::find()->select([
                     $source[$modelo]['campoclave'],
                      $source[$modelo]['camporef']
                 ])->andWhere([
                     $source[$modelo]['campofiltro']=>$valorfiltro
                         ]);
                 if(array_key_exists('additionalFilter', $source[$modelo]))
                   if(is_array($source[$modelo]['additionalFilter'])){
                    //  var_dump();
                    $query->andWhere($source[$modelo]['additionalFilter']);   
                   }
                   $arrData=$query->asArray()->all();
                  
                   $datos=array_combine(array_column( $arrData,$source[$modelo]['campoclave']),
                            array_column($arrData,$source[$modelo]['camporef']));
                 
                 //$model::find()->
                 /*var_dump( $valorfiltro,
                     $modelo,
                     $source[$modelo]['campofiltro'],
                     $source[$modelo]['campoclave'],
                      $source[$modelo]['camporef']);*/
                  /*$datos=ComboHelper::getCboGeneral(
                     $valorfiltro,
                     $modelo,
                     $source[$modelo]['campofiltro'],
                     $source[$modelo]['campoclave'],
                      $source[$modelo]['camporef']);*/
             }
           
            
            $datos=[''=>yii::t('base.verbs','--Choose a value--')]+$datos;
           }else{/*Se traa de datos directametne */
               $datos=$source;
             
           }
           
           //yii::error( $datos);
          return $this->generateHtml($datos);   
        }
        
        private function generateHtml($datos){
           return  Html::renderSelectOptions('', $datos);
        }
}