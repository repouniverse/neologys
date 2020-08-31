<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;

/* @var $this yii\web\View */
/* @var $model common\models\DocumentosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'coddepa') ?>

    <?= $form->field($model, 'nombredepa') ?>

    <?= $form->field($model, 'detalles') ?>

   

    <?php // echo $form->field($model, 'abreviatura') ?>

    <?php // echo $form->field($model, 'prefijo') ?>

    <?php // echo $form->field($model, 'escomprobante') ?>

    <?php // echo $form->field($model, 'idreportedefault') ?>

    <div class="form-group">
        <?= Html::submitButton(m::t('verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(m::t('verbs', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
