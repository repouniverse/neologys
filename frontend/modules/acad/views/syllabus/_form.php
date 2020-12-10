<?php
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\helpers\h;
use common\widgets\selectwidget\selectWidget;
//use yii\grid\GridView;
use frontend\modules\acad\models\AcadSyllabusUnidades;
use frontend\modules\acad\models\AcadSyllabusCompetencias;
use yii\data\ActiveDataProvider;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use common\widgets\inputajaxwidget\inputAjaxWidget;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
       <div class="col-md-12">
            <div class="form-group no-margin">
            <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        
    
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'plan_id')->textInput(['value'=>$model->plan->plan->descripcion,'disabled'=>true]) ?>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'codperiodo')->textInput(['value'=>$model->plan->plan->codperiodo,'disabled'=>true]) ?>
</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
    <?= $form->field($model, 'n_horasindep')->textInput() ?>
</div>

 
    
 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
    <?= $form->field($model, 'curso_id')->textInput(['value'=>$model->plan->codcursocorto,'disabled'=>true]) ?>
</div>   
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'curso_id')->textInput(['value'=>$model->plan->curso->descripcion,'disabled'=>true]) ?>
</div> 

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'docente_owner_id')->textInput(['value'=>$model->docenteOwner->fullName(),'disabled'=>true]) ?>
</div>
    
    

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'sumilla')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'basic'
        ]);
   ?>
 </div>
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php 
        //echo $model->id; 
        //$identidad_syllabus=$model->id;
         $id_pjax_docentes= 'grid_docentes';
        $url= Url::to(['modal-add-teacher','id'=>$model->id,'gridName'=>$id_pjax_docentes,'idModal'=>'buscarvalor']);
        echo  Html::button(yii::t('base_verbs','Add teacher'), ['href' => $url, 'title' => yii::t('base_verbs','Add teacher'),'id'=>'btn_teacher', 'class' => 'botonAbre btn btn-success']); 
        
        
       
        Pjax::begin(['id'=>$id_pjax_docentes,'timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> frontend\modules\acad\models\AcadSyllabusDocentes::find()->
                select(['id','docente_id','activo'])->andWhere(['syllabus_id'=>$model->id])
        ]),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
               ['attribute'=>'docente_id',
                   'value'=>function($model){
                    return $model->docente->fullName();
                   }
                   ],
            ['class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{edit}{delete}{contenido}',
               'buttons' => [                    
                    'delete' => function ($url,$model){                   
                            $url = Url::toRoute(['/acad/syllabus/ajax-delete-unidad','id'=>$model->id]);
                              return Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                             }, 
                    ]
                ],
        ],
    ]); ?>
        
    <?php Pjax::end(); ?>

        
    </div>   
    
    
    
    
    
    
    
    
    
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php 
        //echo $model->id; 
        $identidad_syllabus=$model->id;
         $id_pjax_sumilla= 'grid_sumilla';
        $url= Url::to(['modal-crear-unidad','id'=>$model->id,'gridName'=>$id_pjax_sumilla,'idModal'=>'buscarvalor']);
        echo  Html::button(yii::t('base_verbs','Add unit'), ['href' => $url, 'title' => yii::t('base_verbs','Add unit'),'id'=>'btn_unidad', 'class' => 'botonAbre btn btn-success']); 
        
        
       
        Pjax::begin(['id'=>'grid_sumilla','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> AcadSyllabusUnidades::find()->
                select(['id','descripcion','capacidad'])->andWhere(['syllabus_id'=>$model->id])
        ]),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                                },
                     'detailUrl' =>Url::toRoute(['/acad/syllabus/ajax-show-content']),
                    //'headerOptions' => ['class' => 'kartik-sheet-style'], 
                    'expandOneOnly' => true
            ],  
            
            
                'descripcion',
               ['attribute'=>'capacidad',
                   'format'=>'html',
                   ],
            ['class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{edit}{delete}{contenido}',
               'buttons' => [                    
                    'delete' => function ($url,$model){                   
                            $url = Url::toRoute(['/acad/syllabus/ajax-delete-unidad','id'=>$model->id]);
                              return Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                             },                    
                        
                     'edit' => function ($url,$model)use($id_pjax_sumilla){                   
                            $url = Url::toRoute(['/acad/syllabus/modal-editar-unidad','id'=>$model->id,'gridName'=>$id_pjax_sumilla,'idModal'=>'buscarvalor']);
                              return Html::a('<span class="btn btn-info glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                             }, 
                                     
                    'contenido' => function ($url,$model){                   
                            $url = Url::toRoute(['/acad/syllabus/ajax-generate-content','id'=>$model->id]);
                              return Html::a('<span class="btn btn-info glyphicon glyphicon-equalizer"></span>','javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                             }, 
                    ]
                ],
        ],
    ]); ?>

     <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgru54dgd5',
            'idGrilla'=>'grid_sumilla',
        //'otherContainers'=>['pajaxn_ui_segu'],
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>   
        
        
        
    <?php Pjax::end(); ?>

        
    </div>   
    
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   
       <?php Pjax::begin(['id'=>'grid_competencias_pjax','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> AcadSyllabusCompetencias::find()->
                select(['id','bloque','bloque_padre','item_bloque','contenido_bloque'])->andWhere(['syllabus_id'=>$model->id])
        ]),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'bloque',
            'item_bloque',
              [
            'class' => 'kartik\grid\EditableColumn',
            'editableOptions'=>[
                            'pjaxContainerId'=>'grid_competencias_pjax',
                            //'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                          'data'=> ['Competencias'=>'Competencias','Componentes'=>'Componentes'],  
                                            ],
            'attribute' => 'bloque_padre',
           // 'pageSummary' => 'Total',
            'vAlign' => 'left',
            'width' => '100px',
            'readonly' => false,
           //'data'=>['modelo'=>'mimodelo']
            
         ],
            
            [
            'class' => 'kartik\grid\EditableColumn',
            'editableOptions'=>[
                            'pjaxContainerId'=>'grid_competencias_pjax',
                            //'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                          'data'=> ['1'=>yii::t('base_labels','Enabled'),'0'=>yii::t('base_labels','Disabled')],  
                                            ],
            'attribute' => 'activo',
            'value'=>function($model){
                  return ($model->activo)?yii::t('base_labels','Enabled'):yii::t('base_labels','Disabled');
               },
           // 'pageSummary' => 'Total',
            'vAlign' => 'left',
            'width' => '100px',
            'readonly' => false,
           //'data'=>['modelo'=>'mimodelo']
            
         ],
            
               [
                   'attribute'=>'contenido_bloque',
                   
                   'format'=>'html',
                   ],
            ['class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{edit}{visible}',
               'buttons' => [                    
                                     
                        
                     'edit' => function ($url,$model){                   
                            $url = Url::toRoute(['/acad/syllabus/modal-editar-compe','id'=>$model->id,'gridName'=>'grid_competencias_pjax','idModal'=>'buscarvalor']);
                              return Html::a('<span class="btn btn-info glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                             }, 
                    /* 'visible' => function ($url,$model){   
                              $icon=($model->activo)?'glyphicon glyphicon-eye-open':'glyphicon glyphicon-eye-close';
                           // $url = Url::toRoute(['/acad/syllabus/modal-editar-compe','id'=>$model->id,'gridName'=>'grid_competencias_pjax','idModal'=>'buscarvalor']);
                              return Html::a('<span class="btn btn-warning '.$icon.'"></span>', $url, ['class'=>'']);
                             }, */
                    ]
                ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
 </div>
  
 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
    <?= $form->field($model, 'n_sesiones_semana')->textInput([]) ?>
 </div> 
    
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
    <button id="boton-contenido" type="button" class="btn btn-success btn-lg">
         <span class="glyphicon glyphicon-refresh"></span><?=yii::t('base_labels','Generate content')?>
    </button>
 </div> 
    
    
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'formula_id')->textInput() ?>
</div>
   

 <?php
 echo inputAjaxWidget::widget([
      'ruta'=>Url::to(['ajax-genera-contenido','id'=>$model->id]),
        'tipo'=>'POST',
        'id'=>"boton-contenido",//Es el id DOM del que invoca
        'evento'=>'click',
        //'isHtml'=>true,
        'idGrilla'=>'sin_nombre',
        
 ]);
 ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'estrat_metod')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'basic'
        ]);
   ?>
 </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'recursos_didac')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'basic'
        ]);
   ?>
 </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'fuentes_info')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'basic'
        ]);
   ?>
 </div>
    
    
    

    <?php ActiveForm::end(); ?>

</div>
