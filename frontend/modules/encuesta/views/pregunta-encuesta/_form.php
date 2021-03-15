<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaPreguntaEncuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-pregunta-encuesta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_encuesta')->textInput() ?>

    <?= $form->field($model, 'id_tipo_pregunta')->textInput() ?>

    <?= $form->field($model, 'pregunta')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
