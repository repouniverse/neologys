<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\helpers\comboHelper;
use frontend\modules\inter\Module as m;
//use frontend\modules\sigi\models\SigiUnidades;
use kartik\date\DatePicker;
 use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiTransferencias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-transferencias-form">
    
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField',
     //'enableAjaxValidation'=>true,
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.m::t('labels', 'Save'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">

   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
     <?= $form->field($model, 'numero')->textInput(['disabled' => true]) ?>

 </div> 
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     <?= $form->field($model, 'descripcion')->textInput([]) ?>

 </div> 
   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> comboHelper::getCboUniversidades(),
               'campo'=>'universidad_id',
               'idcombodep'=>'intereventos-facultad_id',
               
                   'source'=>[\common\models\masters\Facultades::className()=>
                                [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div> 

 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
     
    <?php
    $data=($model->isNewRecord)?[]:comboHelper::getCboFacultades($model->universidad_id);
   echo  $form->field($model, 'facultad_id')->
            dropDownList($data,
                  ['prompt'=>'--'.m::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
  
     </div> 

 
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'finicio')->widget(DatePicker::class, [
                             'language' => h::app()->language,
                           // 'readonly'=>true,
                          // 'inline'=>true,
                           'pluginOptions'=>[
                                     'format' => h::gsetting('timeUser', 'date')  , 
                                  'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>"-99:+0",
                               ],
                           
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
</div>
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'ftermino')->widget(DatePicker::class, [
                             'language' => h::app()->language,
                           // 'readonly'=>true,
                          // 'inline'=>true,
                           'pluginOptions'=>[
                                     'format' => h::gsetting('timeUser', 'date')  , 
                                  'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>"-99:+0",
                               ],
                           
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
</div>       
          
          
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
     <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>

 </div>
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>

 </div>
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalles')->textArea([]) ?>

 </div>        
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
