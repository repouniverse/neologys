<?php
//use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use common\helpers\h;
use common\helpers\ComboHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 use kartik\date\DatePicker;
 use common\models\masters\Personas;
  use common\widgets\inputajaxwidget\inputAjaxWidget;
   use frontend\modules\maestros\MaestrosModule as m;
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep; 
/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">
 <div id="advertencia_doc"></div>
    <?php $form = ActiveForm::begin([
    'id' => 'trabajadores-form',
    'enableAjaxValidation' => true,
    'fieldClass' => 'common\components\MyActiveField',
    //'options'=>['enctype' => 'multipart/form-data'],'fieldClass' => '\common\components\MyActiveField'
    ]); ?>
    
    
    <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
             <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
       
            </div>
        </div>
    </div>
    
    
    
    <div class="box-body">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codtra')->textInput(['disabled'=>'disabled','maxlength' => true]) ?>
  </div>
    
    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
             <?php echo ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ComboHelper::getCboUniversidades(),
                        'campo'=>'universidad_id',
                        'idcombodep'=>'trabajadores-facultad_id',
                        'source'=>[\common\models\masters\Facultades::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                    ]
                                  ],
                    ]
               );
            ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?php echo ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ($model->isNewRecord)?[]:ComboHelper::getCboFacultades($model->universidad_id),
                        'campo'=>'facultad_id',
                        'idcombodep'=>'trabajadores-depa_id',               
                        'source'=>[\common\models\masters\Departamentos::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'nombredepa',//columna a mostrar 
                                        'campofiltro'=>'facultad_id'  
                                    ]
                                  ],
                    ]
               );
            ?>
        </div>    
        
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?php echo ComboDep::widget
                (
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ($model->isNewRecord)?[]:ComboHelper::getCboDepartamentosFacu($model->facultad_id),
                        'campo'=>'depa_id',
                        'idcombodep'=>'trabajadores-cargo_id',               
                        'source'=>[\common\models\masters\Cargos::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descargo',//columna a mostrar 
                                        'campofiltro'=>'depa_id'  
                                    ]
                                  ],
                    ]
               );
            ?>
        </div>    
        
        
        
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'cargo_id')->
                      dropDownList(($model->isNewRecord)?[]:
                          ComboHelper::getCboCargos($model->depa_id),
                              ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",'',])
            ?>
        </div>
        
        
        
        
        
        
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    
    <?= $form->field($model, 'ap')->textInput() ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'am')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
   <?=$form->field($model, 'tipodoc')->
            dropDownList(Personas::comboDataField('tipodoc') ,
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
</div>
       
        
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'numerodoc')->textInput(['maxlength' => true]) ?>
    </div>
   
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'fingreso')->widget(DatePicker::class, [
                             'language' => h::app()->language,
                           // 'readonly'=>true,
                          // 'inline'=>true,
                           'pluginOptions'=>[
                                     'format' => h::gsetting('timeUser', 'date')  , 
                                  'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>"-99:+0",
                               ],
                           
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
</div>
    
      
        
        
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?= $form->field($model, 'detalles')->textarea(['rows' => 2]) ?>
</div>
    </div> 
    
    

    
   
    <?php ActiveForm::end(); ?>
    
    <?php 
  echo inputAjaxWidget::widget([
      'id_input'=>'trabajadores-numerodoc',
            'tipo'=>'get',
            'evento'=>'change',
      'isHtml'=>true,
            'idGrilla'=>'advertencia_doc',
            'ruta'=>Url::to(['/maestros/default/verify-duplicate-person']),          
           //'posicion'=> \yii\web\View::POS_END           
        
  ]);
?>
</div>


