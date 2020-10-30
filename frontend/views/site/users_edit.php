<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_labels', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <p>
    <div class="box box-success">
        <div class="box-body">
        <?= Html::a(Yii::t('base.verbs', 'Create user'), ['/site/create-user'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $url= Url::to('view-users') ;?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           
            'username',
            'email:email',
            //'profile.interlocutor',
           /* [
                'attribute' => 'interlocutor',
                'value' => function($model) {
                    return $model->profile->interlocutor;
                },
                
            ],*/
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 0 ? 'Inactivo' : 'Activo';
                },
                'filter' => [
                    0 => 'Inactivo',
                    10 => 'Activo'
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{update}{activate}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base_labels', 'Activate'),
                            'aria-label' => Yii::t('base_labels', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                    }
                    ]
                ],
            ],
        ]);
        ?>
</div>
