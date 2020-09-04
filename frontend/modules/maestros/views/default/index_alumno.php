<?php
use yii\helpers\Url;
use yii\helpers\Html;
USE kartik\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\maestros\MaestrosModule as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;

$this->title = m::t('labels', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="alumnos-index">
    <h4> <?= Html::encode($this->title) ?> </h4>
    <div class="box box-success">
        <div class="box-body">
            <?php Pjax::begin(['id'=>'gridTraba']); ?>
            <?php $paises=\common\helpers\ComboHelper::getCboPaises();
            $universidades=\common\helpers\ComboHelper::getCboUniversidades();
            ?>
            <?php  echo $this->render('_search_alumno', ['model' => $searchModel]); ?>
            <p>
                 <?= Html::a(m::t('labels', 'Create Student'), ['create-alumnos'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider'=>$dataProvider,
                //'filterModel'=>$searchModel,
                'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                //'summary'=>'',
                'columns'=>[
                            
                           ['attribute'=>'universidad_id',
                              'filter'=> $universidades,
                               'group'=>true,
                              'value'=>function($model){
                              return  $model->universidad->nombre;
                              }
                                
                                ],
                            'ap',
                            'am',
                            'nombres',
                            'codalu',
                            ['class'=>'yii\grid\ActionColumn',
                                      'template'=>'{update}{delete}',
                                      'buttons'=>[
                                                  'update'=>function($url,$model)
                                                            {
                                                                $url=Url::to(['update-alumnos','id'=>$model->id]);
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
                                                                $url=Url::to(['delete-alumnos','id'=>$model->id]);
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
