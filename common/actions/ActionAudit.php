<?php
namespace common\actions;
use common\helpers\h;
use common\models\audit\ActiverecordlogSearch as AuditDataSearch;
use yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionAudit extends \yii\base\Action
{
	
	public function run()
	{
         
        $clase=str_replace('_','\\',h::request()->get('nombreclase'));
        //$isImage=h::request()->get('isImage');
        $id=h::request()->get('modelid');
       // $ext=h::request()->get('extension');
       //$idGrilla=h::request()->get('idGrilla');
        if(!is_numeric($id))
          throw new \yii\base\Exception(Yii::t('base_errors', 'Id is invalid'));
        $this->controller->layout = "install";
       // $nombremodal=
        $model= new $clase;
         $arrttribute=array_keys($model->getPrimaryKey(true));
       $attribute= $arrttribute[0];
      // var_dump($attribute);die();
        $model = $clase::find()->where([$attribute=>$id])->one();
        //var_dump($model);die();
         $provider=(New AuditDataSearch())->searchByModel($model); 
        
        //return '';
            return $this->controller->render('@common/views/audit', [
                        'model' => $model,
                        'provider'=>$provider,
                // 'allowedExtensions' => $allowedExtensions,
                        //'vendorsForCombo' => $vendorsForCombo,
            ]);
        }  



}