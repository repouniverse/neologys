<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;

$items = ['SI' => 'SI', 'NO' => 'NO', 'NA' => 'NA'];
/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matriculareact-form-update">

    <?php $form = ActiveForm::begin(); ?>


    <?=
    $form->field($model, 'cta_sin_deuda_pendiente_check')->dropDownList(
        $items,
        ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
    )
    ?>

    <?= $form->field($model, 'cta_sin_deuda_pendiente_obs')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'cta_pago_tramite_check')->dropDownList(
        $items,
        ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
    )
    ?>


    <?= $form->field($model, 'cta_pago_tramite_adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cta_pago_tramite_obs')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'ora_record_notas_check')->dropDownList(
        $items,
        ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
    )
    ?>



    <?= $form->field($model, 'ora_record_notas_adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ora_record_notas_obs')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'aca_cursos_aptos_check')->dropDownList(
        $items,
        ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
    )
    ?>



    <?= $form->field($model, 'aca_cursos_aptos_adjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aca_cursos_aptos_observaciones')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'ora_cursos_aptos_check')->dropDownList(
        $items,
        ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
    )
    ?>



    <?= $form->field($model, 'ora_cursos_aptos_obs')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'oti_cursos_aptos_check')->dropDownList(
        $items,
        ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
    )
    ?>


    <?= $form->field($model, 'oti_cursos_aptos_obs')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'oti_notifica_email_check')->dropDownList(
        $items,
        ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
    )
    ?>

    <?= $form->field($model, 'oti_notifica_email_obs')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>