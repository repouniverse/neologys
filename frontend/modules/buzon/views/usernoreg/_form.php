<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use common\helpers\h;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonUserNoreg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buzon-user-noreg-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numerodoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bm_id')->textInput(['value' =>'4','maxlength' => true]) ?>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'esc_id')->dropDownList(
                    combo::getCboCarreras(h::gsetting('general', 'MainFaculty')),
                    ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
                )
            ?>
        </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
