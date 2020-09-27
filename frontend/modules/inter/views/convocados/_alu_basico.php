<?php
USE frontend\modules\inter\Module as m;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\h;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Alumnos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumnos-form">
   
    <?php $form = ActiveForm::begin(); ?>
      
      <div class="box-body">
        <?php //print_r($model->attributes);var_dump($model->facultad); die(); ?>

   <div class="box-body"> 
            
           
       
       
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <?php echo Html::img($identidad->image($identidad->code()),['class'=>"img-thumbnail",'height'=>180,'width'=>160]);   ?>
          
      </div>          
       <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
            
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?= $form->field($identidad,$identidad->nameFieldCode())->
                           label(m::t('labels','Code'))->
                           textInput(['disabled'=>true])
                ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                
                <?= $form->field($identidad, 'id')->
                           label(m::t('labels','Person'))->
                           textInput(['value'=>$identidad->fullName(false),'disabled'=>true])
                ?>
            </div>
            
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($identidad, 'universidad_id')->
                           label(m::t('labels','Original University'))->
                           textInput(['value'=>$identidad->universidad->nombre,'disabled'=>true])
                ?>      
            </div>
           
          
           
           
          
      </div>        
              
              
  </div>  
       
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">     
                <?= $form->field($identidad, 'facultad_id')->
                           label(m::t('labels','Faculty'))->
                           textInput(['value'=>$identidad->facultad->desfac,'disabled'=>true])
                ?>
      
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">     
                <?= $form->field($model, 'id')->
                           label(m::t('labels','Profession'))->
                           textInput(['value'=>$identidad->carrera->nombre,'disabled'=>true])
                ?>
      
            </div>  
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'alumno_id')->
                           label(m::t('labels','Address'))->
                           textInput(['value'=>is_null($persona->domicilio)?'':$persona->domicilio,'disabled'=>true])
                ?>
 </div>  
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?= $form->field($identidad, 'mail')->
                           label(m::t('labels','Email'))->
                           textInput(['value'=>$identidad->mailAddress(),'disabled'=>true])
                ?>
 </div>
       
       
       
       
       
       
       
       
       
 
  
      
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
