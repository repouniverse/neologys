<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buzon-mensajes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'departamento_id')->textInput() ?>

    <?= $form->field($model, 'mensaje')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prioridad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
