<?php

use yii\helpers\Html;
use common\helpers\ComboHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\report\models\Reporte */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reporte-form">

    <?php $form = ActiveForm::begin(); ?>
    
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		  <?= $form->field($model, 'longitudcampo')->textInput(['disabled'=>'Disabled']) ?>
		
	</div>
	
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		  <?= $form->field($model, 'nombre_campo')->textInput(['disabled'=>'Disabled']) ?>
		
	</div>
	
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		
		  <?= $form->field($model, 'left')->textInput() ?>
		
	       
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'top')->textInput() ?>
	</div>
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'lbl_left')->textInput() ?>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'lbl_top')->textInput() ?>
	</div>

<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'font_size')->textInput() ?>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'font_family')->textInput() ?>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'font_weight')->textInput() ?>
		
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'font_color')->textInput() ?>
	</div>



	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'aliascampo')->textInput() ?>
	</div>

	
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'lbl_font_size')->textInput() ?>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'lbl_font_weight')->textInput() ?>
	</div>
         <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'lbl_font_family')->textInput() ?>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'lbl_font_color')->textInput() ?>
	</div>
	
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'visiblelabel')->checkBox() ?>
	</div>
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'visiblecampo')->checkBox() ?>
	</div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'esdetalle')->checkBox() ?>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'totalizable')->checkBox() ?>
	</div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'esnumerico')->checkBox() ?>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		 <?= $form->field($model, 'adosaren')->textInput() ?>
	</div>
	

     
    
    <div class="form-group">
        
        <?= Html::submitButton(Yii::t('report.messages', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

  