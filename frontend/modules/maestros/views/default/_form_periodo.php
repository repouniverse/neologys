<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Periodos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="periodos-form">
    <br>
    <?php $form = ActiveForm::begin(); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
    
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codperiodo')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'periodo')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?=$form->field($model, 'activa')->checkBox() ?>


 </div>
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
