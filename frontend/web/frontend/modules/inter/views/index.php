<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\inter\models\InterExpedientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('labels', 'Inter Expedientes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-expedientes-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('labels', 'Create Inter Expedientes'), ['create'], ['class' => 'btn btn-success']) ?>
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
                            'title' => Yii::t('base.verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         'delete' => function($url, $model) {                        
                        $options = [
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'title' => Yii::t('base.verbs', 'Delete'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', $url, $options/*$options*/);
                         }
                    ]
                ],
         
         
         
         
         

            'id',
            'universidad_id',
            'facultad_id',
            'depa_id',
            'programa_id',
            //'modo_id',
            //'convocado_id',
            //'clase',
            //'status',
            //'codocu',
            //'fpresenta',
            //'fdocu',
            //'detalles:ntext',
            //'textointerno:ntext',
            //'estado',
            //'requerido',
            //'plan_id',
            //'orden',
            //'etapa_id',
            //'secuencia',
            //'current_etapa',

          
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
    </div>
       