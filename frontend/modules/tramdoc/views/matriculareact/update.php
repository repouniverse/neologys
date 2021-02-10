<?php

use yii\helpers\Html;
use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */

$this->title = Yii::t('base_labels', 'Actualizar Seguimiento', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Matriculareacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>
<div class="matriculareact-update">

    <h4><?= h::awe('pencil') . h::space(10) . Html::encode($this->title) ?></h4>



    <div class="box box-body">
        <div style="width: 100%;">
            <div class="col-lg-5 col-md-6 col-sm-5 col-xs-12" style="box-shadow: 2px 2px 2px 3px rgba(0, 0, 0, 0.1);">
                <h4><?= h::space(10) . Html::encode("Detalles del Alumno") ?></h4>
                <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 d-inline" style="word-wrap: break-word;">
                    <h5><?= Html::label("Modalidad:", null, ["style" => "colordark"]) ?></h5>
                    <h5><?= Html::label("Periodo:", null, ["style" => "colordark"]) ?></h5>
                    <h5><?= Html::label("Escuela:", null, ["style" => "colordark"]) ?></h5>
                    <h5><?= Html::label("Alumno:", null, ["style" => "colordark"]) ?></h5>
                    <h5><?= Html::label("Dni:", null, ["style" => "color:dark"]) ?></h5>
                    <h5><?= Html::label("Celular:", null, ["style" => "color:dark"]) ?></h5>
                    <h5><?= Html::label("Telefono:", null, ["style" => "color:dark"]) ?></h5>
                    <h5><?= Html::label("Email Usmp:", null, ["style" => "color:dark"]) ?></h5>
                    <h5><?= Html::label("Email Personal:", null, ["style" => "color:dark"]) ?></h5>
                </div>

                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12 d-inline" style="word-wrap: break-word;">
                    <h5><?= Html::label("Pre-Grado", null, ["style" => "color:#565656; font-weight:normal"]) ?></h5>
                    <h5><?= Html::label("2021-1", null, ["style" => "color:#565656;font-weight:normal"]) ?></h5>
                    <h5><?= Html::label(h::nombreCarrera($model->carrera_id), null, ["style" => "color:#565656; font-weight:normal"]) ?></h5>
                    <h5><?= Html::label($model->apellido_paterno . " " . $model->apellido_materno . "," . $model->nombres, null, ["style" => "color:#565656;font-weight:normal"]) ?></h5>
                    <h5><?= Html::label($model->dni, null, ["style" => "color:#565656;font-weight:normal"]) ?></h5>
                    <h5><?= Html::label($model->celular, null, ["style" => "color:#565656;font-weight:normal"]) ?></h5>
                    <h5><?= Html::label($model->telefono, null, ["style" => "color:#565656;font-weight:normal"]) ?></h5>
                    <h5><?= Html::label($model->email_usmp, null, ["style" => "color:#565656;font-weight:normal"]) ?></h5>
                    <h5><?= Html::label($model->email_personal, null, ["style" => "color:#565656;font-weight:normal"]) ?></h5>
                </div>
            </div>
            <!-- <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 ">
            </div> -->
            <div class="col-lg-offset-1 col-lg-6 col-md-6 col-sm-6 col-xs-12 d-inline">
                <h4><?= h::space(10) . Html::encode("Actualizar Seguimiento") ?></h4>
                <?= $this->render('_form_update', [
                    'model' => $model,
                    'trabajador' => $trabajador,
                    'file_pago_tram' => $file_pago_tram,
                    'file_record_notas' => $file_record_notas,
                    'file_cursos_apto' => $file_cursos_apto
                ]) ?>
            </div>
            

        </div>

    </div>