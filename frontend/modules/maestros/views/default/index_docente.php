<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\maestros\MaestrosModule as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;

$this->title = m::t('labels', 'Teachers');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="docentes-index">
    <h4> <?= Html::encode($this->title) ?> </h4>
    <div class="box box-success">
        <div class="box-body">
            <?php Pjax::begin(['id'=>'gridTraba']); ?>
            <?php  echo $this->render('_search_docente', ['model' => $searchModel]); ?>
            <p>
                 <?= Html::a(m::t('labels', 'Create Teacher'), ['create-docentes'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider'=>$dataProvider,
                'filterModel'=>$searchModel,
                'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                //'summary'=>'',
                'columns'=>[
                            'ap',
                            'am',
                            'nombres',
                            'codoce',
                            ['class'=>'yii\grid\ActionColumn',
                                      'template'=>'{update}{delete}',
                                      'buttons'=>[
                                                  'update'=>function($url,$model)
                                                            {
                                                                $url=Url::to(['update-docentes','id'=>$model->id]);
                                                                $options = ['title' => m::t('verbs', 'Update'),];
                                                                return Html::a
                                                                        (
                                                                            '<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>',
                                                                            $url,
                                                                            $options
                                                                        );
                                                            },
                                                  'delete'=>function ($url,$model)
                                                            {                                                                 
                                                                $url=Url::to(['delete-docentes','id'=>$model->id]);
                                                                $options = [
                                                                                'family'=>'holas',
                                                                                'id'=>$model->id,                                                                   
                                                                                'title' =>$url //m::t('verbs', 'Delete'),
                                                                           ];
                                                                return Html::a
                                                                        (
                                                                            '<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>',
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
                        'id'=>'sdsds',
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
