<?php
use frontend\modules\inter\Module as m;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\h;
use yii\widgets\Pjax;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
?>
 

<?php $form = ActiveForm::begin([
   // 'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      
       
           
       
    
    
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <h4><?=h::awe('id-card').h::space(10).$model->documento->desdocu?></h4>
          </div>
          <?php  $gridName='grillapk';
                   Pjax::begin(['id'=>$gridName,'timeout'=>false]);  ?>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group no-margin"> 
                   
                  <?php 
                   
                     ?>
                    <?php if(!$model->estado){ ?>
                    <?= Html::button('<span class="fa fa-check"></span>   '.m::t('labels', 'Aprobed'), ['id'=>'btn-exp','class' => 'btn btn-warning']) ?>
                    <?php }else{ ?> 
                    <i style="font-size:19px;color:green;"><?=h::awe('check-circle')?></i><?= Html::button('<span class="fa fa-minus-circle"></span>   '.m::t('labels', 'Unaprobe'), ['id'=>'btn-exp-dis','class' => 'btn btn-danger']) ?>
                     
                    <?php } ?> 
                   
                </div>
          </div>
      <?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-exp',
            'idGrilla'=>$gridName,
            'ruta'=>Url::to(['/inter/convocados/ajax-aprove-expediente','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?>   

<?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-exp-dis',
            'idGrilla'=>$gridName,
            'ruta'=>Url::to(['/inter/convocados/ajax-disapbrobe-expediente','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?>   
<?php Pjax::end();  ?>
<BR>  .
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Stage and order'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">     
                <?= $form->field($model, 'orden')->
                           label(m::t('labels','Order Stage'))->
                           textInput(['disabled'=>true])
                ?>
      
    </div> 
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">     
                <?= $form->field($model, 'etapa_id')->
                           label(m::t('labels','Stage'))->
                           textInput(['value'=>$model->etapa->descripcion,'disabled'=>true])
                ?>
      
    </div>  

<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">     
                <?= $form->field($model, 'plan_id')->
                           label(m::t('labels','Plan'))->
                           textInput(['value'=>$model->plan->descripcion,'disabled'=>true])
                ?>
      
    </div>  
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Evaluator'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
</div>
 <?php $evaluadorPerson=$model->plan->eval->trabajador;  ?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">     
                <?= $form->field($model, 'plan_id')->
                           label(m::t('labels','Evaluator'))->
                           textInput(['value'=>$evaluadorPerson->fullName(),'disabled'=>true])
                ?>
      
    </div> 
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">     
                <?= $form->field($model, 'depa_id')->
                           label(m::t('labels','Departament'))->
                           textInput(['value'=>$model->plan->eval->depa->nombredepa,'disabled'=>true])
                ?>
      
    </div> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Person'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
</div>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">     
                <?= $form->field($identidad, 'facultad_id')->
                           label(m::t('labels','Faculty'))->
                           textInput(['value'=>$identidad->facultad->desfac,'disabled'=>true])
                ?>
      
            </div>
           
           
           
          
      </div>        
              
              
  </div>   
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','File'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group no-margin"> 
                     <?= Html::submitButton('<span class="fa fa-save"></span>'.m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
                
                </div>
          </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalles')->
                           textArea([])
      ?>
</div>
 <?php ActiveForm::end(); ?>
    


      
   
 