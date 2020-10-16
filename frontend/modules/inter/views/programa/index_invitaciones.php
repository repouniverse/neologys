<?php
use frontend\modules\inter\Module as m;
use yii\helpers\Html;
use common\helpers\h;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\inter\models\InterProgramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
$this->title = m::t('labels', 'Invitations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-programa-index">
   
    <h4><?=h::awe('calendar').h::space(10).Html::encode($this->title) ?></h4>
    <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(['id'=>'planPjax']); ?>
    <?php  echo $this->render('_search_invitaciones', ['model' => $searchModel]); ?>

    .
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
    <div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model) 
                                            {
                                                $url= Url::to
                                                      (
                                                        [
                                                            'edit-invitacion','id'=>$model->id,
                                                           
                                                        ]
                                                      );
                                                return Html::a
                                                       (
                                                            '<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>',
                                                            $url, ['data-pjax'=>'0']
                                                       );
                                            },
                          'delete' => function($url, $model) { 
                                                $url= Url::to
                                                      (
                                                        [
                                                            'view-plan','id'=>$model->id,'gridName'=>'grilla-plan-evaluaciones',
                                                            'idModal'=>'buscarvalor'
                                                        ]
                                                      );
                        $options = [
                            'title' => m::t('verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                        
                    ]
                ],
                              
          ['attribute'=>'numero',
            'format'=>'raw',
             //'filter'=> \frontend\modules\inter\helpers\ComboHelper::getCboModos(),
             'value'=>function($model){
                      $url=Url::to(['edit-invitacion','id'=>$model->id]);
                      $options=['data-pjax'=>'0','target'=>'blank'];
                         return  Html::a($model->numero,$url,$options);
                        //return $model->numero;
             },
             
             ],                      
         'descripcion',
          ['attribute'=>'docenteinv_id',
             //'filter'=> \frontend\modules\inter\helpers\ComboHelper::getCboModos(),
             'value'=>function($model){
                        return $model->docenteinv->fullName();
             },
            // 'group'=>true,
             ],
                                 
         
          
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
    </div>
</div>
       