<?php
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use yii\helpers\Url;
    use common\helpers\h;
    use common\models\masters\Personas;
    use common\helpers\ComboHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\date\DatePicker;
    use frontend\modules\maestros\MaestrosModule as m;
    use common\models\masters\Ubigeos;
          use common\widgets\inputajaxwidget\inputAjaxWidget;
?>

<div class="">
    <div id="advertencia_doc"></div>
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
            </div>
        </div>
    </div>
    
    <div class="box-body">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'codoce')->textInput(['maxlength' => true]) ?>
        </div>
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=$form->field($model, 'tipodoc')->
                      dropDownList(Personas::comboDataField('tipodoc'),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'numerodoc')->textInput(['maxlength' => true]) ?>
        </div>
        
        
        
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?= $form->field($model, 'ap')->textInput() ?>
        </div>
        
        <div class="col-lg-4col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'am')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">          
            <?= ComboDep::widget
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
                        'idcombodep'=>'docentes-carrera_base',               
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
            <?= $form->field($model, 'carrera_base')->
                             dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboCarreras($model->facultad_id),
                                                                ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                                         )
            ?>
        </div>
        
        
        
        
       
        
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?=$form->field($model, 'categoria')->
                      dropDownList(ComboHelper::getCboCategoriaDocente(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
        </div>
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
</div>
