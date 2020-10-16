<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codocu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desdocu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tabla')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abreviatura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefijo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'escomprobante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idreportedefault')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
