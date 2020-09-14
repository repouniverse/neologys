<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use frontend\modules\maestros\MaestrosModule as m;
    use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
    use common\widgets\buttonajaxwidget\buttonAjaxWidget;
    use common\models\masters\Cargos;
    use yii\widgets\Pjax;
    use kartik\grid\GridView;
?>
<?php 
$gridName='grilla-cargos';
Pjax::begin(['id'=>'PJAX-GENERAL','timeout'=>false]); ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="small-box bg-teal-gradient">
            <div class="inner">
                <h3>
                    <?php 
                        echo "hii";
                    ?>
                </h3>
                <p><?=m::t('labels','Convened Students')?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-users"></i></span>
            </div>
            <?php 
                $url=Url::to(['cantidades-en-riesgo']);
                echo Html::a(m::t('labels','Convene').'<i class="fa fa-arrow-circle-right"></i>','#', ['id'=>'enlaceconv_'.$model->id,'class'=>"small-box-footer"]);
            ?>
            
        </div>
        
        <?php 
            echo buttonAjaxWidget::widget
                 (
                    [  
                        'id'=>'enlaceconv_'.$model->id,
                        'idGrilla'=>'pjax-cantidad'.$model->id,
                        'ruta'=>Url::to(['/inter/programa/ajax-convoca','id'=>$model->id]),
                    ]
                 ); 
        ?>
       
    </div>
 <?php Pjax::end(); ?>
    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"> 
      <?php 
$gridName='grilla-cargos'.$model->id;
Pjax::begin(['id'=>$gridName,'timeout'=>false]); ?>
        <?= GridView::widget
            (
                [
                    'id'=>'mi-grillhfhfha',
                    'dataProvider' => new \yii\data\ActiveDataProvider
                    (
                        [
                            'query'=> Cargos::find()->
                                      andWhere(['depa_id'=>$model->id]),
                            'pagination'=>['pageSize'=>10],
                        ]
                    ),
                    'columns' => 
                    [
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}{update}',
                            'buttons' => 
                            [
                                'update' => function ($url,$model) use($gridName) 
                                            {
                                                $url= Url::to
                                                      (
                                                        [
                                                            'modal-edit-cargo','id'=>$model->id,'gridName'=>$gridName,
                                                            'idModal'=>'buscarvalor'
                                                        ]
                                                      );
                                                return Html::a
                                                       (
                                                            '<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>',
                                                            $url, ['class'=>'botonAbre']
                                                       );
                                            },                          
                                'delete' => function ($url,$model)
                                            {
                                                $url = Url::toRoute($this->context->id.'/ajax-detach-psico',['id'=>$model->id]);
                                                return Html::a
                                                       (
                                                            '<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>',
                                                            '#', ['title'=>$url,'family'=>'holas','id'=> \yii\helpers\Json::encode
                                                            (['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),]);
                                            }
                            ]
                        ],
                        [
                            'attribute' => 'descargo',
                            'value'=>function($model)
                                     {
                                        return $model->descargo;    
                                     },
                            //'group'=>TRUE,
                        ],               
                        //'ordenetapa',
                        
                    ],
                ]
            );
        ?>
        <?php 
            echo linkAjaxGridWidget::widget
            (
                [         
                    'idGrilla'=>'grilla-plan-evaluaciones',
                    'family'=>'holas',
                    'type'=>'POST',
                    'evento'=>'click',
                    'posicion'=> \yii\web\View::POS_END           
                ]
            ); 
        ?>
        <p>
            <?php 
                $url= Url::to(['modal-new-cargo','id'=>$model->id,'gridName'=>$gridName,'idModal'=>'buscarvalor']);            
                echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
            ?>           
        </p>
        <?php Pjax::end(); ?>
   </div>