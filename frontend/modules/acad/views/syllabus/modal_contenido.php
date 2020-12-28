<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm; 
use common\helpers\h;

?>

<div class="sigi-unidades-form">

    <?php $form = ActiveForm::begin([
        'id'=>'myformulario'/*,'enableAjaxValidation'=>true*/
    ]); ?>
      <div class="box-header">
          
        <div class="col-md-12">
            <div class="form-group no-margin">
          <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'myformulario',
                      'url'=>Url::to(['/acad/'.$this->context->id.'/modal-edit-content','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
            </div>
        </div>
    </div>
     
  
      <div class="box-body">
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <?php echo $form->field($model, 'n_horas_cumplimiento')->textInput();
   ?>
  </div>   
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <?php echo $form->field($model, 'n_horas_trabajo_indep')->textInput();
   ?>
  </div> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'bloque1')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        //'preset' => 'basic'
        ]);
   ?>
 </div> 
           
          
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'bloque2')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        //'preset' => 'basic'
        ]);
   ?>
 </div> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'bloque3')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
       // 'preset' => 'basic'
        ]);
   ?>
 </div>
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
