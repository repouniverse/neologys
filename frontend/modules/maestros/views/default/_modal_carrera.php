<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\maestros\MaestrosModule as m;
use common\widgets\selectwidget\selectWidget;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-body">
  


   <?php $form = ActiveForm::begin(['id'=>'form-pico',
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="col-md-12">
            <div class="form-group no-margin">
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-pico',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/maestros/default/modal-new-carrera','id'=>$facultad_id]):
                     \yii\helpers\Url::to(['/maestros/default/modal-edit-carrera','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
        
        
        
        <br><br><br>
        
        
    </div>
   
     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
             <?= $form->field($model, 'universidad_id')->label(m::t('labels','University'))->
                textInput(['maxlength' => true,
                 'value'=>$model->universidad->nombre,'disabled'=>'disabled'
                 ]) ?>
     </div>
    
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <?= $form->field($model, 'codesp')->textInput(['maxlength' => true]) ?>
  </div>
    
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    </div>
    
     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'esbase')->checkBox([]) ?>
    </div>
    
    
    
     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'acronimo')->textInput(['maxlength' => true]) ?>
</div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'detalle')->textArea([]) ?>
</div>   
   

    <?php ActiveForm::end(); ?>

</div>
    
 
