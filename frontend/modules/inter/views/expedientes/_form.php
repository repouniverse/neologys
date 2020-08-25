<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-expedientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'universidad_id')->textInput() ?>

    <?= $form->field($model, 'facultad_id')->textInput() ?>

    <?= $form->field($model, 'depa_id')->textInput() ?>

    <?= $form->field($model, 'programa_id')->textInput() ?>

    <?= $form->field($model, 'modo_id')->textInput() ?>

    <?= $form->field($model, 'convocado_id')->textInput() ?>

    <?= $form->field($model, 'clase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codocu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fpresenta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fdocu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detalles')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'textointerno')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'requerido')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
