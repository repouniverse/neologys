<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\acad\models\AcadSyllabusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_labels', 'Acad Syllabi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acad-syllabus-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="box box-succes">
        <div class="box-body">

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codcur',
            'descripcion',
            'codcursocorto',
            
            'carrera_id',
            'ap',
            'am',
            'nombres',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{view}',
                'buttons' => [
                    'update' => function($url, $model) { 
                         $url=Url::to(['update','id'=>$model->id]);
                        $options = [
                            'title' => yii::t('base_verbs', 'Update'), 'data-pjax'=>'0'                                
                        ];
                        return Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                          'view' => function($url, $model) { 
                           $url=Url::to(['make-syllabus-pdf','id'=>$model->id]);
                        $options = [
                            'title' => yii::t('base_verbs', 'View'), 'data-pjax'=>'0'                           
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         
                    ]
                ],
           
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    </div>
       </div>
</div>
