<?php
    use frontend\modules\maestros\MaestrosModule as m;
    use common\helpers\h;
        use kartik\date\DatePicker;
        use common\helpers\ComboHelper;
        use common\models\masters\Personas;
          use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
             use common\models\masters\Ubigeos;
          use yii\helpers\Url;
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?php ?>
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
        
       
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?= $form->field($modelPersona, 'estcivil')->
                       dropDownList(ComboHelper::getCboEstCivil(),
                                   ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=$form->field($modelPersona, 'tipodoc')->
                      dropDownList(Personas::comboDataField('tipodoc'),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'numerodoc')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'telfijo')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'telmoviles')->textInput(['maxlength' => true]) ?>
        </div>
        
        
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=$form->field($modelPersona, 'pais')->
                      dropDownList(ComboHelper::getCboPaises(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
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
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
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
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
            <?= $form->field($modelPersona, 'distnac')->
                       dropDownList(($modelPersona->isNewRecord)?[]:ComboHelper::getCboDistritos($modelPersona->provnac),
                                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($modelPersona, 'domicilio')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($modelPersona, 'referencia')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
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
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
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
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?= $form->field($modelPersona, 'distdir')->
                       dropDownList(($modelPersona->isNewRecord)?[]:ComboHelper::getCboDistritos($modelPersona->provdir),
                                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
