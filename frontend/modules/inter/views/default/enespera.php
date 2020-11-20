<?php
use yii\helpers\Url;
use yii\helpers\Html;
USE kartik\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\inter\Module as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;


$this->title = m::t('labels', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="alumnos-index">
<?php echo common\widgets\spinnerWidget\spinnerWidget::widget();?>
    <h4> <?= Html::encode($this->title) ?> </h4>
    <div class="box box-success">
        <div class="box-body">
            
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
            </div>
    
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php Pjax::begin(['id'=>'gridTraba','timeout'=>false]); ?>
            <?= GridView::widget(
                [
                    'dataProvider'=>$provider,
                   // 'filterModel'=>$searchModel,
                    'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                    'columns'=>
                    [
                        'codalu',
                        'ap',
                        //'am',
                        'nombres',
                       
                        /*[
                            'attribute'=>'imagen',
                            'format'=>'raw',
                            'value'=>function($model){
                                return Html::img($model->image($model->codalu),['width'=>60,'height'=>80, 'class'=>"img-thumbnail cuaizquierdo"]);
                            }
                        ],*/
                        [
                            'class'=>'yii\grid\ActionColumn',
                            'template'=>'{update}',
                            'buttons'=>
                            [
                                'delete'=>function($url,$model)
                                          {
                                            $url=Url::to(['/inter/convocados/ajax-register-alu-with-mail','id'=>$model->id]);
                                            // $url=Url::to(['/inter/convocados/admitir-postulante','id'=>$model->id]);
                                           
                                            $options = ['title' => m::t('verbs', 'Update'),];
                                            return Html::a
                                                   (
                                                        '<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>',
                                                        $url,
                                                        $options
                                                   );
                                          },
                                'update'=>function ($url,$model)
                                          {                                                                 
                                            //$url=Url::to(['delete-alumnos','id'=>$model->id]);
                                            $url=Url::to(['/inter/convocados/ajax-register-alu-with-mail','id'=>$model->id]);
                                           
                                            $options = 
                                            [
                                                'family'=>'holas',
                                                'id'=>$model->id,                                                                   
                                                'title' =>$url
                                            ];
                                            return Html::a
                                                   (
                                                        '<span class="btn btn-danger btn-sm glyphicon glyphicon-ok"></span>',
                                                        '#', 
                                                        $options
                                                   );                                                                
                                          }
                            ]
                        ],
                    ],

                ]); 
            ?>
            <?php 
                echo linkAjaxGridWidget::widget(
                    [
                        'id'=>'sdsds54545454',
                        'idGrilla'=>'gridTraba',
                         'family'=>'holas',
                        'type'=>'POST',
                        'evento'=>'click',
                        'posicion'=> \yii\web\View::POS_END
                    ]); 
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
    </div>
