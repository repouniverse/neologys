<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocadosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-convocados-search">

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

    <?= $form->field($model, 'modo_id') ?>

    <?php // echo $form->field($model, 'codperiodo') ?>

    <?php // echo $form->field($model, 'codocu') ?>

    <?php // echo $form->field($model, 'programa_id') ?>

    <?php // echo $form->field($model, 'clase') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'secuencia') ?>

    <?php // echo $form->field($model, 'alumno_id') ?>

    <?php // echo $form->field($model, 'docente_id') ?>

    <?php // echo $form->field($model, 'persona_id') ?>

    <?php // echo $form->field($model, 'identidad_id') ?>

    <?php // echo $form->field($model, 'codalu') ?>

    <?php // echo $form->field($model, 'codigo1') ?>

    <?php // echo $form->field($model, 'codigo2') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base_labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
