<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\FormatoDocsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_labels', 'Formato Docs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formato-docs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base_labels', 'Create Formato Docs'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codocu',
            'descripcion',
            'comentario:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{edit}{attach}',
               'buttons' => [
                  /* 'delete' => function ($url,$model) {
			   $url = \yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                              return \yii\helpers\Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,'family'=>'pinke','id'=>\yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar']);
                            },*/
                    
                        'edit' => function ($url,$model) {
			   $url = \yii\helpers\Url::to(['update','id'=>$model->id]);
                               
                              return \yii\helpers\Html::a('<span class="btn btn-danger glyphicon glyphicon-pencil"></span>', $url,[]);
                            },
                      /* 'view' => function ($url,$model) {
			   $url = \yii\helpers\Url::to(['view','id'=>$model->id]);
                               
                              return \yii\helpers\Html::a('<span class="btn btn-danger glyphicon glyphicon-eye"></span>', $url,[]);
                            },*/
                                    
                      'attach' => function($url, $model) {                        
                           $url=Url::toRoute(['/finder/selectimage',
                             'isImage'=>false,
                             'idModal'=>'imagemodal',
                             'idGrilla'=>'mis_files',
                             'modelid'=>$model->id,
                             'extension'=> Json::encode(['doc','docx','pdf','xls','xlsx']),
                             'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'title' => Yii::t('base_labels', 'Upload File'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                                    ];
                                return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'class' => 'botonAbre btn btn-success']);
                        }, 
                   ],
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
