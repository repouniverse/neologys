<?php

use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\CombovaloresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = yii::t('base.labels', 'Faculties');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="combovalores-index">

    <h4><span class="fa fa-cogs"></span><?= "   -    ".Html::encode($this->title) ?></h4>
   <div class="box box-body box-success">
    <?php Pjax::begin(['id'=>'migrillaPjax','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="fa fa-file"></span>    '.yii::t('base.verbs', 'Create'), ['create-facul'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'id'=>'mi-grilla',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'codfac',
            'desfac',
            //'parametro',
            
            //'valor1',
            //'valor2',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => yii::t('base.verbs', 'Edit'),                            
                        ];
                       // return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         
                         $url= \yii\helpers\Url::toRoute(['update-facul','id'=>$model->id]);
                        $options = [
                            'data-pjax'=>'0',
                            //'target'=>'_blank',
                            'title' => yii::t('base.verbs', 'Edit'),                                
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                      
                    },
                    'delete' => function($url, $model) {
                        $options = [
                                        'title' =>yii::t('base.verbs', 'Delete'),                            
                                    ];
                        $url = \yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                              return \yii\helpers\Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=>\yii\helpers\Json::encode(['id'=>$model->codfac,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                     },
                    ]
                ],
        ],
    ]); ?>
    
    <?php 
   echo linkAjaxGridWidget::widget([
          
            'idGrilla'=>'migrillaPjax',
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
           'posicion'=> \yii\web\View::POS_END
           
        ]); 
   ?>
    
    
    <?php Pjax::end(); ?>
   </div>
</div>
