<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;
use common\models\masters\Personas;
use common\helpers\ComboHelper as combo;
use common\helpers\h;
?>

<div class="panel_manager_buzon">
    <?php $form = ActiveForm::begin(
        [
            'action' => ['panel-manager-admin'],
            'method' => 'get',
            'options' => ['data-pjax' => 1],
        ]
    );
    ?>  

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>" . yii::t('base_verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
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
            $form->field($model, 'departamento_id')->dropDownList(
                    combo::getCboDepartamentosFacuCodepa(h::gsetting('general', 'MainFaculty'),array('GYT-FCCTP','TUTO-FCCTP','CCOR-FCCTP','COAC-FCCTP','BIBL-FCCTP','SPSI-FCCTP','AUVI-FCCTP','REG-FCCTP')),
                    ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
                )
            ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=
            $form->field($model, 'estado')->dropDownList(
                    combo::getCboEstado(),
                    ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
                )
            ?>
        </div>


       
        <?php ActiveForm::end(); ?>
    </div>