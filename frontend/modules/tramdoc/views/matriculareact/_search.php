<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\MatriculareactSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matriculareact-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
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

    <?php // echo $form->field($model, 'fecha_solicitud') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'cta_sin_deuda_pendiente_check') ?>

    <?php // echo $form->field($model, 'cta_sin_deuda_pendiente_obs') ?>

    <?php // echo $form->field($model, 'cta_pago_tramite_check') ?>

    <?php // echo $form->field($model, 'cta_pago_tramite_adjunto') ?>

    <?php // echo $form->field($model, 'cta_pago_tramite_obs') ?>

    <?php // echo $form->field($model, 'ora_record_notas_check') ?>

    <?php // echo $form->field($model, 'ora_record_notas_adjunto') ?>

    <?php // echo $form->field($model, 'ora_record_notas_obs') ?>

    <?php // echo $form->field($model, 'aca_cursos_aptos_check') ?>

    <?php // echo $form->field($model, 'aca_cursos_aptos_adjunto') ?>

    <?php // echo $form->field($model, 'aca_cursos_aptos_observaciones') ?>

    <?php // echo $form->field($model, 'ora_cursos_aptos_check') ?>

    <?php // echo $form->field($model, 'ora_cursos_aptos_obs') ?>

    <?php // echo $form->field($model, 'oti_cursos_aptos_check') ?>

    <?php // echo $form->field($model, 'oti_cursos_aptos_obs') ?>

    <?php // echo $form->field($model, 'oti_notifica_email_check') ?>

    <?php // echo $form->field($model, 'oti_notifica_email_obs') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base_labels', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
