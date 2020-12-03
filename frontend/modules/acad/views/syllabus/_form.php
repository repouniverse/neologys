<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\helpers\h;
use common\widgets\selectwidget\selectWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acad-syllabus-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'plan_id')->textInput() ?>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     <?= $form->field($model, 'codperiodo')->
            dropDownList(ComboHelper::getCboPeriodos(h::periodos()->currentPeriod),
                  ['prompt'=>'--'.yii::t('base_labels','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
           ) ?>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'n_horasindep')->textInput() ?>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     <?php echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'docente_owner_id',
         'ordenCampo'=>1,
         'addCampos'=>[9,10,11,13],
        'inputOptions'=>[/*'enableAjaxValidation'=>true*/],
        ]);
                
           ?>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'datos_generales')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'sumilla')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div>
    
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'competencias')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'prog_contenidos')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'estrat_metod')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'recursos_didac')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div>  
    
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'fuentes_info')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div>  
    
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'formula_id')->textInput() ?>
</div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
