<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\TrabajadoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trabajadores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codigoper') ?>

    <?= $form->field($model, 'ap') ?>

    <?= $form->field($model, 'am') ?>

    <?= $form->field($model, 'nombres') ?>

    

    <?php // echo $form->field($model, 'ppt') ?>

    <?php // echo $form->field($model, 'pasaporte') ?>

    <?php // echo $form->field($model, 'codpuesto') ?>

    <?php // echo $form->field($model, 'cumple') ?>

    <?php // echo $form->field($model, 'fecingreso') ?>

    <?php // echo $form->field($model, 'domicilio') ?>

    <?php // echo $form->field($model, 'telfijo') ?>

    <?php // echo $form->field($model, 'telmoviles') ?>

    <?php // echo $form->field($model, 'referencia') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('control.errors', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('control.errors', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
