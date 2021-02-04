<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use yii\widgets\Pjax;
use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matriculareact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nro_matr')->textInput(['maxlength' => true,'placeholder' =>"Ingrese número de matricula"]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true,'placeholder' =>"Ingrese su código de alumno"]) ?>
    <!-- carrera-->
    <?= $form->field($model, 'carrera_id')->dropDownList(
                combo::getCboCarreras(h::gsetting('general', 'MainFaculty')),
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",]
            );
    ?> 

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true,'placeholder' =>"Ingrese dni"]) ?>

    <?= $form->field($model, 'apellido_paterno')->textInput(['maxlength' => true,'placeholder' =>"Ingrese apellido paterno"]) ?>

    <?= $form->field($model, 'apellido_materno')->textInput(['maxlength' => true,'placeholder' =>"Ingrese apellido materno"]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true,'placeholder' =>"Ingrese su nombre"]) ?>

    <?= $form->field($model, 'email_usmp')->textInput(['maxlength' => true,'placeholder' =>"Ingrese email usmp"]) ?>

    <?= $form->field($model, 'email_personal')->textInput(['maxlength' => true,'placeholder' =>"Ingrese email personal"]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true,'placeholder' =>"Ingrese celular"]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true,'placeholder' =>"Ingrese telefono"]) ?>

    <?= $form->field($model, 'mensaje')->textarea(['rows' => 6,'placeholder' =>"Ingrese mensaje"]) ?>

    <?= $form->field($model, 'obs_alumno')->textarea(['rows' => 6,'placeholder' =>"Ingrese observación"]) ?>


    <!-- <?= $form->field($model, 'fecha_solicitud')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?> -->


    <!-- <?= $form->field($model, 'cta_sin_deuda_pendiente_check')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'oti_notifica_email_obs')->textarea(['rows' => 6]) ?> -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
