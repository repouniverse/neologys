<?php
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use yii\helpers\Html;

use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\TrabajadoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = m::t('labels', 'Universities');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="trabajadores-index">
    <h4> <?= Html::encode($this->title) ?> </h4>
    <div class="box box-success">
        <div class="box-body">
            <?php Pjax::begin([
                  'id'=>'gridTraba'
                  ]);
            ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                 <?= Html::a(m::t('labels', 'Create University'), ['create-univer'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider'=>$dataProvider,
                'filterModel'=>$searchModel,
                'summary'=>'',
                'columns'=>[
                            'nombre',
                            'codpais',
                            'acronimo',
                            'estado',
                            ['class'=>'yii\grid\ActionColumn',
                                      'template'=>'{update}{view}{delete}',
                                      'buttons'=>[
                                                  'update'=>function($url,$model){
                                                                     $url=\yii\helpers\Url::toRoute(['update-univer','id'=>$model->id]);
                                                                     return \yii\helpers\Html::a(
                                                                            '<span class="btn btn-success glyphicon glyphicon-pencil"></span>',
                                                                            $url,
                                                                            ['data-pjax'=>'0']
                                                                     );
                                                            },
                                                  'view'=>function($url,$model){
                                                                   $url=\yii\helpers\Url::toRoute(['view-univer','id'=>$model->id]);
                                                                   return \yii\helpers\Html::a(
                                                                          '<span class="btn btn-success glyphicon glyphicon-search"></span>',
                                                                          $url,
                                                                          ['data-pjax'=>'0']
                                                                   );
                                                          },
                                                  'delete'=>function ($url,$model) {
                                                                      $url=\yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                                                                      return \yii\helpers\Html::a(
                                                                             '<span class="btn btn-danger glyphicon glyphicon-trash"></span>',
                                                                             '#', ['title'=>$url,'family'=>'holas',
                                                                             'id'=>\yii\helpers\Json::encode(['id'=>$model->id,
                                                                             'modelito'=> str_replace('@','\\',get_class($model))]),]
                                                                      );
                                                            }
                                                 ]
                            ],
                           ],
                ]); 
            ?>
            <?php 
                 echo linkAjaxGridWidget::widget([
                      'id'=>'widgetgridBancos',
                      'idGrilla'=>'gridTraba',
                      'family'=>'holas',
                      'type'=>'POST',
                      'evento'=>'click',
                      ]); 
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>