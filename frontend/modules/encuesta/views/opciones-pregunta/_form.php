<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaOpcionesPregunta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-opciones-pregunta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pregunta')->textInput() ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
