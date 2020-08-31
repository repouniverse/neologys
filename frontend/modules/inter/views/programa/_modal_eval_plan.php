<?php

use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\Module as m;
use common\widgets\selectwidget\selectWidget;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-success">
    <div class="box-body">
<div class="combovalores-form">

   <?php $form = ActiveForm::begin(['id'=>'form-pico',
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="col-md-12">
            <div class="form-group no-margin">
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-pico',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/inter/programa/modal-new-plan','id'=>$model->eval_id]):
                     \yii\helpers\Url::to(['/inter/programa/modal-edit-plan','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
        
        
        
        
        
        
    </div>
   
     
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'acronimo')->textInput(['maxlength' => true]) ?>
  </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
</div>
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'codocu')->
            dropDownList(ComboHelper::getCboDocuments() ,
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div>   
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'orden')->
            dropDownList(ComboHelper::getCboCardinales(40),
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div>   
    
      
   

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>