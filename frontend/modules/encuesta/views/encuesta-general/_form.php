<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaEncuestaGeneral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-encuesta-general-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo_encuesta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tipo_usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tipo_encuesta')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_preguntas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_dep_encargado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
