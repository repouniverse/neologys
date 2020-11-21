<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
/* @var $this yii\web\View */
/* @var $model common\models\MailingModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mailing-model-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
    
 
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'universidad_id')->label(yii::t('base_labels','Universidad'))->textInput(['value'=>$model->universidad->nombre,'disabled'=>true]) ?>

 </div>
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'universidad_id')->label(yii::t('base_labels','Facultad'))->textInput(['value'=>$model->facultad->desfac,'disabled'=>true]) ?>

 </div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => 40]) ?>

 </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'ruta')->textInput(['maxlength' => true,'disabled'=>true]) ?>

 </div>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
     <?= $form->field($model, 'activo')->checkbox() ?>

 </div>
 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?=$form->field($model, 'idioma')->
            dropDownList(ComboHelper::getCboIdiomas(),['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",])
         ?>
 </div>
          
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'copiato')->textInput([]) ?>

 </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'reply')->textInput(['maxlength' => true]) ?>

 </div>         
          
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'remitente')->textInput(['maxlength' => true]) ?>

 </div>
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'cuerpo')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 10],
        //'preset' => 'basic'
        ]);
   ?>
 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'parametros')->textarea(['disabled'=>true,'value'=> \yii\helpers\Json::encode($model->parametros),'rows' => 6]) ?>

 </div>
     
 
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
