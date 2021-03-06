<?php
use frontend\modules\inter\Module as m;
use yii\helpers\Html;
use common\helpers\h;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\inter\models\InterProgramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
$this->title = m::t('labels', 'Plans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-programa-index">
   
    <h4><?=h::awe('calendar').h::space(10).Html::encode($this->title) ?></h4>
    <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(['id'=>'planPjax','timeout'=>false]); ?>
    <?php // echo $this->render('_search_planes', ['model' => $searchModel]); ?>

    .
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{calendar}',
                'buttons' => [
                    'update' => function ($url,$model) 
                                            {
                                                $url= Url::to
                                                      (
                                                        [
                                                            'modal-edit-plan','id'=>$model->id,'gridName'=>'planPjax',
                                                            'idModal'=>'buscarvalor'
                                                        ]
                                                      );
                                                return Html::a
                                                       (
                                                            '<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>',
                                                            $url, ['class'=>'botonAbre']
                                                       );
                                            },
                          'calendar' => function($url, $model) { 
                                                $url= Url::to
                                                      (
                                                        [
                                                            'view-plan','id'=>$model->id,'gridName'=>'grilla-plan-evaluaciones',
                                                            'idModal'=>'buscarvalor'
                                                        ]
                                                      );
                        $options = [
                            'title' => m::t('verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                        
                    ]
                ],
              [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column)
                               {
                                return GridView::ROW_COLLAPSED;
                               },
                    'detail' => function ($model, $key, $index, $column) 
                                {
                                    return $this->render('_expand_evaluadores', ['model'=>$model]);
                                },
                    'expandOneOnly' => true
                ],                   
               'desdocu',                  
        ['attribute'=>'ordenetapa',
             //'filter'=> \frontend\modules\inter\helpers\ComboHelper::getCboCarreras(),
             
                     'group'=>true,
             ], 
          ['attribute'=>'orden',
             //'filter'=> \frontend\modules\inter\helpers\ComboHelper::getCboCarreras(),
             
                     //'group'=>true,
             ], 
          ['attribute'=>'codesp',
             //'filter'=> \frontend\modules\inter\helpers\ComboHelper::getCboCarreras(),
             
                      //'group'=>true,
             ], 
          ['attribute'=>'ap',
               // 'group'=>true,
             ],
         ['attribute'=>'modo_id',
             'filter'=> \frontend\modules\inter\helpers\ComboHelper::getCboModos(),
            'value'=>function($model){
                     return $model->descrimodo;               
                    },
             'group'=>true,
             ],
          ['attribute'=>'descrietapa',
             
                      //'group'=>true,
             ],
          
            ['attribute'=>'nombredepa',
             //'filter'=> \frontend\modules\inter\helpers\ComboHelper::getCboDepartamentos(),
             
                      //'group'=>true,
             ], 
                                        
           ['attribute'=>'carrera_id',
             'filter'=> \frontend\modules\inter\helpers\ComboHelper::getCboCarreras(),
             'value'=>function($model){
                     return $model->nombrecarrera;               
                    },
                      //'group'=>true,
             ], 
         ['attribute'=>'desdocu',
                //'group'=>true,
             ],
            
         /*['attribute'=>'universidad',
             'value'=>function($model){
                        return $model->universidad->nombre;
             }
             ],*/
         
         

            //'id',
            
            //'codperiodo',
          // 'modo_id',
           //'etapa_id',
            //'clase',
            //'programa_id',
            //'fopen',
            //'descripcion',
            //'detalles:ntext',

          
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
    </div>

       