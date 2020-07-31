<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Periodos */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Universities'), 'url' => ['index-univer']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="periodos-view">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <div class="box-body">
    <p>
        <?= Html::a(Yii::t('base.labels', 'Edit'), ['update-univer', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'acronimo',
            'nombre',
            //'activa',
        ],
    ]) ?>

</div></div></div>