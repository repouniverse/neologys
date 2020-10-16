<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = $model->codgrupo;
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Groups people'), 'url' => ['index-grupo-personas']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(m::t('verbs', 'Update'), ['update-grupo-personas', 'id' => $model->codgrupo], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codgrupo',
            'desgrupo',
            'modelo'
        ],
    ]) ?>

</div>
