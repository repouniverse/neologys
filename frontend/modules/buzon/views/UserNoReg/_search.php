<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\UserNoRegSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-no-reg-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'ap') ?>

    <?= $form->field($model, 'am') ?>

    <?= $form->field($model, 'dni') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'celular') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base_labels', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
