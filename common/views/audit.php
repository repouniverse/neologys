<?php 
use yii\widgets\ActiveForm;
 use yii\widgets\Pjax;
use yii\grid\GridView;
 use yii\helpers\Html;
  use yii\helpers\Url;
 //use frontend\modules\sta\models\ExamenesSearch;
?>  
  
    <?php Pjax::begin(['id'=>'PjaxAudit','timeout'=>false]); ?>
   <?php //var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'id'=>'grid-audit',
        'dataProvider' =>$provider,
         //'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
             ['attribute'=>'action',
                 //'group'=>true, 
                 ],  
            //'action', 
            ['attribute'=>'nombrecampo',
                // 'group'=>true, 
                 ],  
             ['attribute'=>'username',
                 'format'=>'raw',
                 'value'=>function($model){
                    return '<span class="fa fa-user"></span>  -  '.$model->username;
                }
                // 'group'=>true, 
                 ], 
              ['attribute'=>'ip',
                 //'group'=>true, 
                 ], 
             ['attribute'=>'creationdate',
                // 'group'=>true, 
                 ], 
            ['attribute'=>'oldvalue',
                'value'=>function($model){
                    return substr($model->oldvalue,0,30);
                }
                // 'group'=>true, 
                 ], 
            ['attribute'=>'newvalue',
                'value'=>function($model){
                    return substr($model->newvalue,0,30);
                }
                 ], 
             
        ],
    ]); ?>
       
   <?php 
    Pjax::end(); ?>
