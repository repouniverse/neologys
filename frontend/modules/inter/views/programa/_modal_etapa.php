<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\helpers\ComboHelperomboHelper;
use frontend\modules\inter\Module as m;
//use frontend\modules\sigi\models\SigiUnidades;
 //use kartik\date\DatePicker;
 use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiTransferencias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">
  

    
    <br>
    <?php $form = ActiveForm::begin(['id'=>'form-pico',
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="col-md-12">
            <div class="form-group no-margin">
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-pico',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/inter/programa/modal-new-etapa','id'=>$model->programa_id]):
                     \yii\helpers\Url::to(['/inter/programa/modal-edit-etapa','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
     </div>
      <div class="box-body">

  

 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
     
    <?php
    $data=ComboHelper::getCboModos($model->programa_id);
   echo  $form->field($model, 'modo_id')->
            dropDownList($data,
                  ['prompt'=>'--'.m::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
  
     </div> 
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">      
    <?php
    $data=comboHelper::getCboAwesome();
   echo  $form->field($model, 'awe')->
            dropDownList($data,
                  ['prompt'=>'--'.m::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
  
     </div> 
          
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">      
    <?php
    $data=comboHelper::getCboCardinales(20);
   echo  $form->field($model, 'orden')->
            dropDownList($data,
                  ['prompt'=>'--'.m::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
  
     </div> 
 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'activo')->checkbox() ?>

 </div>
  
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'comentarios')->textArea([]) ?>

 </div>        
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
