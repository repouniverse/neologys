<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use yii\widgets\Pjax;
//use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\Module as m;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
  /// use kartik\datetime\DateTimePicker;
//use common\widgets\buttonajaxwidget\buttonAjaxWidget;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-success">
<?=    \common\widgets\spinnerWidget\spinnerWidget::widget();?>
    <div class="box-body">

        <h4><?=$model->expediente->documento->desdocu?></h4>
   <?php
   Pjax::begin(['id'=>'migrilla']);Pjax::end();
    //$identidad=$persona->identidad;
   $form = ActiveForm::begin(['id'=>'form-pico',
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php  //$url= Url::to(['create-horario','id'=>$model->id,'gridName'=>'grilla-rangos','idModal'=>'buscarvalor']);
             Pjax::begin(['id'=>'pjaxAsistencia','timeout'=>false]);
         ?>
        <div class="col-md-12">
            <div class="form-group no-margin">
           <?php
            echo  Html::button('<span class="glyphicon glyphicon-check"></span>'.h::space(10).m::t('labels','I solved this'), ['href' => '#', 'title' => m::t('labels','I solved this'),'id'=>'btn-expe', 'class' => 'btn-success']); 
            ?>
      
            </div>
        </div>
        <?php  Pjax::end();  ?>
        
        <br><br>
        
        
        
    </div>
   
      
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'expediente_id')->label(m::t('labels','File'))->textInput(['disabled'=>true,'value'=>$model->expediente->documento->desdocu,'maxlength' => true]) ?>            
            <?php //echo $form->field($model, 'etapa_id')->textInput(['disabled'=>true,'value'=>$model->etapa->descripcion,'maxlength' => true]) ?>            
        </div>        
                
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'detalles')->textarea(['disabled'=>true]) ?>            
        </div>
        
        
        
   

    <?php ActiveForm::end(); ?>

</div>
</div>
<?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-expe',
            'idGrilla'=>'migrilla',
            'ruta'=>Url::to(['/inter/expedientes/ajax-subsana-obs','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]
       
   );   ?> 
