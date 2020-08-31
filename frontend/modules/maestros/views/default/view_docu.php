<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = $model->codocu;
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(m::t('verbs', 'Update'), ['update', 'id' => $model->codocu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(m::t('verbs', 'Delete'), ['delete', 'id' => $model->codocu], [
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
            'codocu',
            'desdocu',
            'clase',
            'tipo',
            'tabla',
            'abreviatura',
            'prefijo',
            'escomprobante',
            'idreportedefault',
        ],
    ]) ?>

</div>
