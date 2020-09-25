<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\report\models\ReporteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reporte-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'xgeneral') ?>

    <?= $form->field($model, 'ygeneral') ?>

    <?= $form->field($model, 'xlogo') ?>

    <?= $form->field($model, 'ylogo') ?>

    <?php // echo $form->field($model, 'codocu') ?>

    <?php // echo $form->field($model, 'codcen') ?>

    <?php // echo $form->field($model, 'modelo') ?>

    <?php // echo $form->field($model, 'nombrereporte') ?>

    <?php // echo $form->field($model, 'detalle') ?>

    <?php // echo $form->field($model, 'campofiltro') ?>

    <?php // echo $form->field($model, 'tamanopapel') ?>

    <?php // echo $form->field($model, 'x_grilla') ?>

    <?php // echo $form->field($model, 'y_grilla') ?>

    <?php // echo $form->field($model, 'registrosporpagina') ?>

    <?php // echo $form->field($model, 'tienepie') ?>

    <?php // echo $form->field($model, 'tienelogo') ?>

    <?php // echo $form->field($model, 'xresumen') ?>

    <?php // echo $form->field($model, 'yresumen') ?>

    <?php // echo $form->field($model, 'comercial') ?>

    <?php // echo $form->field($model, 'tienecabecera') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('report.messages', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('report.messages', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
