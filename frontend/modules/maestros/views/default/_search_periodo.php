<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\PeriodosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="periodos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codperiodo') ?>

    <?= $form->field($model, 'periodo') ?>

    <?= $form->field($model, 'activa') ?>

    <div class="form-group">
        <?= Html::submitButton(m::t('verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(m::t('verbs', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
