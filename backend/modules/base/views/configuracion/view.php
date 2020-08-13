<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\base\Module as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\GrupoParametros */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Parameters Group'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="grupo-parametros-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(m::t('verbs', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(m::t('verbs', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'codgrupo',
            'descripcion',
            'detalle:ntext',
        ],
    ]) ?>

</div>
