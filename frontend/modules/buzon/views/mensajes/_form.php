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
<link href="https://fonts.googleapis.com/css2?family=Fraunces&display=swap" rel="stylesheet">

<div class="buzon-mensajes-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-heading">
        <h5>
            <b class="subtitulo">CATEGORIA</b>
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
                    'options'=>[
                        'placeholder' => 'Nombre del Docente'
                    ]

                ],
                [
                    'name'  => 'curso',
                    'title' => 'Curso',
                    'options'=>[
                        'placeholder' => 'Nombre del Curso'
                    ]
                ],
                [
                    'name'  => 'seccion',
                    'title' => 'Sección',
                    'options'=>[
                        'placeholder' => 'Sección'
                    ]
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
                    'options'=>[
                        'placeholder' => 'Nombre del Docente'
                    ]

                ],
                [
                    'name'  => 'curso',
                    'title' => 'Curso',
                    'options'=>[
                        'placeholder' => 'Nombre del Curso'
                    ]

                ],
                [
                    'name'  => 'seccion',
                    'title' => 'Sección',
                    'options'=>[
                        'placeholder' => 'Sección'
                    ]
                ],
                [
                    'name'  => 'ciclo',
                    'title' => 'Ciclo',
                    'options'=>[
                        'placeholder' => 'Ciclo'
                    ]
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
            <b class="subtitulo">MOTIVO</b>
        </h5>
    </div>
    <div class="motivos-body">
        <p class="text-secondary"><i>NOTA: </i>Estimado alumno, este espacio ha sido diseñado para usted. Por favor, ingrese su consulta, duda o queja</p>
        <?= $form->field($model, 'mensaje')->textarea(['rows' => 10, 'placeholder' =>'Ingrese su consulta','required'=>true]) ?>
    </div>
    <div class="personal-body">

        <div class="form-group  text-center boton-submit-content">
                <?= Html::submitButton(Yii::t('base_verbs', 'Send'), ['class' => 'btn btn-info boton-submit']) ?>
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

    /* */
    .subtitulo{
    font-size: 20px;
    font-family: 'Fraunces', serif;
    
}

.boton-submit-content{

padding-bottom: 100px;
display: flex;
justify-content: center;
margin-top: 10px;
}
.boton-submit{
    font-size:20px;
    width:30%;
    height:35px;

}

@media (max-width: 415px){
    .contenedor-form {
    width: 100%;
    margin-left: 0;
    padding: 0 10px;
    }
    body{
        width: 100%;
    }
    .boton-submit-content{
        padding-bottom: 0;
    }
}
</style>