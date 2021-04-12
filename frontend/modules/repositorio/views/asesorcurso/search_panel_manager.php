<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\inter\Module as m;
use common\models\masters\Personas;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use common\models\masters\Facultades;
use common\models\masters\Carreras;
use common\helpers\h;
?>

<div class="panel-manager-search">
    <?php $form = ActiveForm::begin(
        [
            //'action' => ['index-alumnos'],
            'method' => 'get',
            'options' => ['data-pjax' => 1],
        ]
    );
    ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>" . yii::t('base_verbs', 'Search'), ['class' => 'btn btn-primary']) ?>

        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'ap') ?>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'nombres') ?>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'am') ?>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'descripcion') ?>
    </div>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php //$form->field($model, 'carrera_id')->
        //             dropDownList(ComboHelper::getCboCarreras(h::gsetting('general', 'MainFaculty')),
        //                          ['prompt'=>'--'.yii::t('base_verbs','Choose a value')."--",]
        //                         )
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>