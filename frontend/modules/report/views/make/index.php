<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\report\models\ReporteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('report.messages', 'Reportes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporte-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('report.messages', 'Create Reporte'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombrereporte',
            'tamanopapel',
            'type',
            'documento.desdocu',
            //'ylogo',
            //'codocu',
            //'codcen',
            //'modelo',
            //'nombrereporte',
            //'detalle:ntext',
            //'campofiltro',
            //'tamanopapel',
            //'x_grilla',
            //'y_grilla',
            //'registrosporpagina',
            //'tienepie',
            //'tienelogo',
            //'xresumen',
            //'yresumen',
            //'comercial',
            //'tienecabecera',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
