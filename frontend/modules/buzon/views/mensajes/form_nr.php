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
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces&display=swap" rel="stylesheet">
<!-- <?php
        $url = Url::toRoute(['/buzon/mensajes/modal-prueba', 'idModal' => 'buscarvalor']);
        echo  Html::button(yii::t('base_verbs', 'Add Unit'), ['href' => $url, 'title' => yii::t('base_verbs', 'Add Unit'), 'id' => 'btn_unidad', 'class' => 'botonAbre btn btn-warning']);
        ?> -->
<!--FORMULARIO-->

<div class="buzon-mensajes-form">


    <?php $form = ActiveForm::begin(
        [
            'enableClientValidation' => true,
        ]
    ); ?>
    <div class="panel-heading">
        <h5>
            <b class="subtitulo">CATEGORÍA</b>
        </h5>
    </div>


    <!-- DROPDOWN DEL DEPARTAMENTO -->
    <?= $form->field($model, 'departamento_id')->dropDownList(
        combo::getCboDepartamentosFacuCodepa(h::gsetting('general', 'MainFaculty'), array(/*'REG-FCCTP','TUTO-FCCTP','CTAS-FCCTP','COAC-FCCTP',*/'BIBL-FCCTP',/*'SPSI-FCCTP','AUVI-FCCTP',*/'GYT-FCCTP')),
        [
            'prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",
            'id' => "departamento"
        ]
    )
    ?>

    <!-- FORM CORDINACION ACADEMICA -->
    <div class="cerrado" id="formca">
        <h5 class="text-primary text-center sub-form">CORDINACIÓN ACADEMICA</h5>
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
            <h5 class="text-primary text-center sub-form">AULA VIRTUAL</h5>
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
        <b class="subtitulo">MOTIVO</b>
    </h5>
</div>

<div class="motivos-body">
    <p class="text-secondary"><i>NOTA: </i>Estimado alumno, este espacio ha sido diseñado para usted. Por favor, ingrese su consulta, duda o queja.</p>
    <!-- OBTENEMOS EL VALOR DEL MOTIVO -->
    <?= $form->field($model, 'mensaje')->textarea(['rows' => 10, 'placeholder' => 'Ingrese su consulta','required'=>true]) ?>
</div>
<!-- DATOS PERSONALES -->
<div class="personal-heading">
    <h5>
        <b class="subtitulo">DATOS PERSONALES</b>
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
            <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'nombres')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su nombre','id' => "nombres", 'required'=>true]) ?>

            </div>
            <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'ap')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su apellido paterno','id' => "ap", 'required'=>true]) ?>

            </div>
            <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'am')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su apellido materno','id' => "am", 'required'=>true]) ?>

            </div>
            <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'numerodoc')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su dni','id' => "dni", 'required'=>true, 'maxlength' => '8', 'minlength'=>'8']) ?>

            </div>
            <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'email')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su email','id' => "email", 'required'=>true, 'type'=>'email']) ?>

            </div>
            <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'celular')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su celular', 'type' => 'text', 'maxlength' => '9', 'minlength'=>'9']) ?>

            </div>
            <div class="col-sm-12" >
            <?= $form->field($model, 'esc_id')->dropDownList(
                combo::getCboCarreras(h::gsetting('general', 'MainFaculty')),
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",]
            );
            ?> 
            </div>
            
        </div>
    </div>
            </br>
    <div class="personal-body">
        
        <div class="form-group col-sm-12 text-center boton-submit-content">
            <?= Html::submitButton(Yii::t('base_verbs', 'Send'), ['class' => 'btn btn-danger boton-submit ']) ?>
        </div>

            <?php ActiveForm::end(); ?>

    </div>
    <br>
</div>


<?php
/* AGREGANDO JQUERY */
$script = <<< JS
    //todo codigo Jquery o javascript stuffer
    var AULA_VIRTUAL_ID = 158
    var CORDINACION_ACADEMICA = 155
    $('#departamento').change(function(){
    var departamento_elegido = $(this).val();
        $('#formca').hide();
        $('#formau').hide();          
        if(departamento_elegido ==CORDINACION_ACADEMICA){
            //alert('134')
            $('#formca').show();

        }else if(departamento_elegido ==AULA_VIRTUAL_ID){
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
.subtitulo{
    font-size: 17px;
    
    
}
.sub-form{
    font-size: 13px;
}

.glyphicon {
    
    color:white;
    
}
.js-input-plus {
    
    background:#0B5296;
}
.js-input-plus:hover {
    
    background: #093179;
}
.js-input-plus:active {
    
    background: #093179;
}
.js-input-plus:focus {
    
    background: #093179;
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