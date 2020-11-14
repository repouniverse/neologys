<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\inter\helpers\ComboHelper;
use frontend\modules\inter\Module as m;
USE common\helpers\h;

use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
?>

<div class="citas-search">
    <?php $form = ActiveForm::begin(
          [
           // 'action' => ['index','id'=>$id, 'modelPrograma'=>$modelPrograma],
            'method' => 'get',
            'options' => ['data-pjax' => 1],
          ]); 
    ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>".m::t('verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
       
         <?php
          //$url= Url::to(['unique-university','id'=>$profile->id,'gridName'=>'check-multiple','idModal'=>'buscarvalor']);
            echo  Html::button(h::awe('refresh').h::space(10).m::t('verbs','Refresh Stages'), ['href' => '#', 'title' => m::t('verbs','Refresh'),'id'=>'button_refresh_etapa', 'class' => 'btn-warning']); 
           ?> 
          </div>      
    </div>
   
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?php
    $model->facultad_id=$modelPrograma->facultad_id;
    echo ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> \common\helpers\ComboHelper::getCboFacultades(),
               'campo'=>'facultad_id',
               'idcombodep'=>'vwinterconvocadossearch-carrera_id',
                'source'=>[\common\models\masters\Carreras::className()=>
                                [
                                  'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'nombre',//columna a mostrar 
                                        'campofiltro'=>'facultad_id'  
                                ]
                                ],
                            ]
        )  ?>
 </div>   
    
    
    
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'carrera_id')->
                         dropDownList
                         (
                          ComboHelper::getCboCarreras($model->facultad_id), ['prompt'=>'--'.m::t('base.verbs','Choose a value')."--",]
                         )
        ?>
  </div> 
    
    
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ComboHelper::getCboProgramas(),
               'campo'=>'programa_id',
               'idcombodep'=>'vwinterconvocadossearch-modo_id',
                'source'=>[\frontend\modules\inter\models\InterModos::className()=>
                                [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descripcion',//columna a mostrar 
                                        'campofiltro'=>'programa_id'  
                                ]
                          ],
                      ])  ?>
 </div>   
 
   
    
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?php  echo ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> [],
               'campo'=>'modo_id',
               'idcombodep'=>'vwinterconvocadossearch-current_etapa',
                'source'=>[\frontend\modules\inter\models\InterEtapas::className()=>
                                [
                                        'campoclave'=>'orden' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descripcion',//columna a mostrar 
                                        'campofiltro'=>'modo_id'  
                                ]
                                ],
                            ]
        )  ?>
 </div> 
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'current_etapa')->
                         dropDownList
                         (
                           [], ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                         )
        ?>
</div>
    
    <?php 
 /*if(count(h::request()->get()) >0){
  if(array_key_exists('VwInterConvocadosSearch', h::request()->get())){
   if(array_key_exists('carrera_id', h::request()->get()['VwInterConvocadosSearch'])){
   $carrera_id=h::request()->get()['VwInterConvocadosSearch']['carrera_id'];
   $facultad_id=h::request()->get()['VwInterConvocadosSearch']['facultad_id'];  
         }else{
    $carrera_id=null;
   $facultad_id=null; 
      }
  }else{
     $carrera_id=null;
   $facultad_id=null;  
  }
 }else{
  $carrera_id=null;
   $facultad_id=null;     
 }*/
 ?>
    
    
    
    
  
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'estado')->
                         dropDownList
                         (
                         \frontend\modules\inter\helpers\ComboHelper::getCboStatusConvocado(), ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                         )
        ?>
    </div>
    
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'univorigen_id')->
                         dropDownList
                         (
                           common\helpers\ComboHelper::getcboUniversidadesFiltradas(), ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                         )
        ?>
</div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'codigoalumno') ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'nombres') ?>
    </div> 
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'ap') ?>
    </div> 
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'am') ?>
    </div> 
    <?php ActiveForm::end(); ?>
</div>
