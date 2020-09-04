<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use frontend\modules\inter\Module as m;
    use yii\helpers\Url;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
    use common\helpers\h;
    use kartik\date\DatePicker;
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use common\helpers\ComboHelper;
    use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
?>
<div class="inter-convocados-form">
    <br>
        <?php $form = ActiveForm::begin(
                      [
                        'id'=>'biForm',
                        'fieldClass'=>'\common\components\MyActiveField',
                      ]); ?>
        <div class="box-header">
            <div class="col-md-12">
                <div class="form-group no-margin">                
                    <?= Html::submitButton('<span class="fa fa-save"></span>'.m::t('verbs', 'Save'), ['class' => 'btn btn-warning']) ?>
                </div>
            </div>
        </div>
        <div class="box-body"> 
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($model, 'descripcion')->
                           //label(m::t('labels','University'))->
                           textInput(['disabled'=>true])
                ?>      
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?= $form->field($model, 'universidad_id')->
                           label(m::t('labels','University'))->
                           textInput(['value'=>$model->universidad->nombre,'disabled'=>true])
                ?>      
            </div>
           
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">     
                <?= $form->field($model, 'facultad_id')->
                           label(m::t('labels','Faculty'))->
                           textInput(['value'=>$model->facultad->desfac,'disabled'=>true])
                ?>
      
            </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
                <?= $form->field($model, 'depa_id')->
                           label(m::t('labels','Departament'))->
                           textInput(['value'=>$model->depa->nombredepa,'disabled'=>true])
                ?>      
            </div> 
           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
                <?= $form->field($model, 'eval_id')->
                           label(m::t('labels','Evaluator'))->
                           textInput(['value'=>$model->eval->descripcion,'disabled'=>true])
                ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
                <?= $form->field($model, 'eval_id')->
                           label(m::t('labels','Profession'))->
                           textInput(['value'=>$model->eval->carrera->nombre,'disabled'=>true])
                ?>
            </div>
            
           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
                <?= $form->field($model, 'modo_id')->
                           label(m::t('labels','Mode'))->
                           textInput(['value'=>$model->modo->descripcion,'disabled'=>true])
                ?>      
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
                <?= $form->field($model, 'finicio')->
                           label(m::t('labels','Start Date'))->
                           textInput(['disabled'=>true])
                ?>      
                  
            </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
                <?= $form->field($model, 'finicio')->
                           label(m::t('labels','Start Date'))->
                           textInput(['disabled'=>true])
                ?>      
                  
            </div>
        <?php ActiveForm::end(); ?>    
  <?php
 $url= Url::to(['create-horario','id'=>$model->id,'gridName'=>'grilla-rangos','idModal'=>'buscarvalor']);
   echo  Html::button(m::t('base.verbs','Agregar Rango'), ['href' => $url, 'title' => m::t('labels','Agregar Tutor'),'id'=>'btn_crear_rangos', 'class' => 'botonAbre btn btn-success']); 
?> 
            
        <br>


    <?php Pjax::begin(['id'=>'grilla-rangos','timeout'=>false]); ?>
   
    <?php 
     echo GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(
                [
                    'query'=> frontend\modules\inter\models\InterHorarios::find()->
                                andWhere(['plan_id'=>$model->id]),
                ]
                ),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{edit}',
                'buttons' => [
                   
                         'edit' => function ($url,$model) {
			    $url= Url::to(['edit-horario','id'=>$model->id,'gridName'=>'grilla-rangos','idModal'=>'buscarvalor']);
                             //echo  Html::button(m::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => m::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            }
                    ]
                ],
            'dia',
             [
                 'attribute'=>'nombredia',
                 'format'=>'raw',
                    'value' => function ($model, $key, $index, $column) {
                        $formato=($model->activo)?'  <i style="color:#3ead05;font-size:12px"><span class="glyphicon glyphicon-ok"></span></i>':
                        '  <i style="color:red;font-size:12px"><span class="glyphicon glyphicon-remove"></span></i>';
                        return $model->nombredia.$formato;
                        },
                 
                 ],
             'tolerancia',
            /*[
                'attribute'=>'psico',
                'header'=>'Psicólogo',
                 'value'=>function($model){
                   if(!empty($model->codtra)){
                       return $model->trabajadores->fullName();
                   }else{
                      return  ''; 
                   }
                   
                        
                 }
            ],  */               
            'hinicio',
             'hfin',
          
        ],
    ]); ?>
    <?php Pjax::end(); ?>


  
       
  
       
        </div>    
</div>
