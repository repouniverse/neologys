<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm; 
use common\helpers\h;
use common\widgets\spinnerWidget\spinnerWidget;
?>

<div class="sigi-unidades-form">
    <?php echo spinnerWidget::widget();?>
    <?php $form = ActiveForm::begin([
        'id'=>'myformulario'/*,'enableAjaxValidation'=>true*/
    ]); ?>
      <div class="box-header">
          
        <div class="col-md-12">
            <div class="form-group no-margin">
          <?php if($model->isNewRecord){
                    $url=Url::to(['/acad/'.$this->context->id.'/modal-create-observacion','id'=>$id]);
                     } else{
                      $url=Url::to(['/acad/'.$this->context->id.'/modal-edit-observacion','id'=>$model->id]);   
                     }
              ?>
          <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'myformulario',
                      'url'=>$url,
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
            </div>
        </div>
    </div>
     
  
      <div class="box-body">
          
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <?php echo $form->field($model, 'seccion')->textInput();
   ?>
 </div>   
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'observacion')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        //'preset' => 'basic'
        ]);
   ?>
 </div> 
          
  
     
    <?php ActiveForm::end(); ?>

</div>
    </div>

