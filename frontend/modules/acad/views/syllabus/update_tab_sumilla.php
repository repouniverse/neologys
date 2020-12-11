<?php
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
//use common\helpers\ComboHelper;
use common\helpers\h;
//use common\widgets\selectwidget\selectWidget;
//use yii\grid\GridView;
use frontend\modules\acad\models\AcadSyllabusUnidades;
use frontend\modules\acad\models\AcadSyllabusCompetencias;
use yii\data\ActiveDataProvider;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use common\widgets\inputajaxwidget\inputAjaxWidget;
use yii\widgets\Pjax;
?>

<div class="box-body">

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
  
    
       


    
    
    
    


</div>