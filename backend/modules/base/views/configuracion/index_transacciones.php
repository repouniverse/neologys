<?php
use backend\modules\base\Module as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\CombovaloresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = m::t('labels', 'Field Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="combovalores-index">

    <h4><span class="fa fa-cogs"></span><?= "   -    ".Html::encode($this->title) ?></h4>
   <div class="box box-body box-success">
    <?php Pjax::begin(['id'=>'migrillaPjax','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="fa fa-file"></span>    '.m::t('verbs', 'Create'), ['create-campo-valores'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'id'=>'mi-grilla',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           'name','transaccion','esruta','description','grupo',
            
            //'valor1',
            //'valor2',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => m::t('verbs', 'Edit'),                            
                        ];
                       // return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         
                         $url= \yii\helpers\Url::toRoute(['update-campo-valores','id'=>$model->name]);
                        $options = [
                            'data-pjax'=>'0',
                            //'target'=>'_blank',
                            'title' => m::t('verbs', 'Edit'),                                
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                      
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
