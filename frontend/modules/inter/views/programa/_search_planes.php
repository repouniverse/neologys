<?php
use frontend\modules\inter\Module as m;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterProgramaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-programa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> 
            <?= ComboDep::widget(
                [
                    'model'=>$modelPersona,               
                    'form'=>$form,
                    'data'=> ComboHelper::getCboDepartamentos(),
                    'campo'=>'depnac',
                    'idcombodep'=>'personas-provnac',
                    'source'=>
                    [   
                        Ubigeos::className()=>
                        [
                            'campoclave'=>'codprov' , //columna clave del modelo ; se almacena en el value del option del select 
                            'camporef'=>'provincia',//columna a mostrar 
                            'campofiltro'=>'coddepa'  
                        ]
                    ],
                ])
            ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
            <?= ComboDep::widget(
                [
                    'model'=>$modelPersona,               
                    'form'=>$form,
                    'data'=> ($modelPersona->isNewRecord)?[]:ComboHelper::getCboProvincias($modelPersona->depnac),
                    'campo'=>'provnac',
                    'idcombodep'=>'personas-distnac',
                    'source'=>
                    [
                        Ubigeos::className()=>
                        [
                            'campoclave'=>'coddist' , //columna clave del modelo ; se almacena en el value del option del select 
                            'camporef'=>'distrito',//columna a mostrar 
                            'campofiltro'=>'codprov'  
                        ]
                    ],
                ])
            ?>
        </div> 
    
    
    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'universidad_id') ?>

    <?= $form->field($model, 'facultad_id') ?>

    <?= $form->field($model, 'codperiodo') ?>

    <?= $form->field($model, 'depa_id') ?>

    <?php // echo $form->field($model, 'clase') ?>

    <?php // echo $form->field($model, 'programa_id') ?>

    <?php // echo $form->field($model, 'fopen') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'detalles') ?>

    <div class="form-group">
        <?= Html::submitButton(m::t('base.labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(m::t('base.labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
