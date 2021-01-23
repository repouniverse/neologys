<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonAdministradores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buzon-administradores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'persona_id')->textInput() ?>

    <?= $form->field($model, 'departamento_id')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
