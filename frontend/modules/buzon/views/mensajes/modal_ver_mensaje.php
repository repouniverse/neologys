<?php
//use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

const _URGENTE = 1;
const _PENDIENTE = 2;
const _PROCESO = 3;
const _ATENDIDO = 4;
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
            if ($model->estado == _URGENTE) echo  Html::textInput('Estado', "URGENTE", ['class' => 'form-control', 'disabled' => true,]);
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
        if (!is_null($cordi_acad)) {
            foreach ($cordi_acad as $index => $cordi) {
                echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>" .Html::label('Curso Nº '.$index ). "</div>";
                echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>" . $form->field($cordi, '[$index]docente')->textInput(['disabled' => true,]) . "</div>";
                echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>" . $form->field($cordi, '[$index]curso')->textInput(['disabled' => true,]) . "</div>";
                echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>" . $form->field($cordi, '[$index]seccion')->textInput(['disabled' => true,]) . "</div>";
            }
        }

        if (!is_null($aula_virtual)) {
            foreach ($aula_virtual as $index => $aula) {
                echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>" .Html::label('Curso Número: '.$index ). "</div>";
                echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>" . $form->field($aula, '[$index]docente')->textInput(['disabled' => true,]) . "</div>";
                echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>" . $form->field($aula, '[$index]curso')->textInput(['disabled' => true,]) . "</div>";
                echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>" . $form->field($aula, '[$index]seccion')->textInput(['disabled' => true,]) . "</div>";
                echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>" . $form->field($aula, '[$index]ciclo')->textInput(['disabled' => true,]) . "</div>";
            }
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

    </div>
</div>

<style>

</style>