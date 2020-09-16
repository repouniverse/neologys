<?php
use frontend\modules\inter\Module as m;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-expedientes-form">
    <div class="box-body">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">                
                <?= Html::submitButton('<span class="fa fa-save"></span>   '.m::t('labels', 'Save'), ['class' => 'btn btn-success']) ?>
           </div>
        </div>
    </div>
    
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h4><?=$model->documento->desdocu?></h4>
          </div>
          
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <?php echo Html::img($identidad->image($identidad->code()),['class'=>"img-thumbnail"]);   ?>
          
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">     
                <?= $form->field($identidad, 'facultad_id')->
                           label(m::t('labels','Faculty'))->
                           textInput(['value'=>$identidad->facultad->desfac,'disabled'=>true])
                ?>
      
            </div>
           
           
           
          
      </div>        
              
              
  </div>       
          
  
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
