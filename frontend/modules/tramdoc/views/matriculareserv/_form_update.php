<?php

use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use common\helpers\h;

$items = ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'];
$estados = ['1' => 'PENDIENTE', '2' => 'EN-TRÁMITE', '3' => 'FINALIZADO','4' => 'NO-PROCEDE']
/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */
/* @var $form yii\widgets\ActiveForm */
?>  

<?php
if ($trabajador->depa_id == h::getDepartamendoIdByCoddepa('REG-FCCTP') ||$trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')) {
    ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="col-xs-6" style="padding-left: 0;">
            <h4><?= h::space(10) . Html::encode("Actualizar Alumno") ?></h4>
        </div>
        <div class="col-xs-6">
            <input class="btn btn-primary" id="btnActAlumno" type="button" value="Visualizar datos"></input>
        </div>
        <hr>
    </div>
<?php
}
?>


    
<div class="matriculareact-form-update">

    <?php $form = ActiveForm::begin(); ?>
    
    
    <?php
    //ACTUALIZAR DATOS DEL ALUMNO
    
    if ($trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP') || $trabajador->depa_id == h::getDepartamendoIdByCoddepa('REG-FCCTP') ) {
    ?>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="display: none" id="actAlumno">
            <?php
            echo $form->field($model, 'carrera_id')->dropDownList(
                combo::getCboCarreras(h::gsetting('general', 'MainFaculty')),
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",]
            );

            echo $form->field($model, 'nombres')->textInput();
            echo $form->field($model, 'apellido_paterno')->textInput();
            echo $form->field($model, 'apellido_materno')->textInput();
            echo $form->field($model, 'dni')->textInput();
            echo $form->field($model, 'nro_matr')->textInput();
            echo $form->field($model, 'codigo')->textInput();
            echo $form->field($model, 'celular')->textInput();
            echo $form->field($model, 'telefono')->textInput();
            echo $form->field($model, 'email_usmp')->textInput();
            echo $form->field($model, 'email_personal')->textInput();
           

            ?>
        </div>
    <?php
    }
    ?>
    <div class="col-xs-6 ">
        <h4><?= h::space(10) . Html::encode("Actualizar Seguimiento") ?></h4>
    </div>
    <?php
    //DEPARTAMENDO DE CUENTAS CORRIENTES 

    if ($trabajador->depa_id == h::getDepartamendoIdByCoddepa('CTAS-FCCTP') || $trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')) {
    ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
                echo $form->field($model, 'cta_sin_deuda_pendiente_check')->dropDownList(
                    $items,
                    ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
                );
            echo $form->field($model, 'cta_sin_deuda_pendiente_obs')->textarea(['rows' => 4]);

            echo $form->field($model, 'cta_pago_tramite_check')->dropDownList(
                $items,
                ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
            );

            //aqui va el archivo adjunto 
            echo HTML::label("Adjunto de comprobante de pago");
            echo "<br>";

            $url = Url::toRoute([
                '/finder/selectimage',
                'isImage' => false,
                'idModal' => 'imagemodal',
                'idGrilla' => 'mis_files',
                'modelid' => $file_pago_tram->id,
                'extension' => Json::encode(['pdf']),
                'nombreclase' => str_replace('\\', '_', get_class($file_pago_tram))
            ]);
            $options = [
                'title' => Yii::t('base_labels', 'Upload File'),
                //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                'data-method' => 'get',
                //'data-pjax' => '0',
            ];
            echo Html::button('<span class="glyphicon glyphicon-paperclip"></span> Adjuntar comprobante de pago', ['href' => $url, 'class' => 'botonAbre btn btn-success']);
            if ($file_pago_tram->hasAttachments()) {
                //$url=$model->urlFirstFile;
                echo Html::a('<span class="glyphicon glyphicon-save"></span> Descargar comprobante de pago', $file_pago_tram->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-warning']);
            }

            echo "<br><br>";

            ////////////////////////////
           
            echo $form->field($model, 'cta_pago_tramite_obs')->textarea(['rows' => 4]);
            ?>
        </div>
    <?php
    }
    ?>


    <?php
    //DEPARTAMENDO DE OFICINA DE REGISTROS ACADEMICOS
    if ($trabajador->depa_id == h::getDepartamendoIdByCoddepa('REG-FCCTP') || $trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')) {
    ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            echo $form->field($model, 'ora_soli_reg_check')->dropDownList(
                $items,
                ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
            );

            //aqui va el archivo adjunto 
            echo HTML::label("Adjunto De Solicitud Registrada");
            echo "<br>";
            $url = Url::toRoute([
                '/finder/selectimage',
                'isImage' => false,
                'idModal' => 'imagemodal',
                'idGrilla' => 'mis_files',
                'modelid' => $file_solicitud->id,
                'extension' => Json::encode(['pdf']),
                'nombreclase' => str_replace('\\', '_', get_class($file_solicitud))
            ]);
            $options = [
                'title' => Yii::t('base_labels', 'Upload File'),
                //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                'data-method' => 'get',
                //'data-pjax' => '0',
            ];
            echo Html::button('<span class="glyphicon glyphicon-paperclip"></span> Adjuntar Record de Notas', ['href' => $url, 'class' => 'botonAbre btn btn-success']);
            if ($file_solicitud->hasAttachments()) {
                //$url=$model->urlFirstFile;

                echo Html::a('<span class="glyphicon glyphicon-save"></span> Descargar Record de Notas', $file_solicitud->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-warning']);
            }
            echo "<br><br>";
            echo $form->field($model, 'ora_soli_reg_obs')->textarea(['rows' => 4]);
           
            ////////////////////////////
            echo $form->field($model, 'estado')->dropDownList(
                $estados,
                ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
            );


            echo $form->field($model, 'estado_obs')->textarea(['rows' => 4]);
            ?>
        </div>
    <?php
    }
    ?>


    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
//todo codigo Jquery o javascript stuffer

$('#btnActAlumno').click(function(){
    var estilo = $('#actAlumno').css("display")
    console.log(estilo);
    if( estilo == 'none'){
        $('#actAlumno').css("display","block")
    }
    if( estilo == 'block'){
        $('#actAlumno').css("display","none")
    }
    
});

JS;


$this->registerJs($script);
?>

