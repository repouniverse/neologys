<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Tenores */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Texts'), 'url' => ['index-tenores']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tenores-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('base_labels', 'Update'), ['update-tenor', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'universidad_id',
            'facultad_id',
            'codocu',
            'activo',
            'idioma',
            'posic',
            'texto:ntext',
            'order',
        ],
    ]) ?>

</div>
