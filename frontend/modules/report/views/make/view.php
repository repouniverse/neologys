<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\report\models\Reporte */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('report.messages', 'Reportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reporte-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('report.messages', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('report.messages', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('report.messages', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'xgeneral',
            'ygeneral',
            'xlogo',
            'ylogo',
            'codocu',
            'codcen',
            'modelo',
            'nombrereporte',
            'detalle:ntext',
            'campofiltro',
            'tamanopapel',
            'x_grilla',
            'y_grilla',
            'registrosporpagina',
            'tienepie',
            'tienelogo',
            'xresumen',
            'yresumen',
            'comercial',
            'tienecabecera',
        ],
    ]) ?>

</div>
