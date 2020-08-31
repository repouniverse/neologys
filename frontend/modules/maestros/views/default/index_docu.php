<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocumentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = m::t('labels', 'Documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(m::t('labels', 'Create Documents'), ['create-docu'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codocu',
            'desdocu',
            'clase',
            'tipo',
            'tabla',
            //'abreviatura',
            //'prefijo',
            //'escomprobante',
            //'idreportedefault',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model) {  
                        $url=Url::to(['update-docu','id'=>$model->codocu]);
                        $options = [
                            'title' => m::t('verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                         
                         'delete' => function($url, $model) {
                        $options = [
                                        'title' =>m::t('verbs', 'Delete'),                            
                                    ];
                        $url = \yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                              return \yii\helpers\Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=>\yii\helpers\Json::encode(['id'=>$model->codocu,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                     },
                    ]
                ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
        </div>
    </div>
