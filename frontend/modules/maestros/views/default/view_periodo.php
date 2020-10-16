<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Periodos */

$this->title = $model->codperiodo;
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Periods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="periodos-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(m::t('verbs', 'Update'), ['update', 'id' => $model->codperiodo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(m::t('verbs', 'Delete'), ['delete', 'id' => $model->codperiodo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => m::t('validaciones', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codperiodo',
            'periodo',
            'activa',
        ],
    ]) ?>

</div>
