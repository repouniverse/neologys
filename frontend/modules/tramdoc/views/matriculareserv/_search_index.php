<?php


use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;
use common\models\masters\Personas;
use common\helpers\ComboHelper as combo;
use common\helpers\h;
use kartik\datetime\DateTimePicker;
$FILTRO = ["SI"=>"SI","NO"=>"NO","NA"=>"NA"] ;
$FILTRO_ESTADO = ["1"=>"PENDIENTE","2"=>"EN-TRAMITE","3"=>"FINALIZADO"] ;
?>

<div class="panel_manager_buzon">
    <?php $form = ActiveForm::begin(
        [
            'action' => ['index'],
            'method' => 'get',
            'options' => ['data-pjax' => 1],
        ]
    );
    ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>" . yii::t('base_verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('base_labels', 'Registrar Solicitud'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'carrera_id')->dropDownList(
                combo::getCboCarreras(h::gsetting('general', 'MainFaculty')),
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
            )
            ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'dni')->textInput()
            ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'codigo')->textInput()
            ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'apellido_paterno')->textInput()
            ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'nombres')->textInput()
            ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?php  //h::settings()->invalidateCache();  
            ?>
            <?= $form->field($model, 'fecha_solicitud')->widget(DatePicker::class, [
                'language' => h::app()->language,
                // 'readonly'=>true,
                // 'inline'=>true,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'yearRange' => "-99:+0",
                ],
                //'dateFormat' => h::getFormatShowDate(),
                'options' => ['autocomplete'=>'off', 'class' => 'form-control']
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'cta_sin_deuda_pendiente_check')->dropDownList(
                $FILTRO,
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
            )
            ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'cta_pago_tramite_check')->dropDownList(
                $FILTRO,
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
            )
            ?>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'ora_soli_reg_check')->dropDownList(
                $FILTRO,
                ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
            )
            ?>
        </div>
        

        <?php ActiveForm::end(); ?>
    </div>