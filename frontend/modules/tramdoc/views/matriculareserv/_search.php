<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\TramdocMatriculaReservSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tramdoc-matricula-reserv-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nro_matr') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'carrera_id') ?>

    <?= $form->field($model, 'dni') ?>

    <?php // echo $form->field($model, 'apellido_paterno') ?>

    <?php // echo $form->field($model, 'apellido_materno') ?>

    <?php // echo $form->field($model, 'nombres') ?>

    <?php // echo $form->field($model, 'email_usmp') ?>

    <?php // echo $form->field($model, 'email_personal') ?>

    <?php // echo $form->field($model, 'celular') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'mensaje') ?>

    <?php // echo $form->field($model, 'obs_alumno') ?>

    <?php // echo $form->field($model, 'fecha_solicitud') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'cta_sin_deuda_pendiente_check') ?>

    <?php // echo $form->field($model, 'cta_sin_deuda_pendiente_obs') ?>

    <?php // echo $form->field($model, 'cta_pago_tramite_check') ?>

    <?php // echo $form->field($model, 'cta_pago_tramite_adjunto') ?>

    <?php // echo $form->field($model, 'cta_pago_tramite_obs') ?>

    <?php // echo $form->field($model, 'ora_soli_reg_check') ?>

    <?php // echo $form->field($model, 'ora_soli_reg_adjunto') ?>

    <?php // echo $form->field($model, 'ora_soli_reg_obs') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'estado_obs') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
