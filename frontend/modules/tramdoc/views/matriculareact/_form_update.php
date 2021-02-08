<?php

use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use common\helpers\h;

$items = ['SI' => 'SI', 'NO' => 'NO', 'NA' => 'NA'];
/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matriculareact-form-update">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    //DEPARTAMENDO DE CUENTAS CORRIENTES 
    if (/*$trabajador->depa_id == h::getDepartamendoIdByCoddepa('CTAS-FCCTP') ||*/ $trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')) {

        echo $form->field($model, 'cta_sin_deuda_pendiente_check')->dropDownList(
            $items,
            ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
        );
        echo $form->field($model, 'cta_sin_deuda_pendiente_obs')->textarea(['rows' => 6]);

        echo $form->field($model, 'cta_pago_tramite_check')->dropDownList(
            $items,
            ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
        );

        //aqui va el archivo adjunto 
        echo HTML::label("Pago trámite adjunto");

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
        echo Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'class' => 'botonAbre btn btn-block btn-success']);
        if ($file_pago_tram->hasAttachments()) {
            //$url=$model->urlFirstFile;

            echo Html::a('<span class="glyphicon glyphicon-save"></span>', $file_pago_tram->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-warning btn-block']);
        }

        echo "<br><br>";

        ////////////////////////////

        echo $form->field($model, 'cta_pago_tramite_obs')->textarea(['rows' => 6]);
    }
    ?>


    <?php
    //DEPARTAMENDO DE OFICINA DE REGISTROS ACADEMICOS
    if ($trabajador->depa_id == h::getDepartamendoIdByCoddepa('REG-FCCTP') || $trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')) {

        echo $form->field($model, 'ora_record_notas_check')->dropDownList(
            $items,
            ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
        );

        //aqui va el archivo adjunto 
        echo HTML::label("Record de notas adjunto");
        $url = Url::toRoute([
            '/finder/selectimage',
            'isImage' => false,
            'idModal' => 'imagemodal',
            'idGrilla' => 'mis_files',
            'modelid' => $file_record_notas->id,
            'extension' => Json::encode(['pdf']),
            'nombreclase' => str_replace('\\', '_', get_class($file_record_notas))
        ]);
        $options = [
            'title' => Yii::t('base_labels', 'Upload File'),
            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
            'data-method' => 'get',
            //'data-pjax' => '0',
        ];
        echo Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'class' => 'botonAbre btn btn-block btn-success']);
        if ($file_record_notas->hasAttachments()) {
            //$url=$model->urlFirstFile;

            echo Html::a('<span class="glyphicon glyphicon-save"></span>', $file_record_notas->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-warning btn-block']);
        }

        echo "<br><br>";
        ////////////////////////////

        echo $form->field($model, 'ora_record_notas_obs')->textarea(['rows' => 6]);
    }
    ?>

    <?php
    //DEPARTAMENTO ACADEMICO
    if (/*$trabajador->depa_id == h::getDepartamendoIdByCoddepa('ACA-FCCTP')  || */$trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')) {

        echo $form->field($model, 'aca_cursos_aptos_check')->dropDownList(
            $items,
            ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
        );


        //aqui va el archivo adjunto 
        echo HTML::label("Cursos aptos adjunto:");
        $url = Url::toRoute([
            '/finder/selectimage',
            'isImage' => false,
            'idModal' => 'imagemodal',
            'idGrilla' => 'mis_files',
            'modelid' => $file_cursos_apto->id,
            'extension' => Json::encode(['pdf']),
            'nombreclase' => str_replace('\\', '_', get_class($file_cursos_apto))
        ]);
        $options = [
            'title' => Yii::t('base_labels', 'Upload File'),
            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
            'data-method' => 'get',
            //'data-pjax' => '0',
        ];
        echo Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'class' => 'botonAbre btn btn-block btn-success']);
        if ($file_cursos_apto->hasAttachments()) {
            //$url=$model->urlFirstFile;
            echo Html::a('<span class="glyphicon glyphicon-save"></span>', $file_cursos_apto->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-warning btn-block']);
        }

        echo "<br><br>";
        ////////////////////////////

        echo $form->field($model, 'aca_cursos_aptos_observaciones')->textarea(['rows' => 6]);
    }
    ?>

    <?php
    //OFICINA DE REGISTROS ACADEMICOS
    if ($trabajador->depa_id == h::getDepartamendoIdByCoddepa('REG-FCCTP')  || $trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')) {

        echo $form->field($model, 'ora_cursos_aptos_check')->dropDownList(
            $items,
            ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
        );

        echo $form->field($model, 'ora_cursos_aptos_obs')->textarea(['rows' => 6]);
    }
    ?>

    <?php
    //OTI
    if ($trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')) {

        echo $form->field($model, 'oti_cursos_aptos_check')->dropDownList(
            $items,
            ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
        );

        echo $form->field($model, 'oti_cursos_aptos_obs')->textarea(['rows' => 6]);

        echo $form->field($model, 'oti_notifica_email_check')->dropDownList(
            $items,
            ['prompt' => '--' . yii::t('base_verbs', 'Elige un valor') . "--",]
        );

        echo $form->field($model, 'oti_notifica_email_obs')->textarea(['rows' => 6]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>