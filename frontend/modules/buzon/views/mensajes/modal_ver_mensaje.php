<?php
//use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

const _PENDIENTE = 1;
const _PROCESO = 2;
const _ATENDIDO = 3;
//use kartik\date\DatePicker;

use common\helpers\h;
//use frontend\modules\sigi\helpers\comboHelper;
//use common\widgets\selectwidget\selectWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiUnidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-mensaje-form">

    <?php $form = ActiveForm::begin([
        'id' => 'vermensaje'/*,'enableAjaxValidation'=>true*/
    ]); ?>
    <div class="box-header">


    </div>


    <div class="box-body ">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4>DETALLES DEL MENSAJE: </h4>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php
            echo  Html::label('Estado');
            if ($model->estado == _PENDIENTE) echo  Html::textInput('Estado', "PENDIENTE", ['class' => 'form-control', 'disabled' => true,]);
            if ($model->estado == _PROCESO) echo  Html::textInput('Estado', "PROCESO", ['class' => 'form-control', 'disabled' => true,]);
            if ($model->estado == _ATENDIDO) echo  Html::textInput('Estado', "ATENDIDO", ['class' => 'form-control', 'disabled' => true,]);
            ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'fecha_registro')->textInput(['disabled' => true]) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'alumno_nombres')->textInput(['disabled' => true,]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'alumno_ap')->textInput(['disabled' => true,]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'alumno_am')->textInput(['disabled' => true,]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'codesp')->textInput(['disabled' => true,]) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'nombredepa')->textInput(['disabled' => true,]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'numerodoc')->textInput(['disabled' => true,]) ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'mensaje')->textArea(['disabled' => true,]) ?>
        </div>


        <?php

        if(!is_null($cordi_acad)){
            echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>" . $form->field($cordi_acad, 'docente')->textInput(['disabled' => true,]) . "</div>";
            echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>" . $form->field($cordi_acad, 'curso')->textInput(['disabled' => true,]) . "</div>";
            echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>" . $form->field($cordi_acad, 'seccion')->textInput(['disabled' => true,]) . "</div>";
        }

        if(!is_null($aula_virtual)){
            echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>" . $form->field($aula_virtual, 'docente')->textInput(['disabled' => true,]) . "</div>";
            echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>" . $form->field($aula_virtual, 'curso')->textInput(['disabled' => true,]) . "</div>";
            echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>" . $form->field($aula_virtual, 'seccion')->textInput(['disabled' => true,]) . "</div>";
            echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>" . $form->field($aula_virtual, 'ciclo')->textInput(['disabled' => true,]) . "</div>";
        }

    
        ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4>Atendido por: </h4>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'trabajador_nombres')->textInput(['disabled' => true,]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'trabajador_ap')->textInput(['disabled' => true,]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'trabajador_am')->textInput(['disabled' => true,]) ?>
        </div>


        <?php ActiveForm::end(); ?>

    </div>
</div>

<style>

</style>