<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaTipoEncuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-tipo-encuesta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
