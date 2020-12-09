<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\maestros\MaestrosModule as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use common\helpers\ComboHelper as combo;
echo \common\widgets\spinnerWidget\spinnerWidget::widget();
$this->title =yii::t('base_labels', 'Teachers');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="docentes-index">
    <h4> <?= Html::encode($this->title) ?> </h4>
    <div class="box box-success">
        <div class="box-body">
            <?php Pjax::begin(['id'=>'gridTraba']); ?>
            <?php 
                $paises=combo::getCboPaises();
                $universidades=combo::getCboUniversidades();
            ?>
            <?php  echo $this->render('_search_docente', ['model' => $searchModel]); ?>
            .

            <?= GridView::widget(
                [
                    'dataProvider'=>$dataProvider,
                    //'filterModel'=>$searchModel,
                    'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                    'columns'=>
                    [
                        /*[
                            'attribute'=>'Pais',
                            'filter'=> $paises,
                            'group'=>true,
                            'value'=>function($model)
                                     {
                                        return $model->persona->pais;
                                     }                                 
                        ],*/
                        [
                            'attribute'=>'universidad_id',
                            'filter'=>$universidades,
                            'group'=>true,
                            'value'=>function($model)
                                     {
                                        return $model->universidad->nombre;
                                     }                                
                        ],
                        'codoce',
                        'ap',
                        'am',
                        'nombres',
                        [
                            'class'=>'yii\grid\ActionColumn',
                            'template'=>'{update}',
                            'buttons'=>
                            [
                                'update'=>function($url,$model)
                                          {
                                            $url=Url::to(['/acad/syllabus/manage-docente','id'=>$model->id]);
                                            $options = ['title' => yii::t('base_verbs', 'Manage'),];
                                            return Html::a
                                                   (
                                                        '<span class="btn btn-info btn-sm glyphicon glyphicon-zoom-in"></span>',
                                                        $url, $options
                                                   );
                                          },                                
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