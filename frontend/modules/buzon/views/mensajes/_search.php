<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buzon-mensajes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'departamento_id') ?>

    <?= $form->field($model, 'mensaje') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'prioridad') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
