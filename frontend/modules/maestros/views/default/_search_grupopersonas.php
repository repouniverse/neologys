<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DocumentosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codocu') ?>

    <?= $form->field($model, 'desdocu') ?>

    <?= $form->field($model, 'clase') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'tabla') ?>

    <?php // echo $form->field($model, 'abreviatura') ?>

    <?php // echo $form->field($model, 'prefijo') ?>

    <?php // echo $form->field($model, 'escomprobante') ?>

    <?php // echo $form->field($model, 'idreportedefault') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
