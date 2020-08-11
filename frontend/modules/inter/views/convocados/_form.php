<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-convocados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'universidad_id')->textInput() ?>

    <?= $form->field($model, 'facultad_id')->textInput() ?>

    <?= $form->field($model, 'depa_id')->textInput() ?>

    <?= $form->field($model, 'modo_id')->textInput() ?>

    <?= $form->field($model, 'codperiodo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codocu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'programa_id')->textInput() ?>

    <?= $form->field($model, 'clase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secuencia')->textInput() ?>

    <?= $form->field($model, 'alumno_id')->textInput() ?>

    <?= $form->field($model, 'docente_id')->textInput() ?>

    <?= $form->field($model, 'persona_id')->textInput() ?>

    <?= $form->field($model, 'identidad_id')->textInput() ?>

    <?= $form->field($model, 'codalu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
