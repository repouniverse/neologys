<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acad-syllabus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'plan_id') ?>

    <?= $form->field($model, 'codperiodo') ?>

    <?= $form->field($model, 'curso_id') ?>

    <?= $form->field($model, 'n_horasindep') ?>

    <?php // echo $form->field($model, 'docente_owner_id') ?>

    <?php // echo $form->field($model, 'datos_generales') ?>

    <?php // echo $form->field($model, 'sumilla') ?>

    <?php // echo $form->field($model, 'competencias') ?>

    <?php // echo $form->field($model, 'prog_contenidos') ?>

    <?php // echo $form->field($model, 'estrat_metod') ?>

    <?php // echo $form->field($model, 'recursos_didac') ?>

    <?php // echo $form->field($model, 'formula_id') ?>

    <?php // echo $form->field($model, 'fuentes_info') ?>

    <?php // echo $form->field($model, 'reserva1') ?>

    <?php // echo $form->field($model, 'reserva2') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base_labels', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
