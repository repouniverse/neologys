<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = $model->nombredepa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departaments'), 'url' => ['index-departaments']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update-departamento', 'id' => $model->coddepa], ['class' => 'btn btn-primary']) ?>
        
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
