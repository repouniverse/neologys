<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\masters\InterExpedientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-expedientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'universidad_id') ?>

    <?= $form->field($model, 'facultad_id') ?>

    <?= $form->field($model, 'depa_id') ?>

    <?= $form->field($model, 'programa_id') ?>

    <?php // echo $form->field($model, 'modo_id') ?>

    <?php // echo $form->field($model, 'convocado_id') ?>

    <?php // echo $form->field($model, 'clase') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'codocu') ?>

    <?php // echo $form->field($model, 'fpresenta') ?>

    <?php // echo $form->field($model, 'fdocu') ?>

    <?php // echo $form->field($model, 'detalles') ?>

    <?php // echo $form->field($model, 'textointerno') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'requerido') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base_labels', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
