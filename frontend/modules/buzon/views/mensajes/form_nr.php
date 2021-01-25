<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use yii\widgets\Pjax;
use common\helpers\h;

/** */
/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="buzon-mensajes-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-heading">
        <h5>
            <b>CATEGORIA</b>
        </h5>
    </div>
    <!-- DROPDOWN DEL DEPARTAMENTO -->
    <?= $form->field($model, 'departamento_id'/*["enableAjaxValidation"=>true]*/)->dropDownList(
        combo::getCboDepartamentosFacuCodepa(h::gsetting('general', 'MainFaculty'), array('OTI-FCCTP', 'REG-FCCTP')),
        [
            'prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",
            'id' => "departamento"
        ]
    )
    ?>

    <!-- ESCRIBIR EL MOTIVO -->
    <div class="panel-heading" style="margin-top: 0;">
        <h5>
            <b>MOTIVO</b>
        </h5>
    </div>
    <div class="motivos-body">
        <p class="text-secondary">Estimado alumno, este espacio ha sido diseñado para usted. Por favor, ingrese su consulta, duda o queja</p>
        <!-- OBTENEMOS EL VALOR DEL MOTIVO -->
        <?= $form->field($model, 'mensaje')->textarea(['rows' => 10, 'placeholder' => 'Ingrese su consulta']) ?>
    </div>
    <!-- DATOS PERSONALES -->
    <div class="personal-heading">
        <h5>
            <b>DATOS PERSONALES</b>
        </h5>
    </div>
    <div class="personal-body">
        <div class="form-group">
            <!-- DROPDOWN DE LA CARRERA -->
            <div class="form-group">
                <?= $form->field($model, 'esc_id')->dropDownList(
                    combo::getCboCarreras(h::gsetting('general', 'MainFaculty')),
                    ['prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",]
                )
                ?>
                <?= $form->field($model, 'nombres')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su nombre']) ?>
                <?= $form->field($model, 'ap')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su apellido paterno']) ?>
                <?= $form->field($model, 'am')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su apellido materno']) ?>
                <?= $form->field($model, 'numerodoc')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su dni']) ?>
                <?= $form->field($model, 'email')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su email']) ?>
                <?= $form->field($model, 'celular')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su celular']) ?>


            </div>
        </div>
        <BR></BR>
        <?= Html::submitButton(Yii::t('base_verbs', 'Send'), ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
        <br></br>
        <br>
    </div>
    
    <!-- AGREGANDO JQUERY -->
    <?php
    $script = <<< JS
    //todo codigo Jquery o javascript stuffer
    $('#departamento').change(function(){
        var departamento_elegido = $(this).val();
        alert(departamento_elegido);
        
           
        
    });     
    

    JS;
    $this->registerJs($script);
    ?>
    <!-- FIN JQUERY -->

    <style>
        .panel-heading {
            color: #333;
            background-color: #f5f5f5;

            padding: 10px 15px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            margin-top: -20px;
        }

        .categorias-body {
            padding: 15px;
            width: 100%;
            height: 250px;
            border-left: 1px solid #D0D3D4;
            border-right: 1px solid #D0D3D4;
            border-bottom: 1px solid #D0D3D4;
            border-top: none;
        }

        .personal-heading {
            color: #333;
            background-color: #f5f5f5;

            padding: 10px 15px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            margin-top: -20px;
        }


        .color-rojo {
            color: red
        }

        p {
            padding: 2px;
        }

        .contenedor-form {
            width: 60%;

            margin-left: 20%;
        }
    </style>