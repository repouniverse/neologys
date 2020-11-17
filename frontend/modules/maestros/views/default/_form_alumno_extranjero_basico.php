<?php
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use common\models\masters\Personas;
    use common\helpers\ComboHelper;
    use yii\helpers\Html;
        use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use frontend\modules\maestros\MaestrosModule as m;
    use common\widgets\buttonajaxwidget\buttonAjaxWidget;
    use yii\widgets\Pjax;
     
?>

<div class="box box-success">
    <?php 
    echo \common\widgets\spinnerWidget\spinnerWidget::widget();
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
             <?PHP 
             if(!$model->isNewRecord)
             ECHO Html::button('<span class="fa fa-check"></span>   '.m::t('verbs', 'Register'), ['id'=>'btn-register','class' => 'btn btn-warning']) ?>
                   
            </div>
        </div>
    </div>
    <?php Pjax::begin(['id'=>'america']); Pjax::end();  ?>
    <div class="box-body">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'codalu')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
            <?= $form->field($model, 'ap')->textInput() ?>
        </div>
        
       
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">          
            <?= ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                         'data'=> ComboHelper::getCboUniversidadesFiltradas(),
                        'campo'=>'universidad_id',
                        'idcombodep'=>'alumnos-facultad_id',               
                        'source'=>[\common\models\masters\Facultades::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                    ]
                                  ],
                    ]
               )
            ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">          
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
                                        'campofiltro'=>'facultad_id'  
                                    ]
                                  ],
                    ]
               )
            ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
            <?= $form->field($model, 'carrera_id')->
                             dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboCarreras($model->facultad_id),
                                                                ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                                         )
            ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?=$form->field($model, 'tipodoc')->
                      dropDownList(Personas::comboDataField('tipodoc'),['prompt'=>'--'.m::t('verbs','Choose a value')."--",])
            ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'numerodoc')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">          
            <?= ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ComboHelper::getCboUniversidades(),
                        'campo'=>'unidest_id',
                        'idcombodep'=>'alumnos-facudest_id',               
                        'source'=>[\common\models\masters\Facultades::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                    ]
                                  ],
                    ]
               )
            ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">          
            <?= ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ($model->isNewRecord)?[]:ComboHelper::getCboFacultades($model->unidest_id),
                        'campo'=>'facudest_id',
                        'idcombodep'=>'alumnos-carreradest_id',               
                        'source'=>[\common\models\masters\Carreras::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'nombre',//columna a mostrar 
                                        'campofiltro'=>'facultad_id'  
                                    ]
                                  ],
                    ]
               )
            ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
            <?= $form->field($model, 'carreradest_id')->
                             dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboCarreras($model->facudest_id),
                                                                ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                                         )
            ?>
        </div>
        
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-register',
            'idGrilla'=>'america',
            'ruta'=>Url::to(['/inter/convocados/ajax-register-alu','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?>   
