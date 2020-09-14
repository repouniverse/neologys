<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use kartik\grid\GridView;
   //use yii\grid\GridView;
    use yii\widgets\Pjax;
    use frontend\modules\inter\Module as m;
    echo \common\widgets\spinnerWidget\spinnerWidget::widget();    
  use kartik\export\ExportMenu;
    $this->title = m::t('labels', 'Inter Summoned');
    $this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Program'), 'url' => ['/inter/programa/update','id'=>$id]];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-convocados-index">
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
        <div class="box-body">
            <?php Pjax::begin();
            
            $gridColumns=[   
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{update}{view}',
                                    'buttons' => 
                                    [
                                        'update' => function($url, $model)
                                                    {
                                                        $options = 
                                                        [
                                                            'title' => m::t('verbs', 'Update'), 
                                                            'data-pjax'=>'0'                                                                            
                                                        ];
                                                        $url=Url::to(['update','id'=>$model->id]);
                                                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options);
                                                    },
                                        'view' => function($url, $model)
                                                  {
                                                        $options = 
                                                        ['title' => m::t('verbs', 'View'),
                                                            'data-pjax'=>'0'  ];
                                                         $url=Url::to(['view','id'=>$model->id]);
                                                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options);
                                                  },
                                        'delete' => function($url, $model)
                                                    {
                                                        $options = 
                                                        [
                                                            'data-confirm' => m::t('validaciones', 'Are you sure you want to activate this user?'),
                                                            'title' => m::t('verbs', 'Delete'),
                                                        ];
                                                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', $url, $options);
                                                    }
                                    ]
                                ],
                              /* [
                            'attribute'=>'imagenx',
                            'format'=>'raw',
                            'value'=>function($model){
                                return Html::img($model->image($model->codalu),
                                        ['width'=>60,'height'=>80,
                                            'class'=>"img-thumbnail cuaizquierdo"
                                            ]);
                            }
                        ], */            
                           /*['attribute'=>'codigo',
                               'value'=>function ($model){
                                 return $model->code();       
                               }
                                   //'header'=>''
                                    //'group'=>true, 
                                     ],*/
                                            
                           [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column)
                               {
                                return GridView::ROW_COLLAPSED;
                               },
                    'detail' => function ($model, $key, $index, $column) 
                                {
                                    return $this->render('_expand_historial', ['model'=>$model,'datos'=>$model->datosExpedientes()]);
                                },
                    'expandOneOnly' => true
                ],
                [
                            'attribute'=>'imagen',
                            'format'=>'raw',
                            'value'=>function($model){
                                return Html::img($model->image($model->codigoalumno),['width'=>60,'height'=>80, 'class'=>"img-thumbnail cuaizquierdo"]);
                            }
                        ],                        
                                        
                   'codigoalumno',  
                    'codesp',
                           ['attribute'=>'descripcion',
                                   //'header'=>''
                                    'group'=>true, 
                                     ],
                              ['attribute'=>'current_etapa',
                                  'format'=>'raw',
                                  'value'=>function($model){
                                      return '<div class="circle-badge">'.$model->current_etapa.'</div>';
                                  },
                                  
                                   //'header'=>'current_stage',
                                   //'group'=>true, 
                                 ],
                                 
                                'ap',
                                'am',                                   
                                'nombres',
                                //'current_etapa',
                                 
                               // 'codigoper',
                                //'documento.desdocu',
                                //'numerodoc',
                                //'codgrupo',
                                //'id',
                                /*'universidad_id',
                                'facultad_id',
                                'depa_id',
                                'modo_id',*/
                            ];
            
            
            ?>
                
                <?php  
                    echo $this->render('_search', ['model' => $searchModel, 'id'=>$id, 'modelPrograma'=>$modelPrograma]);  
                ?>                
                
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <div style='overflow:auto;'>
                    <?=ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
        'batchSize'=>20,
    'dropdownOptions' => [
        'label' => yii::t('base_labels','Export'),
        'class' => 'btn btn-success'
    ]
]) . "<hr>\n".GridView::widget(
                        [
                            'dataProvider' => $dataProvider,
                            //'summary' => '',
                            'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                          //  'filterModel' => $searchModel,
                            'columns' => $gridColumns,
                            
                        ]);
                    ?>
            <?php Pjax::end(); ?>
</div>
        </div>
    </div>
</div> 
 </div>  