<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matriculareact-form">

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

    <?= $form->field($model, 'fecha_solicitud')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'cta_sin_deuda_pendiente_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cta_sin_deuda_pendiente_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cta_pago_tramite_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cta_pago_tramite_adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cta_pago_tramite_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ora_record_notas_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ora_record_notas_adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ora_record_notas_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aca_cursos_aptos_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aca_cursos_aptos_adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aca_cursos_aptos_observaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ora_cursos_aptos_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ora_cursos_aptos_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'oti_cursos_aptos_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oti_cursos_aptos_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'oti_notifica_email_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oti_notifica_email_obs')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
