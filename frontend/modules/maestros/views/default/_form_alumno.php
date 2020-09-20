<?php
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;  
    use common\models\masters\Personas;
    use common\helpers\ComboHelper;
    use yii\helpers\Html;
     use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use frontend\modules\maestros\MaestrosModule as m;
    use common\helpers\h;
    use kartik\date\DatePicker;
    use common\models\masters\Ubigeos;
    use common\widgets\selectwidget\selectWidget;
     use common\widgets\buttonajaxwidget\buttonAjaxWidget;
     USE yii\widgets\Pjax;
?>

<div class="box box-success">
      <?PHP  echo \common\widgets\spinnerWidget\spinnerWidget::widget();?>
    <div class="box box-body">
        <?php 
            $paisActual = $model->currentPais();
            $paisResidencia = $model->studentPais($model->universidad_id);
            $modelPersona->paisresidencia = $paisResidencia;
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
                 <?= Html::button('<span class="fa fa-check"></span>   '.m::t('labels', 'Register'), ['id'=>'btn-register','class' => 'btn btn-warning']) ?>
                </div>
            </div>
        </div>    
    
        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'universidad_id')->textInput(['disabled'=>true,'value'=>$model->universidad->nombre,'maxlength' => true]) ?>
            <?php /*ComboDep::widget
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
                                        'campofiltro'=>'universidad_id'  
                                    ]
                                  ],
                    ]
               )*/
            ?>
        </div>
        
        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'facultad_id')->textInput(['disabled'=>true,'value'=>$model->facultad->desfac,'maxlength' => true]) ?>
            <?php /*ComboDep::widget
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
               )*/
            ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'carrera_id')->textInput(['disabled'=>true,'value'=>$model->carrera->nombre,'maxlength' => true]) ?>            
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?= $form->field($model, 'codalu')->textInput(['maxlength' => true, 'disabled' => true,]) ?>
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

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Location data'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
         </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?=$form->field($modelPersona, 'paisresidencia')->
                      dropDownList(ComboHelper::getCboPaises(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",'', 'disabled'=>true,])
            ?>
        </div>
    
        <?php
            if (!$model->isExternal())    
            {                
        ?>
    
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> 
            <?= ComboDep::widget(
                [
                    'model'=>$modelPersona,               
                    'form'=>$form,
                    'data'=> ComboHelper::getCboDepartamentos(),
                    'campo'=>'depdir',
                    'idcombodep'=>'personas-provdir',
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
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> 
            <?= ComboDep::widget(
                [
                    'model'=>$modelPersona,               
                    'form'=>$form,
                    'data'=> ($modelPersona->isNewRecord)?[]:ComboHelper::getCboProvincias($modelPersona->depdir),
                    'campo'=>'provdir',
                    'idcombodep'=>'personas-distdir',
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
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">    
            <?= $form->field($modelPersona, 'distdir')->
                       dropDownList(($modelPersona->isNewRecord)?[]:ComboHelper::getCboDistritos($modelPersona->provdir),
                                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
            <?= $form->field($modelPersona, 'domicilio')->textInput(['maxlength' => true]) ?>
        </div>
         <?php  
            }
            else
            {
        ?>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">    
            <?= $form->field($modelPersona, 'lugarresidencia')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
            <?= $form->field($modelPersona, 'domicilio')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?php 
                echo selectWidget::widget
                     (
                        [
                            'model'=>$modelPersona,
                            'form'=>$form,
                            'campo'=>'codcontpaisresid',
                            'ordenCampo'=>8,
                            'addCampos'=>[7,5],
                        ]
                    );                
            ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">    
            <?= $form->field($modelPersona, 'parentcontpaisresid')->textInput(['maxlength' => true]) ?>
        </div>

           
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">    
            <?= $form->field($modelPersona, 'polizaseguroint')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">    
            <?= $form->field($modelPersona, 'telefasistencia')->textInput(['maxlength' => true]) ?>
        </div>   
        
        <?php   
            }
        ?>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Aditional data'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">            
            <?= $form->field($modelPersona, 'cumple',['enableAjaxValidation'=>true])->widget
                       (    
                            DatePicker::class, 
                            [
                                'language' => h::app()->language,
                                'pluginOptions'=>
                                [
                                    'format' => h::gsetting('timeUser', 'date')  , 
                                    'changeMonth'=>true,
                                    'changeYear'=>true,
                                    'yearRange'=>"-99:+0",
                                ],
                                'options'=>['class'=>'form-control']
                            ]
                       )
            ?>
        </div>        

        <div class="col-lg-2 col-md-2 col-sm-2   col-xs-12">    
            <?= $form->field($modelPersona, 'sexo')->
                       dropDownList(ComboHelper::getCboSex(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">    
            <?= $form->field($modelPersona, 'estcivil')->
                       dropDownList(ComboHelper::getCboEstCivil(),
                                   ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?= $form->field($modelPersona, 'telfijo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?= $form->field($modelPersona, 'telmoviles')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($modelPersona, 'alergias')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?= $form->field($modelPersona, 'gruposangu')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'usoregulmedic')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'motivo')->textInput(['maxlength' => true]) ?>
        </div>
          <?php Pjax::begin(['id'=>'america']); Pjax::end();  ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-register',
            'idGrilla'=>'america',
            'ruta'=>Url::to(['/inter/convocados/ajax-register-alu','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?> 