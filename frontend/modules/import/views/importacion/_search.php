<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\import\ModuleImport as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasivaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="import-cargamasiva-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'insercion') ?>

    <?= $form->field($model, 'escenario') ?>

    <?= $form->field($model, 'lastimport') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'format') ?>

    <?php // echo $form->field($model, 'modelo') ?>

    <div class="form-group">
        <?= Html::submitButton(m::t('labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(m::t('labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
