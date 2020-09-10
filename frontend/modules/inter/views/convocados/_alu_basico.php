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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($model, 'universidad_id')->
                           label(m::t('labels','University'))->
                           textInput(['value'=>$model->universidad->nombre,'disabled'=>true])
                ?>      
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">     
                <?= $form->field($model, 'facultad_id')->
                           label(m::t('labels','Faculty'))->
                           textInput(['value'=>$model->facultad->desfac,'disabled'=>true])
                ?>
      
            </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">     
                <?= $form->field($model, 'id')->
                           label(m::t('labels','Profession'))->
                           textInput(['value'=>$identidad->carrera->nombre,'disabled'=>true])
                ?>
      
            </div>
          
          
       
         
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  
                        <?= $form->field($model, 'id_alumno')->
                           label(m::t('labels','Full Name'))->
                           textInput(['value'=>$persona->fullName(),'disabled'=>true])
                ?>
                 

                    
                            
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <?php echo Html::img($identidad->image($identidad->code()),['width'=>60,'height'=>80, 'class'=>"img-thumbnail cuaizquierdo"]);?>
              </div>
               
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                           <?php  //h::settings()->invalidateCache();  ?>
                      
                           </div>
 
  
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'alumno_id')->
                           label(m::t('labels','Address'))->
                           textInput(['value'=>is_null($persona->domicilio)?'':$persona->domicilio,'disabled'=>true])
                ?>
 </div>
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
