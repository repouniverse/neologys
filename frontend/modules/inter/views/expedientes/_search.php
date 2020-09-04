<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-expedientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'universidad_id') ?>

    <?= $form->field($model, 'facultad_id') ?>

    <?= $form->field($model, 'depa_id') ?>

    <?= $form->field($model, 'programa_id') ?>

    <?php // echo $form->field($model, 'modo_id') ?>

    <?php // echo $form->field($model, 'convocado_id') ?>

    <?php // echo $form->field($model, 'clase') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'codocu') ?>

    <?php // echo $form->field($model, 'fpresenta') ?>

    <?php // echo $form->field($model, 'fdocu') ?>

    <?php // echo $form->field($model, 'detalles') ?>

    <?php // echo $form->field($model, 'textointerno') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'requerido') ?>

    <?php // echo $form->field($model, 'plan_id') ?>

    <?php // echo $form->field($model, 'orden') ?>

    <?php // echo $form->field($model, 'etapa_id') ?>

    <?php // echo $form->field($model, 'secuencia') ?>

    <?php // echo $form->field($model, 'current_etapa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
