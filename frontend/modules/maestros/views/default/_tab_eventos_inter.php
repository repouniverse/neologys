 <?php 
 use yii\helpers\Url;
 use yii\helpers\Html;
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
 use yii\widgets\Pjax;
 use yii\grid\GridView;
     use frontend\modules\maestros\MaestrosModule as m;
 ?>

                 
             
             
             
             
                <?php
                $gridName='OpcionesUniversidad';
                
                Pjax::begin(['id'=>$gridName]);
                /*ECHO \common\models\masters\PersonaEventosInter::find()->
                                   andWhere(['persona_id'=>$modelPersona->id])->createCommand()->rawSql; */
                ?>          
                    <?= GridView::widget(
                        [
                            'id'=>'migrillax',
                            'dataProvider' => new \yii\data\ActiveDataProvider(
                                              [
                                                  'query'=> \common\models\masters\PersonaEventosInter::find()->
                                                             andWhere(['persona_id'=>$modelPersona->id])
                                              ]),
                            'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                            'columns' =>
                            [
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{update}{delete}',
                                    'buttons' =>
                                    [
                                        'update' => function ($url, $model) use($gridName)
                                                    {
                                                        $options = 
                                                        [
                                                            'title' => m::t('verbs', 'Update'),  
                                                            'data-pjax'=>'0',
                                                            'class'=>'botonAbre'
                                                        ];
                                                        $url= Url::to(['modal-edit-evento-inter','id'=>$model->id,
                                                                       'gridName'=>$gridName,'idModal'=>'buscarvalor','title' => m::t('base_labels','Agregar Unidad')]);
                                                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options);
                                                    },                          
                                        'delete' => function($url, $model)
                                                    { 
                                                        $url=Url::to(['delete-evento-inter','id'=>$model->id]);
                                                        $options = 
                                                        [
                                                            'family'=>'holas',
                                                            'id'=>$model->id,
                                                            'title' =>$url
                                                        ];
                                                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', '#', $options/*$options*/);
                                                    }
                                    ]
                                ],
                                [
                                    'attribute'=>'nombre',
                                    'value'=> function($model)
                                              {
                                                return $model->nombre;
                                              }
                                ], 
                                [
                                    'attribute'=>m::t('labels','Flag'),
                                    'format'=>'raw',
                                    'value'=> function($model)
                                              {
                                                $codpais= strtolower($model->persona->identidad->universidad->codpais);
                                                return Html::img('@web/img/flags/32/'.$codpais.'.png');
                                              }
                                ], 
                                [
                                    'attribute'=>m::t('labels','Country'),
                                    'format'=>'raw',
                                    'value'=> function($model)
                                              {
                                              return $model->pais;
                                                }
                                ], 
                                'ciudad',
                            ],
                        ]); 
                    ?>       
                    <?php 
                        echo linkAjaxGridWidget::widget(
                             [
                                'id'=>'sdsds',
                                'idGrilla'=>$gridName,
                                'family'=>'holas',
                                'type'=>'POST',
                                'evento'=>'click',
                                'posicion'=> \yii\web\View::POS_END           
                             ]); 
                    ?>
                <?php Pjax::end(); ?>      

                    <p>
                        <?php 
                        
                        $url= Url::to(['modal-new-evento-inter','id'=>$model->id,
                                             'gridName'=>$gridName,'idModal'=>'buscarvalor']);
                              echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>',
                                           $url, ['class'=>'botonAbre']);
                        ?>

