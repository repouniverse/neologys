<?php
namespace common\components;
//use  frontend\modules\report\Module;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii;
class columnGridAudit extends DataColumn 
{
  public $format='raw';
  public $linkOptions=['target'=>'_blank','data-pjax'=>'0'];
  protected function renderDataCellContent($model, $key, $index)
    {
      $arrttribute=array_keys($model->getPrimaryKey(true));
       $attribute= $arrttribute[0];
     
      $url=\yii\helpers\Url::toRoute(['/finder/audit','isImage'=>false,'idModal'=>'imagemodal','modelid'=>$model->{$attribute},'nombreclase'=> str_replace('\\','_',$model::className())]);
                        $options = [
                            'title' => Yii::t('sta.labels', 'Auditoría'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                        ];
                        return Html::button('<span class="fa fa-route"></span>', ['href' => $url, 'title' => 'Auditoría', 'class' => 'botonAbre btn btn-success']);
                        //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                     
                        
                       
      //$options=[];  
      //if ($this->content !== null) {
        //return parent::renderDataCellContent($model, $key, $index); 
        //return Html::a('<span  style="color:orange; font-size:19px;"><i class="glyphicon glyphicon-paste " aria-hidden="true"></i></span>',Module::urlReport($model->reporte_id, $model->getPrimaryKey()), $this->linkOptions);
      //}
    
    }
    
    
}

    

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



