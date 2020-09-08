 <?php 
 use yii\helpers\Url;
 use yii\helpers\Html;
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
 use yii\widgets\Pjax;
 use yii\grid\GridView;
     use frontend\modules\maestros\MaestrosModule as m;
 ?>

                 
             
             
             
             
                <?php
                $gridName='OpcionesUnivfdfdersidad';
                
                Pjax::begin(['id'=>$gridName]);
                /*ECHO \common\models\masters\PersonaEventosInter::find()->
                                   andWhere(['persona_id'=>$modelPersona->id])->createCommand()->rawSql; */
                ?>          
                    <?= GridView::widget(
                        [
                            'id'=>'migrillfdfdfaxteterer',
                            'dataProvider' => new \yii\data\ActiveDataProvider(
                                              [
                                                  'query'=> \common\models\masters\PersonaIdiomas::find()->
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
                                                        $url= Url::to(['modal-edit-persona-idioma','id'=>$model->id,
                                                                       'gridName'=>$gridName,'idModal'=>'buscarvalor','title' => m::t('base_labels','Add Language')]);
                                                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options);
                                                    },                          
                                        'delete' => function($url, $model)
                                                    { 
                                                        $url=Url::to(['delete-persona-idioma','id'=>$model->id]);
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
                                    'attribute'=>m::t('labels','Languaje'),
                                    'value'=> function($model)
                                              {
                                                return frontend\modules\inter\helpers\ComboHelper::getIdioma($model->idioma);
                                              }
                                ], 
                                [   
                                    'attribute'=>m::t('labels','Skill'),
                                    'format'=>'raw',
                                    'value'=> function($model)
                                              {
                                                return $model->comboValueField('codnivel');                
                                              }
                                ], 
            
                            ],
                        ]); 
                    ?>       
                    <?php 
                        echo linkAjaxGridWidget::widget(
                             [
                                'id'=>'sererdsds',
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
                        
                        $url= Url::to(['modal-new-persona-idioma','id'=>$model->id,
                                             'gridName'=>$gridName,'idModal'=>'buscarvalor']);
                              echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>',
                                           $url, ['class'=>'botonAbre','title'=>m::t('labels','Add Language Skill')]);
                        ?>

