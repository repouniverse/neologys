<?php
use frontend\modules\import\ModuleImport as m;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\import\models\ImportCargamasivaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = m::t('labels', 'Import records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="import-cargamasiva-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <br>
        <?= Html::a(m::t('verbs', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            

            'descripcion',
           ['attribute' => 'user_id',
               'format'=>'raw',
                'value' => function ($data) {
                return '<span class="glyphicon glyphicon-user"></span>      '.\common\helpers\h::getNameUserById($data->user_id); // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            ],
           ['attribute' => 'insercion',
               'format'=>'raw',
                'value' => function ($data) {
                return ($data->insercion)?'<span class="glyphicon glyphicon-check"></span>':''; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            ],
                    ['attribute' => 'modelo',
               'format'=>'raw',
                'value' => function ($data) {
                return \common\helpers\FileHelper::getShortName($data->modelo); // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            ],
            'escenario',
           
            'lastimport',
            //'descripcion',
            //'format',
            //'modelo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>