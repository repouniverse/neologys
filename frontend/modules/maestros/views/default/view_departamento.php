<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = $model->nombredepa;
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Departaments'), 'url' => ['index-departaments']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(m::t('verbs', 'Update'), ['update-departamento', 'id' => $model->coddepa], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'coddepa',
            'nombredepa',
            'detalles',
            
           
        ],
    ]) ?>

</div>
