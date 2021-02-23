<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\TramdocMatriculaReserv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tramdoc-matricula-reserv-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nro_matr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carrera_id')->textInput() ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido_paterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido_materno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_usmp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_personal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mensaje')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'obs_alumno')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_solicitud')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'cta_sin_deuda_pendiente_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cta_sin_deuda_pendiente_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cta_pago_tramite_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cta_pago_tramite_adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cta_pago_tramite_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ora_soli_reg_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ora_soli_reg_adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ora_soli_reg_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_obs')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
