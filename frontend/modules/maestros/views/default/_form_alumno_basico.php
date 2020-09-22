<?php
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use common\models\masters\Personas;
    use common\helpers\ComboHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use frontend\modules\maestros\MaestrosModule as m;
?>

<div class="box box-success">
    <?php 
        $form = ActiveForm::begin
                (
                    [
                        'id' => 'alumnos-form',
                        'enableAjaxValidation' => true,
                        'fieldClass' => 'common\components\MyActiveField',
                    ]
                ); 
    ?>
        
    <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
                <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>       
            </div>
        </div>
    </div>
    
    <div class="box-body">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?= $form->field($model, 'codalu')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">    
            <?= $form->field($model, 'ap')->textInput() ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'am')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">          
            <?= ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ComboHelper::getCboUniversidades(),
                        'campo'=>'universidad_id',
                        'idcombodep'=>'alumnos-facultad_id',               
                        'source'=>[\common\models\masters\Facultades::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  ,
                                        
                                    ]
                                  ],
                    ]
               )
            ?>
        </div>
        
        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">          
            <?= ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ($model->isNewRecord)?[]:ComboHelper::getCboFacultades($model->universidad_id),
                        'campo'=>'facultad_id',
                        'idcombodep'=>'alumnos-carrera_id',               
                        'source'=>[\common\models\masters\Carreras::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'nombre',//columna a mostrar 
                                        'campofiltro'=>'facultad_id' ,
                                        'additionalFilter'=>['esbase'=>'1']
                                    ]
                                  ],
                    ]
               )
            ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">    
            <?= $form->field($model, 'carrera_id')->
                             dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboCarreras($model->facultad_id),
                                                                ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                                         )
            ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?=$form->field($model, 'tipodoc')->
                      dropDownList(Personas::comboDataField('tipodoc'),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?= $form->field($model, 'numerodoc')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>
        </div>
        
    </div>
    <?php ActiveForm::end(); ?>
</div>
