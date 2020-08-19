<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocumentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = m::t('labels', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="alumnos-index">
    <h4> <?= Html::encode($this->title) ?> </h4>
    <div class="box box-success">
        <div class="box-body">
            <?php Pjax::begin([
                  'id'=>'gridTraba'
                  ]);
            ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                 <?= Html::a(m::t('labels', 'Create Student'), ['create-alumnos'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider'=>$dataProvider,
                'filterModel'=>$searchModel,
                'summary'=>'',
                'columns'=>[
                            'ap',
                            'am',
                            'nombres',
                            'codalu',
                            ['class'=>'yii\grid\ActionColumn',
                                      'template'=>'{update}{delete}',
                                      'buttons'=>[
                                                  'update'=>function($url,$model){
                                                                     $url=Url::to(['update-alumnos','id'=>$model->id]);
                                                                     $options = ['title' => m::t('verbs', 'Update'),];
                                                                     return Html::a(
                                                                            '<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>',
                                                                            $url,
                                                                            $options
                                                                     );
                                                            },
                                                  'delete'=>function ($url,$model) {
                                                                      $url=Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                                                                      return \yii\helpers\Html::a(
                                                                             '<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>',
                                                                             '#',
                                                                             ['title'=>$url,'family'=>'holas',
                                                                              'id'=>\yii\helpers\Json::encode(
                                                                                    ['id'=>$model->id, 
                                                                                     'modelito'=>str_replace('@','\\',get_class($model))
                                                                                    ]),
                                                                             ]
                                                                      );
                                                            }
                                                 ]
                            ],
                           ],
                ]); 
            ?>            
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
