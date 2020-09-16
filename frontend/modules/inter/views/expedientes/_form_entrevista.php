<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use frontend\modules\inter\Module as m;
    use common\helpers\h;
    use kartik\datetime\DateTimePicker;
?>

<div class="box box-success">
    <div class="box box-body">
        <?php
            $identidad=$persona->identidad;
            $form = ActiveForm::begin
                    (
                        [
                            'id' => 'entrevista-form',
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
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'universidad_id')->textInput(['disabled'=>true,'value'=>$model->universidad->nombre,'maxlength' => true]) ?>
            <?= $form->field($model, 'convocado_id')->label(m::t('labels','Full Name'))->textInput(['disabled'=>true,'value'=>$model->convocado->alumno->persona->fullname(),'maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'facultad_id')->textInput(['disabled'=>true,'value'=>$model->facultad->desfac,'maxlength' => true]) ?>            
            <?= $form->field($model, 'modo_id')->textInput(['disabled'=>true,'value'=>$model->modo->descripcion,'maxlength' => true]) ?>            
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'convocado_id')->label(m::t('labels','Race'))->textInput(['disabled'=>true,'value'=>$model->convocado->alumno->carrera->nombre,'maxlength' => true]) ?>            
            <?= $form->field($model, 'etapa_id')->textInput(['disabled'=>true,'value'=>$model->etapa->descripcion,'maxlength' => true]) ?>            
        </div>
        
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?php echo Html::img($identidad->image($identidad->code()),['width'=>140,'height'=>160, 'class'=>"img-thumbnail cuaizquierdo"]);?>
        </div>  
                
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?= $form->field($model, 'codperiodo')->label(m::t('labels','Period'))->textInput(['disabled'=>true,'maxlength' => true]) ?>            
        </div>
        
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">            
            <?php echo $form->field($model, 'fechaprog',['enableAjaxValidation'=>true])->widget(
        DateTimePicker::classname(), [
         'name' => 'fechaprog',
            'language' => h::app()->language,
            'options' => ['placeholder' =>yii::t('sta.labels', '--Seleccione un valor--')],
    //'convertFormat' => true,
                'pluginOptions' => [
                'format' => h::getFormatShowDateTime(),
                //'startDate' => '01-Mar-2014 12:00 AM',
                'todayHighlight' => true
                                ]
                    ]); 
            ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
           <?php echo $form->field($model, 'finicio',['enableAjaxValidation'=>true])->widget(
        DateTimePicker::classname(), [
         'name' => 'finicio',
            'language' => h::app()->language,
            'options' => ['placeholder' =>yii::t('sta.labels', '--Seleccione un valor--')],
    //'convertFormat' => true,
                'pluginOptions' => [
                'format' => h::getFormatShowDateTime(),
                //'startDate' => '01-Mar-2014 12:00 AM',
                'todayHighlight' => true
                                ]
                    ]); 
            ?>          
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?php echo $form->field($model, 'ftermino',['enableAjaxValidation'=>true])->widget(
        DateTimePicker::classname(), [
         'name' => 'ftermino',
            'language' => h::app()->language,
            'options' => ['placeholder' =>yii::t('sta.labels', '--Seleccione un valor--')],
    //'convertFormat' => true,
                'pluginOptions' => [
                'format' => h::getFormatShowDateTime(),
                //'startDate' => '01-Mar-2014 12:00 AM',
                'todayHighlight' => true
                                ]
                    ]); 
            ?>
        </div>
        
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <?= $form->field($model, 'detalles')->textarea(['maxlength' => true]) ?>            
        </div>
        
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <?= $form->field($model, 'detalles_secre')->textarea(['maxlength' => true]) ?>            
        </div>
        
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
            <?= $form->field($model, 'asistio')->checkBox() ?>           
        </div>
        
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">            
            <?= $form->field($model, 'activo')->checkBox() ?>
        </div>
        
        <?php ActiveForm::end(); ?>
    </div>
</div>