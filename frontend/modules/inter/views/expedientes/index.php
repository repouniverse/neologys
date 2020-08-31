<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\inter\Module as m;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\InterExpedientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = m::t('labels', 'Inter Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-expedientes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(m::t('labels', 'Create Inter Files'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
