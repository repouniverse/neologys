<?php
use frontend\modules\inter\Module as m;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\inter\models\InterProgramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
$this->title = m::t('labels', 'Inter Programas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-programa-index">
   <?php Html::img('@frontend');      ?>
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(m::t('labels', 'Create Inter Programa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}{view}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => m::t('base.verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => m::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         'delete' => function($url, $model) {                        
                        $options = [
                            'data-confirm' => m::t('labels', 'Are you sure you want to activate this user?'),
                            'title' => m::t('base.verbs', 'Delete'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', $url, $options/*$options*/);
                         }
                    ]
                ],
         
         
         ['attribute'=>'universidad',
             'value'=>function($model){
                        return $model->universidad->nombre;
             }
             ],
         
         

            //'id',
            'descripcion',
            'codperiodo',
           
            //'clase',
            //'programa_id',
            //'fopen',
            //'descripcion',
            //'detalles:ntext',

          
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
    </div>
       