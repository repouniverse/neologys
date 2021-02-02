<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use yii\widgets\Pjax;
use common\helpers\h;
use yii\helpers\Url;




?>

<div class="sigi-unidades-form">

    <?php $form = ActiveForm::begin([
        'id' => 'myformulario',
        'enableClientValidation' => true
    ]); ?>
    <div class="box-header">

        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                    [
                        'idModal' => $idModal,
                        'idForm' => 'myformulario',
                        'url' => Url::to(['/buzon/' . $this->context->id . '/modal-transferir-mensaje', 'id' => $model->id]),
                        'idGrilla' => $gridName,
                        'title' => 'Enviar'
                    ]
                ) ?>
            </div>
        </div>
    </div>


    <div class="box-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4>TRANSFERIR DE DEPARTAMENTO</h4>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'departamento_id')->dropDownList(
                combo::getCboDepartamentosFacuCodepa(h::gsetting('general', 'MainFaculty'), array('GYT-FCCTP', 'TUTO-FCCTP', 'CCOR-FCCTP', 'COAC-FCCTP', 'BIBL-FCCTP', 'SPSI-FCCTP', 'AUVI-FCCTP', 'REG-FCCTP')),
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
            )
            ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>