<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
/* @var $this yii\web\View */
/* @var $model common\models\FormatoDocs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="formato-docs-form">

    <?php $form = ActiveForm::begin(); ?>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?=$form->field($model, 'codocu')->
            dropDownList(ComboHelper::getCboDocuments(),['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",])
         ?>
 </div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>
 </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
