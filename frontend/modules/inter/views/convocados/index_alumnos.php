<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\inter\Module as m;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocumentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = m::t('labels', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="inter-convocados-index-alumnos">

    <h4><?= Html::encode($this->title) ?></h4>
 <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin([
        'id'=>'gridTraba'
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(m::t('labels', 'Create Student'), ['create-student'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'summary' => '',
        'columns' => [
           

            'codalu',
            'ap',
            'am',
            'nombres',
             

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
                'buttons'=>[
                    'update'=>function($url,$model){
                        $url=\yii\helpers\Url::toRoute(['view-alumno','id'=>$model->id]);
                        
                        return \yii\helpers\Html::a(                                
                                '<span class="btn btn-success glyphicon glyphicon-pencil"></span>',
                                $url,
                                ['data-pjax'=>'0']
                                );
                     },
                     'delete' => function ($url,$model) {
			   $url = \yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                              return \yii\helpers\Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=>\yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                   ]
                ],
        ],
    ]); ?>   
    <?php Pjax::end(); ?>
</div>
     </div>
</div>