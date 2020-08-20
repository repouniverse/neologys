<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use backend\modules\base\Module as m;
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
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/maestros/default/modal-new-facultad','id'=>$universidad_id]):
                     \yii\helpers\Url::to(['/maestros/default/modal-update-facultad','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
        
        
        
        
        
        
    </div>
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'codfac')->textInput(['maxlength' => true]) ?>
         
    </div>
    
    
    
    <div class="col-lg-3 col-md-8 col-sm-6 col-xs-12">
        <?= $form->field($model, 'desfac')->textInput(['maxlength' => true]) ?>
    </div>
    
   

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>