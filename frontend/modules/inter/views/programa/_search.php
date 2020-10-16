<?php
use frontend\modules\inter\Module as m;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterProgramaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-programa-search">

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

    <?= $form->field($model, 'codperiodo') ?>

    <?= $form->field($model, 'depa_id') ?>

    <?php // echo $form->field($model, 'clase') ?>

    <?php // echo $form->field($model, 'programa_id') ?>

    <?php // echo $form->field($model, 'fopen') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'detalles') ?>

    <div class="form-group">
        <?= Html::submitButton(m::t('verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(m::t('verbs', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
