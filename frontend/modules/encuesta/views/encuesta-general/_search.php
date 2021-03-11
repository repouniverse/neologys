<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaEncuestaGeneralSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-encuesta-general-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo_encuesta') ?>

    <?= $form->field($model, 'id_tipo_usuario') ?>

    <?= $form->field($model, 'id_tipo_encuesta') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'numero_preguntas') ?>

    <?php // echo $form->field($model, 'id_dep_encargado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
