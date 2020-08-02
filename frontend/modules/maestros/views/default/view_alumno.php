<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = $model->fullname();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index-alumnos']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update-alumnos', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codalu',
            'ap',
            'am',
            'codalu',
           
        ],
    ]) ?>

</div>
