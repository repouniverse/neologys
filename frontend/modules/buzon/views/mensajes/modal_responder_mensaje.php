<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\h;
use common\helpers\ComboHelper as combo;
//SE GUARDA EL VALOR DEL MENSAJE RESPUESTA

?>

<div class="sigi-unidades-form">

    <?php $form = ActiveForm::begin([
        'id' => 'myformulario'/*,'enableAjaxValidation'=>true*/
    ]); ?>
    <div class="box-header">

        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                    [
                        'idModal' => $idModal,
                        'idForm' => 'myformulario',
                        'url' => Url::to(['/buzon/' . $this->context->id . '/modal-responder-mensaje', 'id' => $model->id]),
                        'idGrilla' => $gridName,
                        'title' => 'Enviar'
                    ]
                ) ?>
            </div>
        </div>
    </div>


    <div class="box-body">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?=
            $form->field($model, 'estado')->dropDownList(
                combo::getCboEstado(),
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
            )
            ?>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php echo $form->field($model, 'fecha_registro')->textInput(['disabled' => true]);
            ?>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php echo $form->field($model, 'mensaje')->textArea(['disabled' => true,'rows' =>4]);
            ?>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php echo $form->field($model, 'mensaje_de_respuesta')->textArea(['rows' =>4]);
            ?>
        </div>


        <?php ActiveForm::end(); ?>

    </div>
</div>