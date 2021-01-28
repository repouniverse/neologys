<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use yii\widgets\Pjax;
use common\helpers\h;

/** */
/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */
/* @var $form yii\widgets\ActiveForm */

//=var_dump($model->departamento_id);die();
?>


<div class="buzon-mensajes-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-heading">
        <h5>
            <b>CATEGORIA</b>
        </h5>
    </div>

    <?= $form->field($model, 'departamento_id')->dropDownList(
        combo::getCboDepartamentosFacuCodepa(h::gsetting('general', 'MainFaculty'), array('OTI-FCCTP', 'REG-FCCTP')),
        [
            'prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",
            'id' => "departamento"
        ]

    ) ?>
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

                ],
                [
                    'name'  => 'curso',
                    'title' => 'Curso',

                ],
                [
                    'name'  => 'seccion',
                    'title' => 'Sección',

                ],
                [
                    'name'  => 'ciclo',
                    'title' => 'Ciclo',

                ]
            ],

        ])->label(false);
        ?>
    </div>

    <!-- STYLE CERRADO ABIERTO FORMS -->
    <style>
        .cerrado {
            display: none;

        }

        .abierto {
            display: block;
        }
    </style>
    <!-- END STYLE CERRADO ABIERTO FORMS -->

    <?php

    ?>
    <div class="panel-heading" style="margin-top: 0;">
        <h5>
            <b>MOTIVO</b>
        </h5>
    </div>
    <div class="motivos-body">
        <p class="text-secondary">Estimado alumno, este espacio ha sido diseñado para usted. Por favor, ingrese su consulta, duda o queja</p>
        <?= $form->field($model, 'mensaje')->textarea(['rows' => 10, 'placeholder' => 'Ingrese su consulta']) ?>
    </div>
    <div class="personal-body">

        <div class="form-group">
            <?= Html::submitButton(Yii::t('base_verbs', 'Send'), ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
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