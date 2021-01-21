<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;
use common\models\masters\Personas;
use common\helpers\ComboHelper as combo;
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

        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <?=
            $form->field($model, 'departamento_id')->dropDownList(
                    combo::getCboDepartamentosFacu(1),
                    ['prompt' => '--' . yii::t('base_verbs', 'Choose a Value') . "--",]
                )
            ?>
        </div>

       
        <?php ActiveForm::end(); ?>
    </div>