<?php

use common\helpers\h;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
USE yii\grid\GridView;






use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\Module as m;
use common\widgets\selectwidget\selectWidget;
USE common\widgets\buttonajaxwidget\buttonAjaxWidget;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-success">
    <div class="box-body">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">       
        
        <H4><?=h::awe('address-card').h::space(10).m::t('labels','Current Evaluator')?></H4>
<div class="combovalores-form">
   <?php Pjax::begin(['id'=>'registro'.$model->id,'timeout'=>false]);   ?>
   <?php $form = ActiveForm::begin(['id'=>'form-pico',
        //'fieldClass'=>'\common\components\MyActiveField'
        ]); 
   $modelEv=$model->eval;
   ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?=$form->field($modelEv, 'trabajador_id')
           ->label(m::t('labels','In charge'))
           ->textInput(['value'=>$modelEv->trabajador->fullName(),'maxlength' => true,'disabled'=>true]) ?>
            
        </div>  
   
     
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($modelEv, 'descripcion')->textInput(['maxlength' => true,'disabled'=>true]) ?>
</div>
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">>
            <?=$form->field($modelEv, 'carrera_id')->label(m::t('labels','Carrera'))->textInput(['value'=>$modelEv->carrera->nombre,'maxlength' => true,'disabled'=>true]) ?>
            
        </div>  
     
    
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?=$form->field($modelEv, 'depa_id')->label(m::t('labels','Departament'))->textInput(['value'=>$modelEv->depa->nombredepa,'maxlength' => true,'disabled'=>true]) ?>
           
         
        </div>   
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($modelEv, 'detalles')->textArea(['disabled'=>true]) ?>
</div>   
   

    <?php ActiveForm::end(); ?>
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php $url= Url::to(['modal-edit-eval','id'=>$modelEv->id,'gridName'=>'registro'.$model->id,'idModal'=>'buscarvalor']);
                             //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            echo Html::a('<span class="glyphicon glyphicon-pencil"></span>'.h::space(10).m::t('labels','Edit Evaluator'), $url, ['class'=>'botonAbre btn btn-success btn-sm ']);
         ?>  
    </div>  
     
 <?php Pjax::end(); ?>
</div>
</div>
 <div  style="border-left-style: dashed; border-width: 1px; color:#ebbf43;"  class="col-lg-6 col-md-6 col-sm-6 col-xs-12">  
  <H4><?=h::awe('calendar').h::space(10).m::t('labels','Schedules')?></H4>   
     
      
  

<?php $gridName='grilla-rangos'.$model->id;?>
    <?php Pjax::begin(['id'=>$gridName,'timeout'=>false]); ?>
   
    <?php 
     echo GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(
                [
                    'query'=> frontend\modules\inter\models\InterHorarios::find()->
                                andWhere(['plan_id'=>$model->id]),
                ]
                ),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{edit}',
                'buttons' => [
                   
                         'edit' => function ($url,$model) use($gridName) {
			    $url= Url::to(['edit-horario','id'=>$model->id,'gridName'=>$gridName,'idModal'=>'buscarvalor']);
                             //echo  Html::button(m::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => m::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            }
                    ]
                ],
            'dia',
             [
                 'attribute'=>'nombredia',
                 'format'=>'raw',
                    'value' => function ($model, $key, $index, $column) {
                        $formato=($model->activo)?'  <i style="color:#3ead05;font-size:12px"><span class="glyphicon glyphicon-ok"></span></i>':
                        '  <i style="color:red;font-size:12px"><span class="glyphicon glyphicon-remove"></span></i>';
                        return $model->nombredia.$formato;
                        },
                 
                 ],
             'tolerancia',
            /*[
                'attribute'=>'psico',
                'header'=>'Psicólogo',
                 'value'=>function($model){
                   if(!empty($model->codtra)){
                       return $model->trabajadores->fullName();
                   }else{
                      return  ''; 
                   }
                   
                        
                 }
            ],  */               
            'hinicio',
             'hfin',
          
        ],
    ]); ?>
        
   <?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-expe'.$model->id,
            'idGrilla'=>$gridName,
            'ruta'=>Url::to(['/inter/programa/ajax-rellena-horarios','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]
       
   );   ?>     
      
         
    <?php Pjax::end(); ?>
  <br>
  <br>
   <br>
  <br>
  
   <?php
 $url= Url::to(['create-horario','id'=>$model->id,'gridName'=>$gridName,'idModal'=>'buscarvalor']);
   echo  Html::button('<span class="glyphicon glyphicon-pencil"></span>'.h::space(10).m::t('labels','Generate Schedules'), ['href' => '#', 'title' => m::t('labels','Add Schedule'),'id'=>'btn-expe'.$model->id, 'class' => 'btn-success']); 
?> 
            
    
    
  
 </div>       
        
</div>