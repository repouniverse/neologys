<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CarrerasTestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carreras-test-search">

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

    <?= $form->field($model, 'codesp') ?>

    <?= $form->field($model, 'nombre') ?>

    <?php // echo $form->field($model, 'acronimo') ?>

    <?php // echo $form->field($model, 'ciclo') ?>

    <?php // echo $form->field($model, 'detalle') ?>

    <?php // echo $form->field($model, 'esbase') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base_labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
