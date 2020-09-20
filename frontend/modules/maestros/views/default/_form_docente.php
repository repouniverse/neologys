<?php
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use yii\helpers\Url;
    use common\helpers\h;
    use common\models\masters\Personas;
    use common\helpers\ComboHelper;
    use yii\helpers\Html;
    use yii\widgets\Pjax;
    use yii\grid\GridView;
    use yii\widgets\ActiveForm;
      use kartik\tabs\TabsX;
    use kartik\date\DatePicker;
      use common\widgets\inputajaxwidget\inputAjaxWidget;
    use frontend\modules\maestros\MaestrosModule as m;
        use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
             use common\widgets\buttonajaxwidget\buttonAjaxWidget;
    use common\models\masters\Ubigeos;
?>

<div class="box box-success">
    <div id="advertencia_doc"></div>
 <?php echo \common\widgets\spinnerWidget\spinnerWidget::widget();    ?>
    <?php $form = ActiveForm::begin(
                                    [
                                        'id' => 'docentes-form',
                                        'enableAjaxValidation' => true,
                                        'fieldClass' => 'common\components\MyActiveField',
                                    ]
                                   ); 
    ?>
        
    <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
                <?= 
                    ($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])
                ?>  
                 <?= Html::button('<span class="fa fa-check"></span>   '.m::t('labels', 'Register'), ['id'=>'btn-register','class' => 'btn btn-warning']) ?>
               
            </div>
        </div>
    </div>
    
    <div class="box-body">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'codoce')->textInput(['disabled'=>true,'maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?= $form->field($model, 'ap')->textInput() ?>
        </div>
        
        
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
        </div>
        
        
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">  
             <?= $form->field($model, 'universidad_id')->textInput(['disabled'=>true,'value'=>$model->universidad->nombre,'maxlength' => true]) ?>
            <?php /*echo ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ComboHelper::getCboUniversidades(),
                        'campo'=>'universidad_id',
                        'idcombodep'=>'docentes-facultad_id',               
                        'source'=>[\common\models\masters\Facultades::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                    ]
                                  ],
                    ]
               )
            */?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">    
             <?= $form->field($model, 'facultad_id')->textInput(['disabled'=>true,'value'=>$model->facultad->desfac,'maxlength' => true]) ?>
           
        </div>
               
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php 
             ECHO $form->field($model, 'correo')->textInput(['maxlength' => true]);
           
            ?>
            <?PHP /*ECHO $form->field($modelPersona, 'fecingreso')->
=======
            <?php ?>
            <?= $form->field($modelPersona, 'fecingreso')->
>>>>>>> ae56a357f728b70070be2d9da92c6fcc31db5500
                widget(DatePicker::class,
                [
                    'language' => h::app()->language,
                    'pluginOptions'=>
                    [
                        'format' => h::gsetting('timeUser', 'date'),
                        'changeMonth'=>true,
                        'changeYear'=>true,
                        'yearRange'=>'1980:'.date('Y'),
                    ],
                    'options'=>['class'=>'form-control']
                ])*/
            ?>
        </div>
        
        
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?=$form->field($model, 'categoria')->
                      dropDownList(ComboHelper::getCboCategoriaDocente(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            
                     
            
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Location data'); ?></p>
        <hr style="border: 1px dashed #4CAF50;">
                 <?= 
                    ($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$modelPersona])
                ?>  

         </div>
        
       <?php 
       if($model->isExternal()){
          echo  $this->render('_form_docente_externo',['form'=>$form,'modelPersona'=>$modelPersona]);
         
       }ELSE{
           echo $this->render('_form_docente_local',['form'=>$form,'modelPersona'=>$modelPersona]);
       
       }
          ?>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Aditional data'); ?></p>
 
        
   

        <hr style="border: 1px dashed #4CAF50;">
         </div>  
        
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?=$form->field($modelPersona, 'idiomanativo')->
                      dropDownList(\frontend\modules\inter\helpers\ComboHelper::getCboIdiomas(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div> 

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelPersona, 'alergias')->textInput(['maxlength' => true]) ?>
        </div> 
         <div class="col-lg-4 col-md-4 col-sm-6   col-xs-12">    
            <?= $form->field($modelPersona, 'sexo')->
                       dropDownList(ComboHelper::getCboSex(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'pasaporte')->textInput(['maxlength' => true]) ?>
        </div> 
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'gruposangu')->textInput(['maxlength' => true]) ?>
        </div> 
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'polizaseguroint')->textInput(['maxlength' => true]) ?>
        </div> 
       
        

         <?php 
       if(!$model->isExternal()){
         
          ?>      

               

                
        
            <?php echo TabsX::widget
                  (
                    [
                        'position' => TabsX::POS_ABOVE,
                        'bordered'=>true,
                        'align' => TabsX::ALIGN_LEFT,
                        'encodeLabels'=>false,
                        'items' =>
                        [
                            [
                                'label'=>'<i class="fa fa-home"></i> '.m::t('labels','Events'),
                                'content'=> $this->render('_tab_eventos_inter',['model'=>$model,'modelPersona' => $modelPersona,]),
                                'active' => true,
                                'options' => ['id' => 'myveryownID3'],
                            ],
                            [
                                'label'=>'<i class="fa fa-home"></i> '.m::t('labels','Languages'),
                                'content'=> $this->render('_tab_idiomas',['model'=>$model,'modelPersona' => $modelPersona,]),
                               // 'active' => true,
                                'options' => ['id' => 'myvuyuynID3'],
                            ],
                            [
                                'label'=>'<i class="fa fa-home"></i> '.m::t('labels','Publications'),
                                'content'=> $this->render('_tab_publicaciones',['model'=>$model,'modelPersona' => $modelPersona,]),
                               // 'active' => true,
                                'options' => ['id' => 'my4vyuynID3'],
                            ],
                            
                        ],
                    ]
                  );  
            ?> 

        
       <?php  } ?>
        

         </div>     
             
             
        
       
 
    <?php ActiveForm::end(); ?>
     <?php 
            echo inputAjaxWidget::widget([
      'id_input'=>'docentes-numerodoc',
            'tipo'=>'get',
            'evento'=>'change',
      'isHtml'=>true,
            'idGrilla'=>'advertencia_doc',
            'ruta'=>Url::to(['/maestros/default/verify-duplicate-person']),          
           //'posicion'=> \yii\web\View::POS_END           
        
            ]);
           ?>
    <?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-register',
            'idGrilla'=>'america',
            'ruta'=>Url::to(['/inter/convocados/ajax-register-doce','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?>
 </div>