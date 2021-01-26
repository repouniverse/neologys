<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use yii\widgets\Pjax;
use common\helpers\h;
use yii\helpers\Url;



/** */
/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */
/* @var $form yii\widgets\ActiveForm */

?>
<!-- <?php
        $url = Url::toRoute(['/buzon/mensajes/modal-prueba', 'idModal' => 'buscarvalor']);
        echo  Html::button(yii::t('base_verbs', 'Add Unit'), ['href' => $url, 'title' => yii::t('base_verbs', 'Add Unit'), 'id' => 'btn_unidad', 'class' => 'botonAbre btn btn-warning']);
        ?> -->
<!--FORMULARIO-->
<div class="buzon-mensajes-form">


    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-heading">
        <h5>
            <b>CATEGORIA</b>
        </h5>
    </div>


    <!-- DROPDOWN DEL DEPARTAMENTO -->
    <?= $form->field($model, 'departamento_id')->dropDownList(
        combo::getCboDepartamentosFacuCodepa(h::gsetting('general', 'MainFaculty'), array('OTI-FCCTP', 'REG-FCCTP')),
        [
            'prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",
            'id' => "departamento"
        ]
    )
    ?>

    <!-- FORM CORDINACION ACADEMICA -->
    <div class="cerrado" id="formca">
        <h5 class="text-primary">CORDINACION ACADEMICA</h5>
        <!-- FORM CORDINACION ACADEMICA -->
        <?= $form->field($model, 'cordi')->widget(MultipleInput::className(), [
            'min' => 1,
            'max' => 4,
            'columns' => [
                [
                    'name'  => 'docente',
                    'title' => 'Docente',
                    
                ],
                [
                    'name'  => 'curso',
                    'title' => 'Curso',
                    
                ],
                [
                    'name'  => 'seccion',
                    'title' => 'Sección',
                ]
            ]

        ])->label(false);
        ?>
    </div>
    <!-- FORM AULA VIRTUAL -->
    <div class="cerrado" id="formau">
            <h5 class="text-primary">AULA VIRTUAL</h5>
        <?= $form->field($model, 'aula')->widget(MultipleInput::className(), [
            'min' => 1,
            'max' => 4,
            'columns' => [
                [
                    'name'  => 'docente',
                    'title' => 'Docente',
                    'placeholder' => 'Ingrese docente'
                    
                ],
                [
                    'name'  => 'curso',
                    'title' => 'Curso',
                    'placeholder' => 'Ingrese curso'
                ],
                [
                    'name'  => 'seccion',
                    'title' => 'Sección',
                    'placeholder' => 'Ingrese seccion'
                ],
                [
                    'name'  => 'ciclo',
                    'title' => 'Ciclo',
                    'placeholder' => 'Ingrese ciclo'
                ]
            ],

        ])->label(false);
        ?>
    </div>

</div>
<style>
    .divborder {
        border: 1px;
        border-color: coral;
    }

    .cerrado {
        display: none;

    }

    .abierto {
        display: block;
    }
</style>
<!-- ESCRIBIR EL MOTIVO -->

<br>
<div class="panel-heading">
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

<!-- <div>
        <?php

        $url = Url::toRoute(['/buzon/mensajes/modal-prueba']);
        echo Html::a('<span class="btn btn-info glyphicon  glyphicon-eye-open"></span>', $url, ['class' => 'botonAbre']);

        ?>
    </div> -->
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
    <div class="personal-body">

        <div class="form-group">
            <?= Html::submitButton(Yii::t('base_verbs', 'Send'), ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <br>
</div>


<?php
/* AGREGANDO JQUERY */
$script = <<< JS
    //todo codigo Jquery o javascript stuffer
    $('#departamento').change(function(){
    var departamento_elegido = $(this).val();
        $('#formca').hide();
        $('#formau').hide();          
        if(departamento_elegido ==134){
            //alert('134')
            $('#formca').show();

        }else if(departamento_elegido ==128){
            $('#formau').show();
            //alert('128')
        }else{
            //alert('nignguno')
        }
    });
    
    
    
JS;
$this->registerJs($script);


?>

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


    /*diseño del modal*/
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 50%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    /* The Close Button */
    .close {
        color: red;
        float: right;
        font-size: 40px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        background-color: #f2f2f2;
        color: black;
        padding: 0 10px;
        margin: 0;
    }

    .modal-body {
        padding: 2px 16px;
    }

    .modal-footer {
        padding: 2px 16px;
        background-color: #f2f2f2;
        color: black;
    }


    /*tabla dentro del modal*/

    .boton-eliminar {
        background-color: "blue";

    }
</style>