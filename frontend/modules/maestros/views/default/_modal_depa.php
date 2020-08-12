<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use backend\modules\base\Module as m;
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
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/maestros/default/modal-new-depa','id'=>$codigo_fac]):
                     \yii\helpers\Url::to(['/maestros/default/modal-update-depa','id'=>$model->coddepa]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
        
        
        
        
        
        
    </div>
   
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
             <?= $form->field($model, 'universidad_id')->textInput(['maxlength' => true,
                 'value'=>$model->universidad->nombre,'disabled'=>'disabled'
                 ]) ?>
     </div>
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codigoper',
         'ordenCampo'=>5,
         'addCampos'=>[6,7],
        ]);  ?>

 </div>    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nombredepa')->textInput(['maxlength' => true]) ?>
  </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    
    <?= $form->field($model, 'correodepa')->textInput(['maxlength' => true]) ?>
</div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'detalles')->textArea([]) ?>
</div>   
   

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>