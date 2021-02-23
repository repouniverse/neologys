<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use yii\widgets\Pjax;
use common\helpers\h;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\TramdocMatriculaReserv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tramdoc-matricula-reserv-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nro_matr')->textInput(['maxlength' => true,'placeholder' =>"Ingrese número de matricula"]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true,'placeholder' =>"Ingrese su código de alumno"]) ?>

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

    <?= $form->field($model, 'fecha_solicitud')->widget(
        DatePicker::className(),[
            
            'language'=>h::app()->language,
            'options'=>['placeholder' =>'--' . Yii::t('base_verbs', 'Choose a value') . "--"],
            'pluginOptions'=> [
                'format' => 'yyyy-mm-dd', 
                'changeMonth'=>true,
                'changeYear'=>true,
               'yearRange'=>"-99:+0",
            ]
        ]
    ) 
    
    ?>




    <!--
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

    <?= $form->field($model, 'estado_obs')->textarea(['rows' => 6]) ?>   -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
