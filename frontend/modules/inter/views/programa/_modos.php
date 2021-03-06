<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use frontend\modules\inter\Module as m;
    use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
    use yii\widgets\Pjax;
    use kartik\grid\GridView;
?>
<?php Pjax::begin(['id'=>'grilla-modos']); ?>
<?= GridView::widget
    (   
        [
            'id'=>'mi-grillhfhfha',
            'dataProvider' => new \yii\data\ActiveDataProvider
            (
                [
                    'query'=> frontend\modules\inter\models\InterModos::find()->andWhere(['programa_id'=>$model->id])
                ]
            ),
            'columns' => 
            [
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}{update}',
                    'buttons' => 
                    [                   
                        'update' => function ($url,$model) 
                        {
                            $url= Url::to(['modal-edit-modo','id'=>$model->id,'gridName'=>'grilla-modos','idModal'=>'buscarvalor']);                             
                            return Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                        },                          
                        'delete' => function ($url,$model)
                        {
                            $url = Url::toRoute($this->context->id.'/ajax-detach-psico',['id'=>$model->id]);
                            return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,'family'=>'holas','id'=> \yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),]);
                        }
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
                                    return $this->render('_expand_modo_plan', ['model'=>$model]);
                                },
                    'expandOneOnly' => true
                ],
                'descripcion',
            ],
        ]
    );
?>

<?php 
    echo linkAjaxGridWidget::widget
    (
        [
            'idGrilla'=>'grilla-modos',
            'family'=>'holas',
            'type'=>'POST',
            'evento'=>'click',
            'posicion'=> \yii\web\View::POS_END
        ]
    ); 
?>

<p>
    <?php 
        $url= Url::to(['modal-new-modo','id'=>$model->id,'gridName'=>'grilla-modos','idModal'=>'buscarvalor']);            
        echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
    ?>
</p>
<?php Pjax::end(); ?>
